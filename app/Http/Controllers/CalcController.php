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
        //dd($this->request->all());
        if (!$this->request->has('countries'))  $this->request->merge(['countries' => [['country_name' => 'SCHENGEN']]]);
        if (!$this->request->has('dateFrom') || $this->request->input('dateFrom') == null) $this->request->merge(['dateFrom' => Carbon::now()->addDays(1)->toDateString()]);
        if (!$this->request->has('dateTill') || $this->request->input('dateTill') == null) $this->request->merge(['dateTill' => Carbon::now()->addDays(8)->toDateString()]);
        //dd($this->request->all());

        return view('policies/police_calc')->with([ 'defaultData' => json_encode($this->request->all()),
                                                    'calculation' => $this->insuranceCalc->getInsuranceCalc($this->request, true)
        ]);
    }
    
    public function ajax()
    {
        echo $this->insuranceCalc->getInsuranceCalc($this->request, true);
        //print_r($this->request->all());
    }

    
    /*public function police_buy()
    {
        //dd ($this->request->all());
        return view('policies/police_done')->with([  'details' => $this->insuranceCalc->getInsuranceBuy($this->request, true),
                                            'companyId' => strval($this->request->input('companyId'))
                                         ]);
        //dd($this->insuranceCalc->getInsuranceBuy($this->request, 'alpha', false));
        
    }*/
    
    /*public function getData()
    {
        print_r( $this->insuranceCalc->getInsuranseData($this->request));
        //return $this->request->all();
    }*/
}