<?php

namespace App\InsuranceAPI\Advant;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
    
    public $policyId;

    function __construct($request)
    {
        /*if (isset($request['dateFrom'])) { $this->policyPeriodFrom = date("Y-m-d", strtotime($request['dateFrom'])); }
        else { $this->policyPeriodFrom = date('Y-m-d'); }

        if (isset($request['dateTill'])) { $this->policyPeriodTill = date("Y-m-d", strtotime($request['dateTill'])); }
        else { $this->policyPeriodTill = date('Y-m-d', strtotime('+1 month')); }*/
    }

    public function getCalcParams($request)
    {
        $this->request = $request;

        $this->additionalConditions = [];

        $this->countries = [];
        //dd($request['countries']);
        foreach ($request['countries'] ?? ['SCHENGEN'] as $country) {
            $this->countries[] = AdvantDirect::getCountryUID((string)$country['countryName']);
        }
        //$this->countries = $request['countries'];

        $this->client = [
            'name' => 'test policy'
        ];

        $this->insureds = [];
        foreach ($request['travelers'] as $traveler) {
            if (array_key_exists('accept', $traveler) && $traveler['accept'] === 'true')

                $this->insureds[] = [
                    'birth_date' => date('Y-m-d', strtotime('-' . $traveler['age'] . ' year'))  //$traveler['age'] ?? '30'
                ];

        }

        $this->additionalConditionsUIDs = [];
        foreach ($request['additionalConditions'] ?? [] as $additionalCondition) {
            //$this->additionalConditionsUIDs[] = AdvantDirect::getAdditionalConditionUID($additionalCondition);
            if (array_key_exists('accept', $additionalCondition) && (string)$additionalCondition['accept'] === 'true') {
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
            if (array_key_exists('accept', $risk) && (string)$risk['accept'] === 'true') {
                switch ((string)$risk['name']) {
                    case 'medical':
                        $this->medical = [
                            'insurance_plan' => '54748',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $request['policy_currency'])
                        ];
                        break;
                    case 'public':
                        $this->public = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $request['policy_currency'])
                        ];
                        break;
                    case 'cancel':
                        $this->cancel = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $request['policy_currency'])
                        ];
                        break;
                    case 'accident':
                        $this->accident = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $request['policy_currency'])
                        ];
                        break;
                    case 'laggage':
                        $this->laggage = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $request['policy_currency']),
                            'accomodation' => 1
                        ];
                        break;
                }
                $this->risks[] = [
                    'riskUID' => AdvantDirect::getRiskUID($risk['name']),
                    'amountAtRisk' => $risk['amountAtRisk'],
                    'amountCurrency' => $risk['amountCurrency'] ?? $request['policy_currency']
                ];
            }
        }

        $this->policyPeriodFrom = Carbon::createFromFormat('Y-m-d', $request['dateFrom'])->addYear(1);//->toDateString();
        $this->policyPeriodTill = Carbon::createFromFormat('Y-m-d', $request['dateTill'])->addYear(1);//->toDateString();
        //$this->policyDays = date_diff(new \DateTime($this->policyPeriodTill), new \DateTime($this->policyPeriodFrom))->format('%a');
        $this->policyDays = $this->policyPeriodTill->diffInDays($this->policyPeriodFrom, true);

        return [
            //'test' => $isTest,
            'is_multiple_policy' => false,
            'valid_from' => $this->policyPeriodFrom->toDateString(),
            'valid_to' => $this->policyPeriodTill->toDateString(),
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

    public function getBuyParams($request)
    {
        $this->policyId = $request['policeId'] ?? 0;

        return [
            'validFrom' => $this->policyPeriodFrom.'T00:00:00',
            'validTo' => $this->policyPeriodTill.'T23:59:59',
            "policyId" => $this->policyId,

            "person"=>[
                [
                    "role"=>["insurant"],
                    "external_id"=>9961,
                    "natural_person"=>[
                        "full_name"=>"test policy",
                        "phone"=>"4165416818",
                        "passport"=>[
                            "issue_date"=>null,
                            "creator"=>10583,
                            "series"=>"11554",
                            "number"=>"5444646",
                            "object_id"=>3884,
                            "issue_point"=>null,
                            "credential_type"=>1,
                            "issue_point_code"=>null,
                            "content_type"=>482,
                            "expiration_date"=>null,
                            "external_id"=>5926,
                            "id"=>9443
                        ],
                        "address_registration"=>[
                            "postal_index"=>null,
                            "city"=>"Нет",
                            "apartment"=>null,
                            "address_date"=>null,
                            "country"=>null,
                            "region"=>null,
                            "creator"=>10583,
                            "object_id"=>3884,
                            "street"=>"RF, Saint-Petersburg","flat"=>"Нет",
                            "kladr"=>null,
                            "content_type"=>482,
                            "house"=>"Нет",
                            "address_type"=>1,
                            "id"=>3502,
                            "structure"=>null,
                            "housing"=>null,
                            "full"=>"Нет, RF, Saint-Petersburg, д.Нет, Нет"
                        ],
                        "citizenship"=>"Финляндия",
                        "id"=>3884,
                        "birth_date"=>"1943-12-23",
                        "first_name"=>"test",
                        "last_name"=>"policy",
                        "patronymic"=>"",
                        "address"=>[
                            "postal_index"=>null,
                            "city"=>"Нет",
                            "apartment"=>null,
                            "address_date"=>null,
                            "country"=>null,
                            "region"=>null,
                            "creator"=>10583,
                            "object_id"=>3884,
                            "street"=>"RF, Saint-Petersburg",
                            "flat"=>"Нет",
                            "kladr"=>null,
                            "content_type"=>482,
                            "house"=>"Нет",
                            "address_type"=>1,
                            "id"=>3502,
                            "structure"=>null,
                            "housing"=>null,
                            "full"=>"Нет, RF, Saint-Petersburg, д.Нет, Нет"
                        ],
                        "credential"=>[
                            "issue_date"=>null,
                            "creator"=>10583,
                            "series"=>"11554",
                            "number"=>"5444646",
                            "object_id"=>3884,
                            "issue_point"=>null,
                            "credential_type"=>1,
                            "issue_point_code"=>null,
                            "content_type"=>482,
                            "expiration_date"=>null,
                            "external_id"=>5926,
                            "id"=>9443
                        ],
                        "contact"=>[
                            "contact_type"=>1,"data"=>"4165416818"
                        ],
                        "external_id"=>3903
                    ]
                ]
            ],
            "insurants"=>[
                [
                    "first_name"=>"test",
                    "id"=>3885,
                    "last_name"=>"policy",
                    "birth_date"=>"1973-12-23",
                    "international_passport_series_number"=>"11554 5444646",
                    "address"=>[],
                    "contact"=>[],
                    "credential"=>[
                        "credential_type"=>18,"number"=>"11554 5444646","external_id"=>238,"series"=>""
                    ],
                    "external_id"=>5844
                ]

            ]

        ];

        //return $options;
    }
}