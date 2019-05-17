<?php

namespace App\Http\Controllers;

use App\InsuranceAPI\InsuranceCalc;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CalcController extends Controller
{
    protected $insuranceCalc;
    protected $request;

    public function __construct(InsuranceCalc $insuranceCalc, Request $request)
    {
        $this->insuranceCalc = $insuranceCalc;
        $this->request = $request;
    }

    public function calculate()
    {
        $this->insuranceCalc->prepareRequest($this->request);
        return view('policies/police_calc')->with([ 'defaultData' => json_encode($this->request->all()),
                                                    'calculation' => $this->insuranceCalc->getInsuranceCalc($this->request, true)
        ]);
    }
    
    public function ajax()
    {
        $this->insuranceCalc->prepareRequest($this->request);
        echo $this->insuranceCalc->getInsuranceCalc($this->request, true);
    }

    
    /*public function police_buy()
    {
        //dd ($this->request->all());
        return view('policies/police_done')->with([  'details' => $this->insuranceCalc->getInsuranceBuy($this->request, true),
                                            'companyId' => strval($this->request->input('companyId'))
                                         ]);
        //dd($this->insuranceCalc->getInsuranceBuy($this->request, 'alpha', false));
        
    }*/
    
    public function getData()
    {
        //return ('Test Message');
        //dd( $this->insuranceCalc->getInsuranseData($this->request));
        //return($this->request->all());
        return ($this->insuranceCalc->getInsuranceCalc($this->request, true));
    }
}