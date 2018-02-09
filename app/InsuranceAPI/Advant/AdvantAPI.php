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
use GuzzleHttp\Exception\RequestException;
class AdvantAPI
{
    private static $wsdl = 'http://195.182.155.126';
    private static $token = null;
    private static $userLogin = 'iuniver';
    private static $userPSW = '8R02nU';
    private static $client;

    //private static $insuranceProgrammUID = '9afd653e-9b31-4b9c-90dc-0ee0964afb1c';

    /**
     * Метод отправки soap-запрса принимает метод и параметры, возвращает массив с ответом
     */

    private static function soapRequest($method, $params)
    {
        //dd($params);
        try {
            $client = new \SoapClient(self::$wsdl, array('trace' => 1));
            $result = @$client->__soapCall($method, $params);
            //$request = @$client->__getLastRequest();
        }
        catch (RequestException $e) {
            return 'Request Error';
        }
        return $result;
        //return $request;
    }

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
            $res = self::$client->request('POST', self::$wsdl.'/rest/v3/default/obtain-token', ['form_params' => $options]);

            self::$token = json_decode($res->getBody())->token ?? null;
            return self::$token;
        }
    }

    private static function makeGetRequest($url) {

        try {
            $res = self::$client->get(self::$wsdl.$url, [
                'headers' => [  'Authorization' => 'Token '.self::$token,
                                'Content-Type' => 'application/json;charset=UTF-8',
                                'Accept' => 'application/json']
            ]);
        }
        catch (RequestException $e) {
            return 'Request Error. Token: '.self::$token.', Text:'.$e->getMessage();
        }

        return $res->getBody()->getContents();
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
            $resultArray[strtoupper($sortArray[$i]->code)] = $sortArray[$i]->territory->id;
        }

        return ($resultArray);
    }

    /**
     * Метод расчета тарифа и регистрации или только расчета нового полиса (Принимает массив со всеми
     * входными параметрами, за исключением 'agentUid', 'userLogin','userPSW' )
     */
    public static function calculate()
    {
        self::getToken();

        return self::getCountries();
    }

    /**
     * Метод получения доступных агенту программ страхования
     */

    public static function getInsuranceProgramms()
    {
        self::getToken();

        $insString = self::makeGetRequest('/rest/full/insurance_plan/');

        return (self::sortData($insString));
    }

    /**
     * Запрос списков рисков доступных к страхованию в выбранной программе
     */

    public static function getRisks ()
    {
        self::getToken();

        $riskArray = self::makeGetRequest('/rest/full/additional_risk/');

        return ($riskArray);
    }

    /**
     * Запрос стран
     */

    public static function getCountries() {

        self::getToken();

        $countryString = self::makeGetRequest('/rest/full/insurance_country/');
        $countryArray = self::sortData($countryString);
        ksort($countryArray);

        /*$base_dir = dirname(__FILE__);
        /////////////////////////////
        $log_text = json_encode($countryArray);
        /////////////////
        $file_name = $base_dir.'/Countries.txt';

        file_put_contents($file_name, $log_text, FILE_APPEND | LOCK_EX);*/

        return $countryArray;

    }

    /**
     * Запрос справочника дополнительных условий спорт/работа
     */

    public static function getAdditionalConditions()
    {
        $method = 'GetAdditionalConditions';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }

    /**
     * Запрос справочника дополнительных условий скидки/надбавки
     */

    public static function getAdditionalConditions2()
    {
        $method = 'GetAdditionalConditions2';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }

    /**
     * Запрос справочника доступных страховых сумм
     */

    public static function getStruhSum(
        $programUid = null,
        $countryUid = null,
        $riskUid = null
    )
    {
        $method = 'GetStruhSum';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid,
                        'programUid' => $programUid,
                        'countryUid' => $countryUid,
                        'riskUid' => $riskUid
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }

    /**
     * Запрос справочника вариантов франшиз
     */

    public static function getFransize(
        $programUid = null,
        $countryUid = null,
        $riskUid = null)
    {
        $method = 'GetFransize';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid,
                        'programUid' => $programUid,
                        'countryUid' => $countryUid,
                        'riskUid' => $riskUid
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }

    /**
     * Запрос справочника компаний-ассистенсов
     */

    public static function getAssistance(
        $assistanceUid = null
    )
    {
        $method = 'GetAssistance';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid,
                        'assistanceUid' => $assistanceUid
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }

    /**
     * Запрос справочника валют
     */

    public static function getCurrency()
    {
        $method = 'GetCurrency';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }

    /**
     * Запрос справочника территорий
     */

    public static function getTerritory()
    {
        $method = 'GetTerritory';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }

    /**
     * отбор полисов по дате начала действия полисов попадающим в указанный период времени
     */

    public static function getPoliciesByBeginDate($policyPeriodFrom, $policyPeriodTill)
    {
        $method = 'GetPoliciesByBeginDate';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid,
                        'userLogin' => self::$userLogin,
                        'userPSW' => self::$userPSW,
                        'policyPeriodFrom' => $policyPeriodFrom,
                        'policyPeriodTill' => $policyPeriodTill
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }

    /**
     * Метод отбора полисов по дате создания полиса за указанный период времени
     */

    public static function getPoliciesByCreateDate($policyPeriodFrom, $policyPeriodTill)
    {
        $method = 'GetPoliciesByCreateDate';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid,
                        'userLogin' => self::$userLogin,
                        'userPSW' => self::$userPSW,
                        'policyPeriodFrom' => $policyPeriodFrom,
                        'policyPeriodTill' => $policyPeriodTill
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }

    /**
     * Метод отбора полисов по номеру
     */

    public static function getPoliciesByPolicyNumber($policyNumber)
    {
        $method = 'GetPoliciesByPolicyNumber';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid,
                        'userLogin' => self::$userLogin,
                        'userPSW' => self::$userPSW,
                        'policyNumber' => $policyNumber
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }

    /**
     * Метод аннулирования полиса
     */

    public static function setCancelPolicy($number)
    {
        $method = 'SetCancelPolicy';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid,
                        'userLogin' => self::$userLogin,
                        'userPSW' => self::$userPSW,
                        'number' => $number
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }

    /**
     * Метод акцептации полиса
     */

    public static function setAcceptPolicy($number)
    {
        $method = 'SetAcceptPolicy';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid,
                        'userLogin' => self::$userLogin,
                        'userPSW' => self::$userPSW,
                        'number' => $number
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }

}
