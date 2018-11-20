<?php

namespace App\Http\Controllers;

use App\Traveler;
use Illuminate\Http\Request;
use App\InsuranceAPI\InsuranceCalc;
use App\Policy;
use App\Repositories\PolicyRepository;
use Illuminate\Support\Carbon;

class PolicyController extends Controller
{
    protected $request;
    protected $policies;
    protected $insuranceCalc;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PolicyRepository $policies, InsuranceCalc $insuranceCalc, Request $request)
    {
        $this->middleware('auth');

        $this->request = $request;
        $this->policies = $policies;
        $this->insuranceCalc = $insuranceCalc;

    }
    
    /*public function select (Request $request) {
        
        //dd($this->request->all());
        return view('policies/police_calc')->with([ 'defaultData' => json_encode($this->request->only('dateFrom', 'dateTill', 'countries', 'travelers')),
                                                    'calculation' =>             $this->insuranceCalc->getInsuranceCalc($this->request, true)
        ]);
    }*/

    /**
     * Создание нового полиса
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'companyId' => 'required|max:255',
        ]);

        //dd($request->all());

        $policy = $request->user()->policies()->create([
            'policy_name' => $request->name,
            'company_id' => $request->companyId,
            'policy_period_from' => $request->dateFrom,
            'policy_period_till' => $request->dateTill,
            'policy_cost' => $request->policeAmount,
            'policy_currency' => $request->policy_currency,
            'additional_condition_0' => $request->has('additionalConditions.0.accept') ? true : false,
            'additional_condition_1' => $request->has('additionalConditions.1.accept') ? true : false,
            'additional_condition_2' => $request->has('additionalConditions.2.accept') ? true : false,
            'link' => '/'
        ]);

        foreach ($request->countries as $country) {
            $policy->countries()->create([
                'country_name' => $country
            ]);
        }
        $policy->countries;

        foreach ($request->travelers as $traveler) {
            if (array_get($traveler, 'accept')) {
                $birhDate = new Carbon('-'.array_get($traveler, 'age').' years');
                $policy->travelers()->create([
                    'birth_date' => $birhDate->toDateString()
                ]);
            }
        }
        $policy->travelers;

        foreach ($request->risks as $risk) {
            if (array_get($risk, 'accept')) {
                $policy->risks()->create([
                    'risk_name' => array_get($risk, 'name'),
                    'risk_amount' => array_get($risk, 'risk_amount'),
                ]);
            }
        }
        $policy->risks;

        //dd($policy);
        /*return view('policies/police_edit')->with([ 'defaultData' => json_encode($policy),
                                                    'companyId' => strval($policy->company_id)
                                                ]);*/
        return redirect()->route('policy_edit', [$policy]);

    }

    /*public function open (Policy $policy) {
        $this->authorize('open', $policy);

        $policy->risks;
        $policy->travelers;
        $policy->countries;

        return view('policies/police_edit')->with([ 'defaultData' => json_encode($policy),
                                                    'companyId' => strval($policy->company_id)
                                                  ]);
    }*/

    public function edit (Policy $policy) {
        $this->authorize('edit', $policy);

        $policy->risks;
        $policy->travelers;
        $policy->countries;

        //dd($policy);

        return view('policies/police_edit')->with([ 'defaultData' => json_encode($policy),
                                                    'companyId' => strval($policy->company_id)
        ]);
    }

    public function calc()
    {
        echo $this->insuranceCalc->getInsuranceCalc($this->request, true);
    }

    public function save () {

        $defData = $this->request->all();

        $tempArray = [];
        foreach ($this->request->input('countries') as $country) {
            $tempArray[] = ['country_name' => $country];
        }
        $defData['countries'] = $tempArray;

        $policy = Policy::find($defData['policeId']);
        $policy->countries;
        $policy->travelers;
        $policy->risks;

        $policy->client_first_name = $defData['insureder']['firstName'];
        $policy->client_last_name = $defData['insureder']['lastName'];
        $policy->client_birthdate = $defData['insureder']['birthDate'];
        $policy->status = 1;

        $policy->save();

        foreach ($defData['travelers'] as $traveler) {
            if ($traveler['id'] != 0) {
                $trModel = Traveler::find($traveler['id']);
                $trModel->first_name = array_get($traveler, 'firstName');
                $trModel->last_name = array_get($traveler, 'lastName');
                $trModel->birth_date = array_get($traveler, 'birthDate');
                $trModel->save();
            }
        }

        //dd($policy);
        //dd($defData['travelers']);
        //dd($policy->travelers()->get());

        return redirect('/home');
    }

    public function delete (Policy $policy) {
        $this->authorize('destroy', $policy);

        $policy->delete();

        return redirect('/home');
    }
}
