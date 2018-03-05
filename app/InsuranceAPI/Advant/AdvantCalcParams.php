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
    
    public $policyId;

    function __construct($request)
    {
        $this->request = $request;
        $this->policyId = $request['policeId'] ?? 0;
        

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
            'name' => 'test policy'
        ];


        $this->insureds = [];
        foreach ($request['travelers'] as $traveler) {
            if (array_key_exists('accept', $traveler) && $traveler['accept'] === 'true')

                $this->insureds[] = [
                    'age' => $traveler['age'] ?? '30'
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
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $request['radio_currency'])
                        ];
                        break;
                    case 'public':
                        $this->public = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $request['radio_currency'])
                        ];
                        break;
                    case 'cancel':
                        $this->cancel = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $request['radio_currency'])
                        ];
                        break;
                    case 'accident':
                        $this->accident = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $request['radio_currency'])
                        ];
                        break;
                    case 'laggage':
                        $this->laggage = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $request['radio_currency']),
                            'accomodation' => 1
                        ];
                        break;
                }
                $this->risks[] = [
                    'riskUID' => AdvantDirect::getRiskUID($risk['name']),
                    'amountAtRisk' => $risk['amountAtRisk'],
                    'amountCurrency' => $risk['amountCurrency'] ?? $request['radio_currency']
                ];
            }
        }

    }

    public function getCalcParams()
    {
        return [
            //'test' => $isTest,
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

    public function getBuyParams()
    {
        return [
            //"policyId" => $this->policyId,
            "object_type"=>"vzr",
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
            "insurants_vzr"=>[
                [
                    "first_name"=>"PEKKA",
                    "id"=>3885,
                    "last_name"=>"KEKKONEN",
                    "birth_date"=>"1943-12-23",
                    "international_passport_series_number"=>"11554 5444646",
                    "address"=>[],
                    "contact"=>[],
                    "credential"=>[
                        "credential_type"=>18,"number"=>"11554 5444646","external_id"=>238,"series"=>"Нет"
                    ],
                    "external_id"=>5844
                ],
                [
                    "first_name"=>"MARTTI",
                    "id"=>3886,
                    "last_name"=>"AKHTISAARI",
                    "birth_date"=>"1937-06-27",
                    "international_passport_series_number"=>"5435435 32464326",
                    "address"=>[],
                    "contact"=>[],
                    "credential"=>[
                        "credential_type"=>18,"number"=>"5435435 32464326","external_id"=>7692,"series"=>"Нет"
                    ],
                    "external_id"=>1559
                ],
                [
                    "first_name"=>"SAULE",
                    "id"=>3887,
                    "last_name"=>"NIISTE",
                    "birth_date"=>"1964-09-17",
                    "international_passport_series_number"=>"5445 4545235",
                    "address"=>[],
                    "contact"=>[],
                    "credential"=>[
                        "credential_type"=>18,"number"=>"5445 4545235","external_id"=>7089,"series"=>"Нет"
                    ],
                    "external_id"=>8736
                ]
            ]

        ];

        //return $options;
    }
}