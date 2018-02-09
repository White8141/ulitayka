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
use phpDocumentor\Reflection\Location;
use phpDocumentor\Reflection\Types\Object_;

class AdvantAPI
{
    private static $wsdl = 'http://195.182.155.126';
    private static $token = null;
    private static $userLogin = 'iuniver';
    private static $userPSW = '8R02nU';
    private static $client;

    //private static $insuranceProgrammUID = '9afd653e-9b31-4b9c-90dc-0ee0964afb1c';

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

    /**
     * Послать GET запрос на url с заданным header
     * @param $url
     * @return string
     */
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
     * Послать POST запрос на url с заданнымм данными
     * @param $url
     * @param $dataObj
     * @return JSON
     */
    private static function makePostRequest($url, $dataObj, $isJSON = false) {

        $options = [];

        try {
            if ($dataObj) {
                foreach ($dataObj as $key => $value) {
                    $options[$key] = $value;
                }
            }

            $res = self::$client->post(self::$wsdl.$url, [
                'headers' => [  'Authorization' => 'Token '.self::$token,
                                //'Content-Type' => 'application/xhtml+xml',
                                'Accept' => 'application/json'
                            ],
                'form_params' => $options]);
        }
        catch (RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents());

            //return json_decode($e->getResponse()->getBody()->getContents());
        }

        $response = $res->getBody() ?? null;

        if ($isJSON) {
            $response = json_decode($res->getBody()->getContents());
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
            //$resultArray[$sortArray[$i]->group->code][] = $sortArray[$i];

            $resultArray[] = $sortArray[$i];
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

        $medical = new Object_();
        $medical->insurance_plan = '54748';
        $medical->insurance_amount = '30000';
        $medical->insurance_currency = '46212';


        $options = [
            'is_multiple_policy' => false,
            'insurance_days_up_to' => '5',
            'insurance_territory' => [],
            'insurance_country' => '54727',
            'additional_risk' => '54758',
            'valid_from' => '2018-03-03',
            'valid_to' => '2018-03-07',
            'insurance_type' => '54452',
            'medical_expenses' => [],
            'insurants_set' => [
                ['age' => 45],
                ['age' => 30]
            ]

        ];

        $respObj = self::makePostRequest('/rest/full/calculation/', $options, true);

        //$tempUrl = '/rest/full/calculation/'.$respObj->id.'/result/'.$respObj->available_insurance_departments[0]->id.'/';
        //$respCalc = self::makePostRequest($tempUrl, null, true);

        return ($respObj);

        //return self::getInsuranceTypes();
    }

    /**
     * Запрос стран
     */

    public static function getCountries() {

        self::getToken();

        $countryString = self::makeGetRequest('/rest/full/insurance_country/');
        $countryArray = self::sortData($countryString);
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
        self::getToken();

        $respString = self::makeGetRequest('/rest/full/currency/');
        $respArray = self::sortData($respString);

        return ($respArray);
    }

    /**
     * Запрос доступных агенту программ страхования
     */
    public static function getInsuranceTypes()
    {
        self::getToken();

        $respString = self::makeGetRequest('/rest/full/insurance_type/');
        $respArray = self::sortData($respString);

        return ($respArray);
    }

    /**
     * Запрос доступных агенту программ страхования
     */
    public static function getInsuranceProgramms()
    {
        self::getToken();

        $respString = self::makeGetRequest('/rest/full/insurance_plan/');
        $respArray = self::sortData($respString);

        return ($respArray);
    }

    /**
     * Запрос списков рисков доступных к страхованию в выбранной программе
     */

    public static function getRisks ()
    {
        self::getToken();

        $respString = self::makeGetRequest('/rest/full/additional_risk/');
        $respArray = self::sortData($respString);

        return ($respArray);
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

    }

    /**
     * Запрос справочника доступных страховых сумм
     */

    public static function getStruhSum()
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

    }

    /**
     * Запрос справочника вариантов франшиз
     */

    public static function getFransize() {
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

    }

}
