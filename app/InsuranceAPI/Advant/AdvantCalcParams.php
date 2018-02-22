<?php
/**
 * Created by PhpStorm.
 * User: CTAC
 * Date: 08.02.2018
 * Time: 10:52
 */

namespace App\InsuranceAPI\Advant;

use Illuminate\Http\Request;
//use App\InsuranceAPI\Advant\AdvantDirect;

class AdvantCalcParams
{
    public $request;

    public $countries;
    public $additionalConditions;
    public $risks;
    public $policyPeriodFrom;
    public $policyPeriodTill;
    public $client;
    public $insureds;

    public $countryUIDs;
    public $additionalConditionsUIDs;
    public $riskUIDs;

    function __construct($request)
    {
        $this->request = $request;

        $this->additionalConditions = [];

        $this->countries = [];
        foreach ($request['countries'] ?? ['SCHENGEN'] as $country) {
            $this->countries[] = AdvantDirect::getCountryUID((string)$country);
        }
        //$this->countries = $request['countries'];

        if (isset($request['dateFrom'])) { $this->policyPeriodFrom = date("Y-m-d", strtotime($request['dateFrom'])); }
        else { $this->policyPeriodFrom = date('Y-m-d'); }

        if (isset($request['dateTill'])) { $this->policyPeriodTill = date("Y-m-d", strtotime($request['dateTill'])); }
        else { $this->policyPeriodTill = date('Y-m-d', strtotime('+1 month')); }

        $this->policyDays = date_diff(new \DateTime($this->policyPeriodTill), new \DateTime($this->policyPeriodFrom))->format('%a');

        $this->client = [
            'name' => 'Testov Petr'
        ];


        $this->insureds = [];
        foreach ($request['travelers'] as $traveler) {
            if (isset($traveler['accept']) && $traveler['accept'] === 'true')

                $this->insureds[] = [
                    'age' => $traveler['age'] ?? '30'
                ];

        }

       /*$this->countryUIDs = [];
        foreach ($request['countries'] ?? ['SCHENGEN'] as $country) {
            $this->countryUIDs['countryUID'] = AdvantDirect::getCountryUID($country);
        }*/

        $this->additionalConditionsUIDs = [];
        foreach ($request['additionalConditions'] ?? [] as $additionalCondition) {
            //$this->additionalConditionsUIDs[] = AdvantDirect::getAdditionalConditionUID($additionalCondition);
            if ((string)$additionalCondition['accept'] === 'true') {
                $this->additionalConditionsUIDs[] = AdvantDirect::getAdditionalConditionUID($additionalCondition['name']);
            }
        }


        $this->medical = null;
        $this->public = null;
        $this->cancel = null;
        $this->accident = null;
        $this->laggage = null;

        $this->risks = [];
        foreach ($request['risks'] ?? [['name' => 'medical', 'accept' => 'true', 'amountAtRisk' => 50000, 'amountCurrency' => 'EUR']] as $risk) {
            if ((string)$risk['accept'] === 'true') {
                switch ((string)$risk['name']) {
                    case 'medical':
                        $this->medical = [
                            'insurance_plan' => '54748',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'])
                        ];
                        break;
                    case 'public':
                        $this->public = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'])
                        ];
                        break;
                    case 'cancel':
                        $this->cancel = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'])
                        ];
                        break;
                    //
                    case 'accident':
                        $this->accident = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'])
                        ];
                        break;
                    case 'laggage':
                        $this->laggage = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency']),
                            'accomodation' => 1
                        ];
                        break;

                }
                $this->risks[] = [
                    'riskUID' => AdvantDirect::getRiskUID($risk['name']),
                    'amountAtRisk' => $risk['amountAtRisk'],
                    'amountCurrency' => $risk['amountCurrency']
                ];
            }
        }

    }

    public function getCalcParams()
    {
        return [
            'is_multiple_policy' => false,
            'valid_from' => $this->policyPeriodFrom,
            'valid_to' => $this->policyPeriodTill,
            'insurance_days_up_to' => $this->policyDays,
            'insurance_territory' => [ ],
            'insurance_country' => $this->countries,
            //'additional_risk' => '54758',
            'insurance_type' => '54452',
            'medical_expenses' => $this->medical,
            'luggage_expenses' => $this->laggage,
            'occurrence_expenses' => $this->accident,
            'legal_liability_expenses' => $this->public,
            'trip_cancellation_expenses' => $this->cancel,
            'insurants_set' => $this->insureds
        ];

        //return $options;
    }
}