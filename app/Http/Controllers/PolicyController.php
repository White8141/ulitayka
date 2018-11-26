<?php

namespace App\Http\Controllers;

use App\Risk;
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
                'country_name' => $country['country_name']
            ]);
        }
        $policy->countries;

        foreach ($request->travelers as $traveler) {
            if (array_get($traveler, 'accept')) {
                $birhDate = new Carbon('-'.array_get($traveler, 'age').' years');
                $policy->travelers()->create([
                    'birth_date' => $birhDate->format('d.m.Y')
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
                                                    'companyId' => strval($policy->company_id),
                                                    'user' => $this->request->user()
        ]);
    }

    public function calc()
    {
        echo $this->insuranceCalc->getInsuranceCalc($this->request, true);
    }

    public function save () {

        //dd($this->request->all());

        //dd($this->request);

        $policy = Policy::find($this->request['policeId']);
        $policy->countries;
        $policy->travelers;
        $policy->risks;

        $policy->policy_period_from = $this->request->dateFrom;
        $policy->policy_period_till = $this->request->dateTill;
        $policy->policy_cost = $this->request->policeAmount;
        $policy->policy_currency = $this->request->policy_currency;
        $policy->additional_condition_0 = $this->request->has('additionalConditions.0.accept') ? true : false;
        $policy->additional_condition_1 = $this->request->has('additionalConditions.1.accept') ? true : false;
        $policy->additional_condition_2 = $this->request->has('additionalConditions.2.accept') ? true : false;

        /*$policy->client_first_name = $this->request['insureder']['firstName'];
        $policy->client_last_name = $this->request['insureder']['lastName'];
        $policy->client_birthdate = $this->request['insureder']['birthDate'];*/
        $policy->status = 1;

        $policy->save();

        $user = $this->request->user();
        if (!$user->user_profile_filled) {
            $user->user_first_name_en = $this->request->input('insureder.firstName');
            $user->user_last_name_en = $this->request->input('insureder.lastName');
            if ($this->request->input('insureder.birthDate') != null) $user->user_birthdate = $this->request->input('insureder.birthDate');
            $user->save();
        }

        foreach ($this->request['travelers'] as $traveler) {
            if ($traveler['id'] != 0) {
                //dump($traveler);
                $trModel = Traveler::find($traveler['id']);
                $trModel->first_name = array_get($traveler, 'firstName');
                $trModel->last_name = array_get($traveler, 'lastName');
                $trModel->birth_date = array_get($traveler, 'birthDate');
                $trModel->save();
            }
        }

        foreach ($this->request['risks'] as $risk) {
            //dump($policy->risks()->where('risk_name', $risk['name'])->first());
            $currRisk = $policy->risks()->where('risk_name', $risk['name'])->first();
            if ($currRisk) {
                //dump($traveler);
                $currRisk->risk_amount = array_get($risk, 'risk_amount');
                $currRisk->save();
            }
        }

        //dd($policy);
        //dd($this->request['travelers']);
        //dd($policy->travelers()->get());

        return redirect('/home/policies');
    }

    public function delete (Policy $policy) {
        $this->authorize('destroy', $policy);

        $policy->delete();

        return redirect('/home');
    }
}
