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

    private static function soaqwepRequest($method, $params)
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

    public static function calculate($calcParams, $method = 'Calc2')
    {
        try {
            $client = new \SoapClient(self::$wsdl, array('trace' => 1));

            $result = @$client->__soapCall($method, $calcParams);
            //$request = @$client->__getLastRequest();

        }
        catch (\SoapFault $e) {
            return 'Error';
        }

        $resp = $method.'Result';
        return self::sortData($result->$resp ?? null);
        //return $result;
    }

    /**
     * Получить данные готового полиса
     * @param $calcParams
     * @param string $method
     * @return mixed|string
     */
    public static function getPoliceData($policyNumber)
    {
        $params = [
            'parameters' =>
                [
                    'PolicyNumber' => $policyNumber,
                    'rid' => 3
                ]
        ];

        try {
            $client = new \SoapClient('https://newtravel.vsk.ru/test/Front/ExternalWebServices/Policy.asmx?wsdl', array('trace' => 1));

            $result = @$client->__soapCall('GetPrintForm', $params);
            //$request = @$client->__getLastRequest();
        } catch (\SoapFault $e) {
            return $e;
        }
        //return $result->GetPrintFormResult ?? null;

        if (isset($result->GetPrintFormResult)) {
            $pdf = fopen ('/var/www/u0390786/data/www/ulitayka.ru/public/policy/'.$policyNumber.'.pdf','w');
            fwrite ($pdf, $result->GetPrintFormResult);
            fclose ($pdf);

            return [
                'policyLink' => 'https://ulitayka.ru/policy/'.$policyNumber.'.pdf'
            ];
        } else {
            return null;
        }


    }
    
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
    public static function getRisks ()
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
    public static function getCountries()
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
        $xmlResult =  self::soapRequest($method, $params);
        //$xmlResult = 'Test Message';

        //return self::sortData($xmlResult);
        return json_encode($xmlResult);
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

}
