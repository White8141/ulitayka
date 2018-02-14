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

        $this->countries = $request['countries'];
        $this->additionalConditions = [];

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

        $this->countryUIDs = [];
        foreach ($request['countries'] as $country) {
            $this->countryUIDs['countryUID'] = AdvantDirect::getCountryUID($country);
        }

        $this->additionalConditionsUIDs = [];
        foreach ($request['additionalConditions'] ?? [] as $additionalCondition) {
            //$this->additionalConditionsUIDs[] = AdvantDirect::getAdditionalConditionUID($additionalCondition);
            if ((string)$additionalCondition['check'] === 'true') {
                $this->additionalConditionsUIDs[] = AdvantDirect::getAdditionalConditionUID($additionalCondition['name']);
            }
        }


        $this->risks = [];
        foreach ($request['risks'] ?? [['name' => 'medical', 'check' => 'true', 'amountAtRisk' => 30000, 'amountCurrency' => 'EUR']] as $risk) {
            if ((string)$risk['check'] === 'true') {
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
            'insurance_country' => [ '54727' ],
            'additional_risk' => '54758',
            'insurance_type' => '54452',
            'medical_expenses' => [
                'insurance_plan' => '54748',
                'insurance_amount' => '35000',
                'insurance_currency' => '46212' ],
            'luggage_expenses' => null,
            'occurrence_expenses' => null,
            'legal_liability_expenses' => null,
            'trip_cancellation_expenses' => null,
            'insurants_set' => $this->insureds
        ];

        //return $options;
    }
}