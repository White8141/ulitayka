<?php

namespace App\Http\Controllers;

use App\InsuranceAPI\InsuranceCalc;

use Illuminate\Http\Request;

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
        //print_r($this->request->all()['travelers'][0]['accept']);
        //print_r($this->request->all());
        return view('calc')->with([ 'calculation' => $this->insuranceCalc->getInsuranceCalc($this->request, true),
                                    'defaultData' => json_encode($this->request->only('dateFrom', 'dateTill', 'countries', 'travelers'))
                                    ]);
    }

    public function ajax()
    {
        echo $this->insuranceCalc->getInsuranceCalc($this->request, true);
        //print_r($this->request->all());
    }

    public function police_details()
    {
        //dd ($this->request->all());
        return view('police_details')->with([ 'defaultData' => json_encode($this->request->only('dateFrom', 'dateTill', 'countries', 'travelers'))]);
    }

    public function police_buy()
    {
        //print_r($this->request->all());
        return view('police_done')->with([ 'details' => $this->insuranceCalc->buyInsurance($this->request, true)]);

    }
    
    public function getData()
    {
        //return $this->insuranceCalc->getInsuranseData($this->request);
        return $this->request->all();
    }
}