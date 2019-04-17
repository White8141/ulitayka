<?php

namespace App\Http\Controllers;

use App\InsuranceAPI\InsuranceCalc;
use App\Policy;
use App\Repositories\PolicyRepository;
use App\Traveler;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function __construct(PolicyRepository $policies, InsuranceCalc $insuranceCalc, Request $request) {
        $this->middleware('auth');

        $this->request = $request;
        $this->policies = $policies;
        $this->insuranceCalc = $insuranceCalc;

    }
    
    /**
     * Создание нового полиса
     *
     * @return Response
     */
    public function create()
    {
        //dd($this->insuranceCalc->getInsuranseData($this->request, true));
        dd($this->request->all());

        $this->validate($this->request, [
            'companyId' => 'required|max:255',
        ]);

        $policy = $this->request->user()->policies()->create([
            'policy_name' => $this->request->name,
            'company_id' => $this->request->companyId,
            'policy_period_from' => $this->request->dateFrom,
            'policy_period_till' => $this->request->dateTill,
            'policy_cost' => $this->request->policeAmount,
            'policy_currency' => $this->request->policy_currency,
            'additional_condition_0' => $this->request->has('additionalConditions.0.accept') ? true : false,
            'additional_condition_1' => $this->request->has('additionalConditions.1.accept') ? true : false,
            'additional_condition_2' => $this->request->has('additionalConditions.2.accept') ? true : false,
            'link' => '/'
        ]);

        foreach ($this->request->countries as $country) {
            $policy->countries()->create([
                'country_name' => $country['countryName']
            ]);
        }
        $policy->countries;

        foreach ($this->request->travelers as $traveler) {
            if (array_get($traveler, 'accept')) {
                $birhDate = new Carbon('-'.array_get($traveler, 'age').' years');
                $policy->travelers()->create([
                    'birth_date' => $birhDate->format('d.m.Y')
                ]);
            }
        }
        $policy->travelers;

        foreach ($this->request->risks as $risk) {
            if (array_get($risk, 'accept')) {
                $policy->risks()->create([
                    'risk_name' => array_get($risk, 'name'),
                    'risk_amount' => array_get($risk, 'risk_amount'),
                ]);
            }
        }
        $policy->risks;

        return redirect()->route('policy_edit', [$policy]);
        //dd($policy);
        /*return view('policies/police_edit')->with([ 'defaultData' => json_encode($policy),
                                                    'companyId' => strval($policy->company_id)
                                                ]);*/
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
                                                    'user' => $this->request->user(),
                                                    'status' => $policy->status
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
        //dd($this->request->all());
        //dd($policy->travelers()->get());
        if ($this->request->input('needBuy') && $this->request->input('needBuy') == 'true') {
            return redirect()->route('policy_buy', [$policy]);
        } else {
            return redirect('/home/policies');
            //return redirect('policies/police_buy')->with(['policy' => $policy]);
        }
    }

    public function buy (Policy $policy) {
        $this->authorize('buy', $policy);

        //dd($policy);

        return view('policies/police_buy')->with(['policy' => $policy]);
    }

    /**
     * создает чек с ключом, передает этот ключ в сессию и перенаправляет запрос на API Яндекс.Деньги
     * @param Policy $policy
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trans (Policy $policy) {
        //dd($policy);

        $temp = str_random(20);

        $policy->checks()->create([
            'check_cost' => $policy->policy_cost,
            'check_key' => $temp
        ]);

        //return redirect()->away('/policy/done/'.$policy->id, 307)->with(['paymentKey' => $temp]);
        return redirect()->away('https://money.yandex.ru/quickpay/confirm.xml', 307)->with(['paymentKey' => $temp]);
    }

    public function done (Policy $policy) {

        //dd($this->request);

        if ($this->request->session()->has('paymentKey')) {

            $checks = $policy->checks()->get()->filter(function ($item) {
                return $item->check_key == $this->request->session()->get('paymentKey');
            });

            if (!$checks->isEmpty()) {
                    //echo ('Есть одни чек '.$this->request->session()->get('paymentKey'));
                    $check = $checks->first();
                    $check->check_status = 1;
                    $check->save();

                    $policy->status = "2";
                    $policy->save();

                    return redirect()->route('policy_edit', ['policy' => $policy]);
            } else {
                return redirect('/');
                //echo ('Нет таких чеков '.$this->request->session()->get('paymentKey'));
            }

        } else {
            return redirect('/');
            //echo ('Доступ запрещен');
        }
    }

    public function delete (Policy $policy) {
        $this->authorize('destroy', $policy);

        $policy->delete();

        return redirect('/home');
    }
}
