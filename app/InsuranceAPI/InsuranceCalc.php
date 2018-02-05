<?php

namespace App\InsuranceAPI;

use App\InsuranceAPI\Alpha\AlphaAPI;
use App\InsuranceAPI\Alpha\AlphaCalcParams;
use App\InsuranceAPI\Vsk\VskAPI;
use App\InsuranceAPI\Vsk\VskCalcParams;
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
        //return $calcParams->getCalcParams('calculate');
    }

    public function getVskCalc($request)
    {
        $calcParams = new VskCalcParams($request->all());
        return VskAPI::calculate($calcParams->getCalcParams('CALC2'));
        //return $calcParams->getCalcParams('CALC2');
    }


    public function getInsuranceCalc($request, $isJson = false)
    {
        $result = [];

        //$alpha = $this->getAlphaCalc($request);
        //dd($alpha);

        /*$alpha = $this->getAlphaCalc($request)->NewPolictyResult ?? null;
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


        $vsk = $this->getVskCalc($request);
        dd($vsk);

        //$vsk = $this->getVskCalc($request)->Calc2Result ?? null;
        /*if (!is_null($vsk)) {
            $result['$vsk'] = [
                'card' => 'vskCard',
                'prem' => 0,
                'assistance' => [
                    'name' => 0,
                    'info' => 0
                ]
            ];
        }*/

        $advant = null;
        if (!is_null($advant)) {
            $result['advant'] = [
                'logo' => 'advantCard',
                'prem' => 0,
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
        //print_r($calcParams->getCalcParams('Create'));
    }
    
    public function buyInsurance($request, $isJson = false)
    {
        $result = [];

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