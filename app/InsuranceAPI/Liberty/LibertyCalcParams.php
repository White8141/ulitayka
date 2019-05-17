<?php

namespace App\InsuranceAPI\Liberty;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

//use App\InsuranceAPI\Advant\AdvantDirect;

class LibertyCalcParams
{
    public $request;
    private $pin = 45654;

    public $policyPeriodFrom;
    public $policyPeriodTill;
    public $policyDays;
    public $amount;
    public $currency;
    public $laggageNum = 0;
    public $risks = [];
    public $insureds = [];
    public $medical = 0;
    private $countries = [];

    function __construct($request)
    {
        $this->request = $request;
    }

    public function getCalcParams()
    {
        
        /*$this->additionalConditions = [];

        $this->insureds = [];
        foreach ($this->request['travelers'] as $traveler) {
            if (array_key_exists('accept', $traveler) && $traveler['accept'] === 'true')

                $this->insureds[] = [
                    'birth_date' => date('Y-m-d', strtotime('-' . $traveler['age'] . ' year'))  //$traveler['age'] ?? '30'
                ];

        }

        $this->additionalConditionsUIDs = [];
        foreach ($this->request['additionalConditions'] ?? [] as $additionalCondition) {
            //$this->additionalConditionsUIDs[] = AdvantDirect::getAdditionalConditionUID($additionalCondition);
            if (array_key_exists('accept', $additionalCondition) && (string)$additionalCondition['accept'] === 'true') {
                //$this->additionalConditionsUIDs[] = AdvantDirect::getAdditionalConditionUID($additionalCondition['name']);
            }
        }

        $this->risks = [];
        foreach ($this->request['risks'] ?? [['name' => 'medical', 'accept' => 'true', 'amountAtRisk' => 50000, 'amountCurrency' => 'EUR']] as $risk) {
            if (array_key_exists('accept', $risk) && (string)$risk['accept'] === 'true') {
                switch ((string)$risk['name']) {
                    case 'medical':
                        $this->medical = [
                            'insurance_plan' => '54748',
                            'insurance_amount' => $risk['amountAtRisk'],
                            //'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $this->request['policy_currency'])
                        ];
                        break;
                    case 'public':
                        $this->public = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $this->request['policy_currency'])
                        ];
                        break;
                    case 'cancel':
                        $this->cancel = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $this->request['policy_currency'])
                        ];
                        break;
                    case 'accident':
                        $this->accident = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $this->request['policy_currency'])
                        ];
                        break;
                    case 'laggage':
                        $this->laggage = [
                            'insurance_plan' => '54747',
                            'insurance_amount' => $risk['amountAtRisk'],
                            'insurance_currency' => AdvantDirect::getCurrencyUID($risk['amountCurrency'] ?? $this->request['policy_currency']),
                            'accomodation' => 1
                        ];
                        break;
                }
                $this->risks[] = [
                    //'riskUID' => AdvantDirect::getRiskUID($risk['name']),
                    'amountAtRisk' => $risk['amountAtRisk'],
                    'amountCurrency' => $risk['amountCurrency'] ?? $this->request['policy_currency']
                ];
            }
        }*/

        $this->policyPeriodFrom = Carbon::createFromFormat('d.m.Y', $this->request['dateFrom']);//->toDateString();
        $this->policyPeriodTill = Carbon::createFromFormat('d.m.Y', $this->request['dateTill']);//->toDateString();
        $this->policyDays = $this->policyPeriodTill->diffInDays($this->policyPeriodFrom, true);
        
        $this->amount = $this->request['risks'][0]['amountAtRisk'] ?? 50000;
        $this->currency = LibertyDirect::getCurrencyUID($this->request['risks'][0]['amountCurrency']) ?? 14;;

        foreach ($this->request['countries'] ?? ['SCHENGEN'] as $country) {
            if (LibertyDirect::getCountryUID($country['countryName'])) {
                $this->countries[] = [
                    'id_area' => LibertyDirect::getCountryUID((string)$country['countryName'])
                ];
            }
        }
        //$this->countries = $this->request['countries'];
        
        foreach ($this->request['additionalConditions'] ?? [] as $additionalConditions) {
            if ($additionalConditions['name'] == 'leisure' && (string)$additionalConditions['accept'] == 'true') $this->medical = 1;
            if ($additionalConditions['name'] == 'competition' && (string)$additionalConditions['accept'] == 'true') $this->medical = 50;
            if ($additionalConditions['name'] == 'extreme' && (string)$additionalConditions['accept'] == 'true') $this->medical = 3;
        }

        foreach ($this->request['travelers'] as $traveler) {
            if (array_key_exists('accept', $traveler) && ( $traveler['accept'] == 'true' || $traveler['accept'] == 'on'))

                $this->insureds[] = [
                    'birhDate' => Carbon::now()->subYear($traveler['age'])->toDateString()
                ];
        }

        $this->risks[] = ['id_risk' => 346,
                        'insuredSum' => [
                            'summ' => $this->amount,
                            'currency_id' => $this->currency
                        ]];
        foreach ($this->request['risks'] ?? [] as $risk) {
            if ($risk['name'] == 'public' && (string)$risk['accept'] == 'true') {
                $this->risks[] = [  'id_risk' => 267,
                                    'insuredSum' => [
                                        'summ' => $risk['amountAtRisk'],
                                        'currency_id' => $this->currency
                                    ]];
            }
            if ($risk['name'] == 'accident' && (string)$risk['accept'] == 'true') {
                $this->risks[] = [  'id_risk' => 71,
                    'insuredSum' => [
                        'summ' => $risk['amountAtRisk'],
                        'currency_id' => $this->currency
                    ]];
            }
            if ($risk['name'] == 'laggage' && (string)$risk['accept'] == 'true') {
                $this->laggageNum = count($this->insureds);
                $this->risks[] = [  'id_risk' => 355,
                    'insuredSum' => [
                        'summ' => $risk['amountAtRisk'],
                        'currency_id' => $this->currency
                    ]];
            }
            if ($risk['name'] == 'cancel' && (string)$risk['accept'] == 'true') {
                $this->laggageNum = count($this->insureds);
                $this->risks[] = [  'id_risk' => 351,
                    'insuredSum' => [
                        'summ' => $risk['amountAtRisk'],
                        'currency_id' => $this->currency
                    ]];
            }

        }

        return [
            'Vz_FullCalcRQ' => [
                "pin" => '45654',
                'productId' => 14075,
                'startDate' => $this->policyPeriodFrom->toDateString(),
                'endDate' => $this->policyPeriodTill->toDateString(),
                'number_of_days' => $this->policyDays,
                'insured_area' => $this->countries,
                'medical_option' => $this->medical,
                'number_of_lugg' => $this->laggageNum,
                'Risks' => $this->risks,
                'insuredPersons' => $this->insureds
            ]
        ];

        //return $options;
    }

    public function getBuyParams()
    {
        $this->policyId = $this->request['policeId'] ?? 0;

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