<?php

namespace App\InsuranceAPI\Liberty;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class LibertyAPI {
    private static $url = 'https://testout.liberty24.ru/services/vzwidget/calc/';
    private static $client;

    public function __construct()
    {
        //self::$client = new Client();
    }

    /**
     * Послать POST запрос на url с заданнымм данными
     * @param $dataObj
     * @return JSON or string
     */
    private static function makePostRequest($dataObj = null)
    {
        self::$client = new Client();

        $options = [];
        foreach ($dataObj ?? [] as $key => $value) {
            $options[$key] = $value;
        }

        try {
            $res = self::$client->post(self::$url,
                [
                    'headers' => 
                    [
                        'Content-Type' => 'application/json;charset=UTF-8',
                        'Accept' => 'application/json'
                    ],
                    'json' => $options
                ]);
            return json_decode($res->getBody()->getContents()) ?? null;
        }
        catch (RequestException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Запрос на рассчет и получение тарифов и стоимостей
     */
    public static function calculate($options)
    {
        $resp = self::makePostRequest($options);

        $result = [];
        $result['card'] = 'liberty';
        $result['id'] = 0;
        $result['prem'] = 0;
        $result['assistance'] = 'No Info';
        $result['franchise'] = 'No Franchise';
        $result['rules'] = 'No Rules';

        if (gettype($resp) == 'object') {
            if (isset($resp->Vz_CalcRS->insured_premium)) {
                $result['id'] = $resp->Vz_CalcRS->calcualtion_id;
                $result['prem'] = $resp->Vz_CalcRS->insured_premium->summ;
                $result['franchise'] = $resp->Vz_CalcRS->Franchise_message;
            } else {
                $result['error'] = $resp->Vz_CalcRS->Error_message;
            }

        } elseif (gettype($resp) == 'string'){
            $result['error'] =  (stripos($resp, 'response:') > 1) ? substr($resp, 0, stripos($resp, 'response:')) : $resp;
        } else {
            $result['error'] = 'Unknown Error';
        }

        return $result;
    }
}