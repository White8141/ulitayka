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
        return view('calc')->with([ 'defaultData' => json_encode($this->request->only('dateFrom', 'dateTill', 'countries', 'travelers')),
                                    'calculation' => $this->insuranceCalc->getInsuranceCalc($this->request, true)
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
        /*$this>$this->validate($this->request, [
            'dateFrom' => 'required',
            'dateTill' => 'required',
            'insureder.birthDate' => 'required'
        ]);*/
        //print_r($this->request->all());
        return view('police_done')->with([ 'details' => $this->insuranceCalc->buyInsurance($this->request, true)]);

    }
    
    /*public function getData()
    {
        print_r( $this->insuranceCalc->getInsuranseData($this->request));
        //return $this->request->all();
    }*/
}