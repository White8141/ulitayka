<?php

namespace App\InsuranceAPI;

use App\InsuranceAPI\Alpha\AlphaAPI;
use App\InsuranceAPI\Alpha\AlphaCalcParams;
use App\InsuranceAPI\Vsk\VskAPI;
use App\InsuranceAPI\Vsk\VskCalcParams;
use App\InsuranceAPI\Advant\AdvantAPI;
use App\InsuranceAPI\Advant\AdvantCalcParams;
use Illuminate\Http\Request;

class InsuranceCalc
{
    public function __construct()
    {
    }

    public function getInsuranceCalc($request, $isJson = false)
    {
        $result = [];

       /*$alpha = $this->getAlphaCalc($request) ?? null;
        //print_r($alpha);
        if (!is_null($alpha)) {
            $result['alpha'] = [
                'card' => 'alphaCard',
                'prem' => $alpha->common->premRUR,
                'assistance' => [
                    'name' => $alpha->common->assistanceName,
                    'info' => $alpha->common->assistancePhones
                ]
            ];
        }*/

        $vsk = $this->getVskCalc($request) ?? null;
        //dd($vsk);
        if (!is_null($vsk) && isset($vsk['1. Премия RUR'])) {
            $result['vsk'] = [
                'card' => 'vskCard',
                'prem' => $vsk['1. Премия RUR'],
                'assistance' => [
                    'name' => 0,
                    'info' => 0
                ]
            ];
        }

        /*$advant = $this->getAdvantCalc($request);
        //dd($advant);
        if (!is_null($advant) && isset($advant[0]->variables->S)) {
            $result['advant'] = [
                'logo' => 'advantCard',
                'prem' => $advant[0]->variables->S,
                'assistance' => [
                    'name' => 0,
                    'info' => 0
                ]
            ];
        }*/

        return $isJson ? json_encode($result) : $result;
    }

    public function getAlphaCalc($request)
    {
        $calcParams = new AlphaCalcParams($request->all());
        return AlphaAPI::calculate($calcParams->getCalcParams('Calculate'));

        //return $request->all();
        //return $calcParams->getCalcParams('calculate');
    }

    public function getVskCalc($request)
    {
        $calcParams = new VskCalcParams($request->all());
        return VskAPI::calculate($calcParams->getCalcParams(), 'Calc2');
        //return $calcParams->getCalcParams('Calc2');
    }

    public function getAdvantCalc($request)
    {
        $calcParams = new AdvantCalcParams($request->all());
        return AdvantAPI::calculate($calcParams->getCalcParams());
    }


    public function getInsuranceBuy($request, $isJson = false)
    {
        $result = [];
        //dd($request->all());

        switch ($request['companyId']) {
            case 'alpha':
                $alpha = $this->getAlphaBuy($request) ?? null;
                //dd($alpha);
                if (!is_null($alpha)) {
                    $result['alpha'] = [
                        'card' => 'alphaCard',
                        'prem' => $alpha->common->premRUR,
                        'assistance' => [
                            'name' => $alpha->common->assistanceName,
                            'info' => $alpha->common->assistancePhones
                        ]
                    ];
                }
                break;
            case 'vsk':
                $vsk = $this->getVskBuy($request) ?? null;
                dd($vsk);
                if (!is_null($vsk)) {
                    $result['vsk'] = [
                        'card' => 'vskCard',
                        'data' => $vsk
                    ];
                }
                break;

        }

        return $isJson ? json_encode($result) : $result;
    }

    public function getAlphaBuy($request)
    {
        $calcParams = new AlphaCalcParams($request->all());
        return AlphaAPI::buyPolice($calcParams->getCalcParams('Create'));
        //return $calcParams->getCalcParams('Calculate');

    }

    public function getVskBuy($request)
    {
        $calcParams = new VskCalcParams($request->all());
        $policeResult = VskAPI::calculate($calcParams->getCalcParams(), 'CreatePolicy');
        //return $calcParams->getCalcParams('CreatePolicy');
        if (!is_null($policeResult) && isset($policeResult['1. Полис создан'])) {
            $policeData = VskAPI::getPoliceData($policeResult['1. Полис создан']);
            /*if (!is_null($policeData)) {
                $result['vsk'] = [
                    'policeData' => $policeData
                ];
            }*/
        }
        return $policeData;

    }

    /*public function getData($request) {

        $result = [];

        $alpha = $this->getAlphaData($request)->NewPolictyResult ?? null;
        //dd($this->getAlphaData($request)->NewPolictyResult);
        //print_r($alpha);
        
        if (!is_null($alpha)) {
            $result['alpha'] = [
                'card' => 'alphaCard',
                'prem' => $alpha->common->premRUR,
                'assistance' => [
                    'name' => $alpha->common->assistanceName,
                    'info' => $alpha->common->assistancePhones
                ]
            ];
        }

        return json_encode($result);
    }*/

    public function getInsuranseData($request)
    {
        $calcParams = new VskCalcParams($request->all());
        return $calcParams->getCalcParams('Calc2');
        //return 'getInsData';
    }
}