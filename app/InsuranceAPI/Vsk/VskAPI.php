<?php
/**
 * Created by PhpStorm.
 * User: White
 * Date: 01.02.2018
 * Time: 12:48
 */

namespace App\InsuranceAPI\Vsk;

class VskAPI
{
    private static $wsdl = 'https://newtravel.vsk.ru/test/WS/Policy2.asmx?wsdl';
    private static $asmx = 'https://newtravel.vsk.ru/test/Front/ExternalWebServices/GetInputParams.asmx?wsdl';
    private static $organizationId = '6F470B1B-C484-4FA6-A150-2349211564E5';
    private static $userId  = 'F24230CC-CFC3-4EC5-8D7D-E3D72E0D6DC8';

    /**
     * Метод отправки soap-запрса принимает метод и параметры, возвращает массив с ответом
     */

    private static function soapRequest($method, $params)
    {
        try {
            $client = new \SoapClient(self::$wsdl, array('trace' => 1));
            $result = @$client->__soapCall($method, $params);
            $request = @$client->__getLastRequest();

        }
        catch (\SoapFault $e) {
            return 'Error';
        }
        return $result;
        //return $request;
    }

    public static function calculate($calcParams)
    {
        $method = 'Calc2';

        try {
            $client = new \SoapClient(self::$wsdl, array('trace' => 1));

            $result = @$client->__soapCall($method, $calcParams);
            $request = @$client->__getLastRequest();

        }
        catch (\SoapFault $e) {
            return 'Error';
        }

        return self::sortData($result->Calc2Result ?? null);
        //return $result;
        //return $request;
    }
    
    /**
     * Метод получения доступных агенту программ страхования
     */
    /*public static function getInsuranceProgramms()
    {
        $method = 'GetInsuranceProgramms';
        $params = [
            [
                'parameters' =>
                    [
                        'OrganizationId' => self::$organizationId
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }*/

    /**
     * Обработка полученных данных
     */
    public static function sortData($xmlResult) {

        $vals = [];
        $index = [];
        $p = xml_parser_create();
        xml_parse_into_struct($p, $xmlResult, $vals, $index);
        xml_parser_free($p);

        $sortResult = [];

        for ($i = 0; $i < count($vals); $i++) {
            if ($vals[$i]['tag'] == 'ITEMTEXT') {
                $sortResult[$vals[$i]['value']] = $vals[$i + 2]['value'];
            }
        }

        return ($sortResult);
    }


    /**
     * Запрос списков рисков доступных к страхованию в выбранной программе
     */
    public static function getRisks (
        $programUid = null
    )
    {
        $method = 'GetRiskAmounts';
        $params = [
            [
                'parameters' =>
                    [
                        'OrganizationId' => self::$organizationId,
                        'CountryTypeId' => '8d98d27c-3202-492e-81ba-d5fe6f0bbc7c'
                    ]
            ]
        ];

        $xmlResult =  self::soapRequest($method, $params);

        return self::sortData($xmlResult->GetRiskAmountsResult);
    }

    /**
     * Запрос стран
     */
    public static function getCountries(
        $programUid = null,
        $countryTypeId = null
    )
    {
        $method = 'GetCountry';
        //$method = 'GetCountryTypes';

        $params = [
            [
                'parameters' =>
                    [
                        'CountryTypeId' => 'a64ee129-5707-4fa9-a2f2-a399204b9cfa',
                        'OrganizationId' => self::$organizationId,
                        'UserId' => self::$userId
                    ]
            ]
        ];

        $xmlResult =  self::soapRequest($method, $params);
        /*$xmlResult = '<?xml version="1.0" encoding="utf-8"?> <newtravel ver="1"> <ListItem> <ItemText>РОССИЯ (RUSSIAN FEDERATION)</ItemText> <ItemValue>309b5fbb-2cbc-45d5-b7be-07c075797a7e</ItemValue> </ListItem> <ListItem> <ItemText>АБХАЗИЯ</ItemText> <ItemValue>4a389b43-ed0c-4bcc-a669-1060c3cfe5f0</ItemValue> </ListItem> <ListItem> <ItemText>МОЛДОВА</ItemText> <ItemValue>57bd671c-33e1-46e8-9fdf-1895bc905f86</ItemValue> </ListItem> <ListItem> <ItemText>УКРАИНА</ItemText> <ItemValue>e5f2e014-ee82-48e3-ab75-1db14fda43b0</ItemValue> </ListItem> <ListItem> <ItemText>РОССИЯ, КРЫМ</ItemText> <ItemValue>001b99b3-f417-4837-9f2f-36c7948efde2</ItemValue> </ListItem> <ListItem> <ItemText>UKRAINE</ItemText> <ItemValue>d4f3dc2d-fcde-4931-9dc5-7e5e80a8a06e</ItemValue> </ListItem> <ListItem> <ItemText>КАЗАХСТАН</ItemText> <ItemValue>88a40d52-852a-4eba-bed7-b195ec93090e</ItemValue> </ListItem> <ListItem> <ItemText>ТАДЖИКИСТАН</ItemText> <ItemValue>9b6bd196-5a00-4962-93c7-b7e08bbcbc79</ItemValue> </ListItem> <ListItem> <ItemText>РОССИЯ, СТРАНЫ СНГ</ItemText> <ItemValue>c475f235-2615-4f5c-9c79-befab484f8f6</ItemValue> </ListItem> <ListItem> <ItemText>АРМЕНИЯ</ItemText> <ItemValue>f136f7dd-bc6b-4889-a886-ce3ff96c4f96</ItemValue> </ListItem> <ListItem> <ItemText>КИРГИЗИЯ</ItemText> <ItemValue>2fb3063d-1e50-4028-a842-dd3b3d148343</ItemValue> </ListItem> <ListItem> <ItemText>ЮЖНАЯ ОСЕТИЯ</ItemText> <ItemValue>257d703f-5e06-4119-99f5-debcf3d8997d</ItemValue> </ListItem> <ListItem> <ItemText>АЗЕРБАЙДЖАН</ItemText> <ItemValue>d4984093-1ae9-42d5-b45a-dfb466f72bb2</ItemValue> </ListItem> <ListItem> <ItemText>ТУРКМЕНИСТАН</ItemText> <ItemValue>c5b2b281-0c17-40c9-87bf-ef3b3da566a4</ItemValue> </ListItem> <ListItem> <ItemText>БЕЛОРУССИЯ</ItemText> <ItemValue>87277ca4-744d-49fd-8bd4-f3a1ad73cfa3</ItemValue> </ListItem> <ListItem> <ItemText>ГРУЗИЯ</ItemText> <ItemValue>ec9acd24-9849-46b0-9d24-f5720dc31a2f</ItemValue> </ListItem> <ListItem> <ItemText>УЗБЕКИСТАН</ItemText> <ItemValue>8b1307d8-d2b6-43c0-996a-f6bba8419ff9</ItemValue> </ListItem> </newtravel>';*/

        $sortArray = self::sortData($xmlResult->GetCountryResult);
        ksort($sortArray);

        /*$base_dir = dirname(__FILE__);
        /////////////////////////////
        $log_text = json_encode($sortArray);
        /////////////////
        $file_name = $base_dir.'/Countries.txt';

        file_put_contents($file_name, $log_text, FILE_APPEND | LOCK_EX);
        return;*/

        return ($sortArray);
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
                        'OrganizationId' => self::$organizationId,
                        'AdditionalConditionsTypeId' => '6f3671ce-33ed-47fd-9ecd-c0c1582d442b'
                    ]
            ]
        ];
        //$xmlResult =  self::soapRequest($method, $params);
        $xmlResult = '';

        return self::sortData($xmlResult);
        //return json_encode($xmlResult);
    }

    /**
     * Запрос справочника дополнительных условий скидки/надбавки
     */

    /*public static function getAdditionalConditions2()
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
    }*/

    /**
     * Запрос справочника доступных страховых сумм
     */

    /*public static function getStruhSum(
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
    }*/

    /**
     * Запрос справочника вариантов франшиз
     */

    /*public static function getFransize(
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
    }*/

    /**
     * Запрос справочника компаний-ассистенсов
     */

    /*public static function getAssistance(
        $assistanceUid = null
    )
    {
        $method = 'GetAssistance';
        $params = [
            [
                'parameters' =>
                    [
                        'agentUid' => self::$agentUid,
                        'assistanceUid' => $assistanceUids
                    ]
            ]
        ];
        return self::soapRequest($method, $params);
    }*/

    /**
     * Запрос справочника валют
     */

    /*public static function getCurrency()
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
    }*/

    /**
     * Запрос справочника территорий
     */

    /*public static function getTerritory()
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
    }*/

    /**
     * отбор полисов по дате начала действия полисов попадающим в указанный период времени
     */

    /*public static function getPoliciesByBeginDate($policyPeriodFrom, $policyPeriodTill)
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
    }*/

    /**
     * Метод отбора полисов по дате создания полиса за указанный период времени
     */

    /*public static function getPoliciesByCreateDate($policyPeriodFrom, $policyPeriodTill)
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
    }*/

    /**
     * Метод отбора полисов по номеру
     */

    /*public static function getPoliciesByPolicyNumber($policyNumber)
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
    }*/

    /**
     * Метод аннулирования полиса
     */

    /*public static function setCancelPolicy($number)
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
    }*/

    /**
     * Метод акцептации полиса
     */

    /*public static function setAcceptPolicy($number)
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
    }*/

    /**
     * Метод расчета тарифа и регистрации или только расчета нового полиса (Принимает массив со всеми
     * входными параметрами, за исключением 'agentUid', 'userLogin','userPSW' )
     */

}
