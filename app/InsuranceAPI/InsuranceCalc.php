<?php

namespace App\InsuranceAPI;

use App\InsuranceAPI\Alpha\AlphaAPI;
use App\InsuranceAPI\Alpha\AlphaCalcParams;
use App\InsuranceAPI\Vsk\VskAPI;
use App\InsuranceAPI\Vsk\VskCalcParams;
use App\InsuranceAPI\Advant\AdvantAPI;
use App\InsuranceAPI\Advant\AdvantCalcParams;
use App\InsuranceAPI\Liberty\LibertyAPI;
use App\InsuranceAPI\Liberty\LibertyCalcParams;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InsuranceCalc
{
    protected $insuranceRequest;
    
    public function __construct() {}

    public function getInsuranceCalc(Request $request, $isJson = false) {

        $result = [];
        $alpha = $this->getAlphaCalc($request) ?? null;
        //dd($alpha);
        if (!is_null($alpha)) {
            $result['alpha'] = [
                'card' => 'alphaCard',
                'prem' => $alpha->common->premRUR,
                'assistance' => $alpha->common->assistancePhones
            ];
        }

        /*$vsk = $this->getVskCalc($request) ?? null;
        if (!is_null($vsk) && isset($vsk['1. Премия RUR'])) {
            $result['vsk'] = [
                'card' => 'vskCard',
                'prem' => $vsk['1. Премия RUR'],
                'assistance' => [
                    'name' => 0,
                    'info' => 0
                ]
            ];
        }*/

        /*$advant = $this->getAdvantCalc($request);
        //dd($advant);
        if (!is_null($advant) && isset($advant[0]->variables->S)) {
            $result['advant'] = [
                'logo' => 'advantCard',
                'prem' => $advant[0]->variables->S,
                'policeId' => $advant[0]->id,
                'assistance' => [
                    'name' => 0,
                    'info' => 0
                ]
            ];
        }*/

        $calcParams = new LibertyCalcParams($request);
        $liberty =  LibertyAPI::calculate($calcParams->getCalcParams());
        //dd($liberty);
        if (!is_null($liberty)) {
            $result['liberty'] = $liberty;
        }

        return $isJson ? json_encode($result) : $result;
    }

    public function getAlphaCalc($request)
    {
        //dd($request->all());

        $calcParams = new AlphaCalcParams($request->all());
        
        return AlphaAPI::calculate($calcParams->getCalcParams('Calculate'));

        //return $calcParams->getCalcParams('calculate');
    }

    public function getVskCalc($request)
    {
        $calcParams = new VskCalcParams($request->all());
        return VskAPI::calculate($calcParams->getCalcParams(), 'Calc2');

        //dd(VskAPI::calculate($calcParams->getCalcParams(), 'Calc2'));
        //dd($calcParams->getCalcParams('Calc2'));

    }

    public function getAdvantCalc($request)
    {
        $calcParams = new AdvantCalcParams($request->all());
        return AdvantAPI::calculate($calcParams->getCalcParams($request->all()));
        //dd( $calcParams->getCalcParams($request->all()));
    }

    /*public function getLibertyCalc($request)
    {
        $calcParams = new LibertyCalcParams($request);
        //return $calcParams->getCalcParams();
        return LibertyAPI::calculate($calcParams->getCalcParams('Calculate'));
        //return null;
    }*/

    public function getInsuranceBuy($request, $isJson = false)
    {
        $result = [];
        //dd($request->all());

        switch ($request['companyId']) {
            case 'alpha':
                $alpha = $this->getAlphaBuy($request) ?? null;
                //dd($alpha);
                if (!is_null($alpha) && isset($alpha->common->policyLink)) {
                    $result['alpha'] = [
                        'card' => 'alphaCard',
                        'policyLink' => $alpha->common->policyLink,
                        'assistance' => [
                            'name' => $alpha->common->assistanceName,
                            'info' => $alpha->common->assistancePhones
                        ]
                    ];
                }
                break;
            case 'vsk':
                $vsk = $this->getVskBuy($request) ?? null;
                //dd($vsk);
                if (!is_null($vsk)) {
                    $result['vsk'] = [
                        'card' => 'vskCard',
                        'policyLink' => $vsk['policyLink'],
                        'assistance' => [
                            'name' => '',
                            'info' => ''
                        ]
                    ];
                }
                break;
            case 'advant':
                $advant = $this->getAdvantBuy($request) ?? null;
                dd($advant);
                if (!is_null($advant)) {
                    $result['advant'] = [
                        'card' => 'advantCard',
                        'policyLink' => $advant['url'],
                        //'data' => $advant,
                        'assistance' => [
                            'name' => '',
                            'info' => ''
                        ]
                    ];
                }
                break;
        }

        return $isJson ? json_encode($result) : $result;
    }

    public function getAlphaBuy($request)
    {
        $calcParams = new AlphaCalcParams($request->all());
        return AlphaAPI::buyPolice($calcParams->getCalcParams('Draft'));
    }

    public function getVskBuy($request)
    {
        $calcParams = new VskCalcParams($request->all());
        //return $calcParams->getCalcParams('CreatePolicy');
        $policeResult = VskAPI::calculate($calcParams->getCalcParams(), 'CreatePolicy');
        if (!is_null($policeResult) && isset($policeResult['1. Полис создан'])) {
            $policeData = VskAPI::getPoliceData($policeResult['1. Полис создан']);
        }
        return $policeData ?? null;

    }

    public function getAdvantBuy($request)
    {
        $calcParams = new AdvantCalcParams($request->all());
        //return $calcParams->getBuyParams($request->all());
        return AdvantAPI::buyPolicy($calcParams->getBuyParams($request->all()));

    }
    
    public function getInsuranseData($request)
    {
        return AlphaAPI::getAdditionalConditions();

    }

    public function prepareRequest (Request $request) {

        if (!$request->has('countries') || $request->input('countries') == null)  {
            $request->merge(['countries' => [['countryName' => 'SCHENGEN']]]);
        }

        if (!$request->has('dateFrom') || $request->input('dateFrom') == null)  {
            $request->merge(['dateFrom' => Carbon::now()->addDay()->format('d.m.Y')]);
        }

        if (!$request->has('dateTill') || $request->input('dateTill') == null)  {
            $request->merge(['dateTill' => Carbon::createFromFormat('d.m.Y', $request->input('dateFrom'))->addDays(7)->format('d.m.Y')]);
        }

        if (!$request->has('travelers') || $request->input('travelers') == null) {
            $request->merge(['travelers' => [['accept' => 'true', 'age' => '30']]]);
        }
    }
}