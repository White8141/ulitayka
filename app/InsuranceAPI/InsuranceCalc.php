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

    public function getAlphaCalc($request)
    {
        $calcParams = new AlphaCalcParams($request->all());
        return AlphaAPI::calculate($calcParams->getCalcParams('Calculate'));
        //dd($request->all());
        //return $calcParams->getCalcParams('calculate');
    }

    public function getVskCalc($request)
    {
        $calcParams = new VskCalcParams($request->all());
        return VskAPI::calculate($calcParams->getCalcParams('CALC2'));
        //return $calcParams->getCalcParams('Calc2');
    }

    public function getAdvantCalc($request)
    {
        $calcParams = new AdvantCalcParams($request->all());
        return AdvantAPI::calculate($calcParams->getCalcParams());
        //return $calcParams->getCalcParams('Calc2');
    }


    public function getInsuranceCalc($request, $isJson = false)
    {
        $result = [];

        $alpha = $this->getAlphaCalc($request) ?? null;
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

        $advant = $this->getAdvantCalc($request);
        //dd($advant);
        if (!is_null($advant)) {
            $result['advant'] = [
                'logo' => 'advantCard',
                'prem' => $advant[0]->variables->S,
                'assistance' => [
                    'name' => 0,
                    'info' => 0
                ]
            ];
        }

        return $isJson ? json_encode($result) : $result;
    }

    public function getAlphaBuy($request)
    {
        $calcParams = new AlphaCalcParams($request->all());
        return AlphaAPI::calculate($calcParams->getCalcParams('Create'));

    }
    
    public function buyInsurance($request, $isJson = false)
    {
        $result = [];
        //dd($request->all());

        $alpha = $this->getAlphaBuy($request)->NewPolictyResult ?? null;
        if (!is_null($alpha)) {
            $result['alpha'] = $alpha;
        }

        return $isJson ? json_encode($result) : $result;
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
        //$vsk = $this->getVskCalc($request);
        print_r($request->all());
        //return VskAPI::getCountries();
        //return json_encode(AlphaAPI::getRisks());
    }
}