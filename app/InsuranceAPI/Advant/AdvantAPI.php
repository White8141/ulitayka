<?php
/**
 * Created by PhpStorm.
 * User: CTAC
 * Date: 08.02.2018
 * Time: 10:43
 */

namespace App\InsuranceAPI\Advant;
/**
 * Класс отправки запросов API Адвант
 */

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use phpDocumentor\Reflection\Location;
use phpDocumentor\Reflection\Types\Object_;

class AdvantAPI
{
    private static $wsdl = 'http://195.182.155.126';
    private static $token = null;
    private static $userLogin = 'iuniver';
    private static $userPSW = '8R02nU';
    private static $client;

    /**
     * Получение токена
     */
    private static function getToken() {

        if (self::$token == null) {
            $options = [
                'username' => self::$userLogin,
                'password' => self::$userPSW
            ];

            self::$client = new Client();
            $res = self::$client->request('POST', self::$wsdl.'/rest/v3/default/obtain-token', ['form_params' => $options] );

            self::$token = json_decode($res->getBody())->token ?? null;
            return self::$token;
        }
    }

    /**
     * Послать пустой GET запрос на url с заданным header
     * @param $url
     * @return string
     */
    private static function makeGetRequest($url, $isResponceJSON = false) {

        try {
            $res = self::$client->get(self::$wsdl.$url, [
                'headers' => [  'Authorization' => 'Token '.self::$token,
                                'Content-Type' => 'application/json;charset=UTF-8',
                                'Accept' => 'application/json']
            ]);
        }
        catch (RequestException $e) {
            //return 'Request Error. Token: '.self::$token.', Text:'.$e->getMessage();
            return json_decode($e->getResponse()->getBody()->getContents());
        }

        return $isResponceJSON ? (json_decode($res->getBody()->getContents())) : self::sortData($res->getBody()->getContents());
    }

    /**
     * Послать POST запрос на url с заданнымм данными
     * @param $url
     * @param $dataObj
     * @return JSON
     */
    private static function makePostRequest($url, $dataObj = null, $isRespJSON = true) {

        $options = [];
        foreach ($dataObj ?? [] as $key => $value) {
            $options[$key] = $value;
        }

        try {
                $res = self::$client->post(self::$wsdl.$url,
                    [
                        'headers' => [  'Authorization' => 'Token '.self::$token,
                                        'Content-Type' => 'application/json;charset=UTF-8',
                                        'Accept' => 'application/json'],
                        'json' => $options
                    ]);
        }
        catch (RequestException $e) {
            //return json_decode($e->getResponse()->getBody()->getContents());
            return Psr7\str($e->getResponse());
        }

        if ($isRespJSON) {
            $response = json_decode($res->getBody()->getContents()) ?? null;
        } else {
            $response = $res->getBody() ?? null;
        }

        return $response;
    }

    /**
     * Обработка полученных данных
     */
    private static function sortData($dataString) {

        $dataString = substr($dataString, 2, -2);
        $sortArray = explode('}, {', $dataString);
        $resultArray = [];

        for ($i = 0; $i < count($sortArray); $i ++) {
            $sortArray[$i] = '{'.$sortArray[$i].'}';
            $sortArray[$i] = json_decode($sortArray[$i]);

            /**
             * сортировка государств
             */
            /*if ($sortArray[$i]->code == 'Schengen') { $resultArray[strtoupper($sortArray[$i]->title)] = $sortArray[$i]->id; }
            else { $resultArray[strtoupper($sortArray[$i]->code)] = $sortArray[$i]->id; }*/

            /**
             * сортировка видов рисков по типу (работа, спорт или отдых)
             */
            $resultArray[$sortArray[$i]->group->code][] = $sortArray[$i];

            $resultArray[] = $sortArray[$i];
        }

        return ($resultArray);
    }

    /**
     * Запрос на рассчет и получение тарифов и стоимостей
     */
    public static function calculate($options)
    {
        self::getToken();

        //запрос на сохранение рассчета и получение id рассчета и страховых компаний
        //dd($options);
        $resp0 = self::makePostRequest('/rest/full/calculation/', $options);

        if (isset($resp0->id) && isset($resp0->available_insurance_departments[0]->id)) {
            //запрос на рассчет тарифа по доступным страховым программам (в данном случае vzr)
            $options = [
                'id' =>  $resp0->id,
                'available_insurance_departments' =>  $resp0->available_insurance_departments[0]->id
            ];
            $url1 = '/rest/v3/default/calculation/' . $resp0->id . '/result/' . $resp0->available_insurance_departments[0]->id . '/';
            $resp1 = self::makePostRequest($url1, $options);
        } else {
            return ['error0: ' => $resp0];
        }

        //подправить стоимость, а то у них 4 нуля после запятой
        if (isset($resp1[0]->variables->S)) {
            $str = $resp1[0]->variables->S;
            $pos = strpos($str, '.');
            $resp1[0]->variables->S = substr($str, 0, $pos + 3);
            return $resp1;
        } else {
            return null;
        }

    }

    /**
     * Запрос на обработку, сохранение рассчета и получение ссылки на него
     */
    public static function buyPolicy($params) {

        self::getToken();

        //Получение идентификатора полиса для дальнейшей работы с ним
        $options = [
            'external_id' =>  null,
            'valid_from' => $params['validFrom'],
            'valid_to' => $params['validTo'],
            'result' => $params['policyId'],
            'insured_object' => 3825

        ];
        $resp2 = self::makePostRequest('/policy/rest/result_policy/', $options);

        //Вносим данные о клиенте
        if (isset($resp2->id)) {
            $params['person'][0]['natural_person']['external_id'] = $resp2->id;
            $params['person'][0]['natural_person']['id'] = $resp2->id;
            $options = [
                "object_type"=>"vzr",
                "person"=>$params['person'],
                "insurants_vzr"=>$params['insurants']
            ];
            $resp4 = self::makePostRequest('/rest/default/client/insured-object-create', $options, false);
        } else {
            return ['error2: ' => $resp2];
        }
        return $resp4;
            
        //Получение печатной формы полиса
        /*if (isset($resp2->id)) {
            $options = [
                'result' => $resp2->id,
                'is_cash' => false
                //'test' => false,
            ];
            $url3 = '/policy/rest/result_policy/'.$resp2->id.'/print/';
            $resp3 = self::makePostRequest($url3, $options);
        } else {
            return ['error2: ' => $resp2];
        }*/

        //Получаем данные о полисе
        /*if (isset($resp2->id)) {
            $resp5 = self::makeGetRequest('/policy/rest/result_policy/'.$resp2->id.'/', true);
        } else {
            return ['error2: ' => $resp2];
        }

        return $resp5;*/

        //return (['url' => self::$wsdl.$resp3->documents[0]->url,]);

    }
    
    /**
     * Запрос справочника валют
     */
    public static function getUser()
    {
        return self::makeGetRequest('/rest/v3/default/accounts/user/current/');
    }

    /**
     * Запрос стран
     */
    public static function getCountries() {

        $countryArray = self::makeGetRequest('/rest/full/insurance_country/');
        //ksort($countryArray);

        /*$base_dir = dirname(__FILE__);
        /////////////////////////////
        $log_text = json_encode($countryArray);
        /////////////////
        $file_name = $base_dir.'/Countries.txt';

        file_put_contents($file_name, $log_text, FILE_APPEND | LOCK_EX);*/

        return $countryArray;
    }

    /**
     * Запрос справочника валют
     */
    public static function getCurrency()
    {
        return self::makeGetRequest('/rest/full/currency/');
    }

    /**
     * Запрос доступных агенту программ страхования
     */
    public static function getInsuranceTypes()
    {
        return self::makeGetRequest('/rest/full/insurance_type/');
    }

    /**
     * Запрос доступных агенту программ страхования
     */
    public static function getInsuranceProgramms()
    {
        return (self::makeGetRequest('/rest/full/insurance_plan/'));
    }

    /**
     * Запрос списков рисков доступных к страхованию в выбранной программе
     */
    public static function getRisks ()
    {
        self::getToken();
        return self::sortData(self::makeGetRequest('/rest/full/additional_risk/'));
    }



}
