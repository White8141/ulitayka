<?php
/**
 * Created by PhpStorm.
 * User: White
 * Date: 01.02.2018
 * Time: 12:48
 */

namespace App\InsuranceAPI\Vsk;

use App\InsuranceAPI\Vsk\VskDirect;
use Illuminate\Http\Request;

class VskCalcParams
{
    public $request;

    public $countries;
    public $additionalConditions;
    public $risks;
    public $policyPeriodFrom;
    public $policyPeriodTill;
    public $policyDays;
    public $client;
    public $insuredsCount;
    public $insureds;

    public $countryUIDs;
    public $additionalConditionsUIDs;
    public $riskUIDs;

    public $xmlArray;

    function __construct($request)
    {
        $this->request = $request;

        $this->client = [ 'name' => 'Testov Petr' ];

        $this->countries = VskDirect::getCountryUID($request['countries'][0]);

        if (isset($request['dateFrom'])) { $this->policyPeriodFrom = date("d.m.Y", strtotime($request['dateFrom'])); }
        else { $this->policyPeriodFrom = date('d.m.Y'); }

        if (isset($request['dateTill'])) { $this->policyPeriodTill = date("d.m.Y", strtotime($request['dateTill'])); }
        else { $this->policyPeriodTill = date('d.m.Y', strtotime('+1 month')); }

        $this->policyDays = date_diff(new \DateTime($this->policyPeriodTill), new \DateTime($this->policyPeriodFrom))->format('%a');

        $this->insureds = [];
        foreach ($request['travelers'] as $traveler) {
            if (isset($traveler['accept']) && $traveler['accept'] === 'true')

                $this->insureds[] = [
                    'FIO' => ($traveler['firstName']  ?? 'Stan').' '.($traveler['lastName'] ?? 'Marsh'),
                    'DateOfBirth' => $traveler['birthDate'] ?? date('d.m.Y', strtotime('-' . $traveler['age'] . ' year'))
                ];

        }

        $this->risks = [];
        foreach ($request['risks'] ?? [['name' => 'medical', 'check' => 'true', 'amountAtRisk' => 30000, 'amountCurrency' => 'EUR']] as $risk) {
            if ((string)$risk['check'] === 'true') {
                $this->risks['risk'] = [
                    'RiskId' => VskDirect::getRiskUID($risk['name']),
                    'RiskVariantId' => VskDirect::getRiskUID($risk['name']),
                    'amountAtRisk' => $risk['amountAtRisk'],
                    'amountCurrency' => $risk['amountCurrency']
                ];
            }
        }

        $this->additionalConditionsUIDs = [];
        foreach ($request['additionalConditions'] ?? [] as $additionalCondition) {
            if ((string)$additionalCondition['check'] === 'true') {
                $this->additionalConditionsUIDs[] = VskDirect::getAdditionalConditionUID($additionalCondition['name']);
            }
        }

        $this->additionalConditions = [];

        $this->xmlArray = [
            [
                'tag' => 'Policies',
                'elements' => [
                    [
                        'tag' => 'Policy',
                        'elements' => [
                            [
                                'tag' => 'Common',
                                'elements' => [
                                    [
                                        'tag' => 'UserId',
                                        'content' => 'F24230CC-CFC3-4EC5-8D7D-E3D72E0D6DC8'
                                    ],
                                    [
                                        'tag' => 'DtCreated',
                                        'content' => date("d.m.Y")
                                    ],
                                    [
                                        'tag' => 'PolicyPeriodFrom',
                                        'content' => $this->policyPeriodFrom
                                    ],
                                    [
                                        'tag' => 'PolicyPeriodTill',
                                        'content' => $this->policyPeriodTill
                                    ],
                                    [
                                        'tag' => 'Days',
                                        'content' => $this->policyDays
                                    ],
                                    [
                                        'tag' => 'Country',
                                        'content' => $this->countries

                                    ],
                                    [
                                        'tag' => 'FIO',
                                        'content' => $this->client['name']
                                    ],
                                    [
                                        'tag' => 'DateOfBirth',
                                        'content' => '01.01.1980'
                                    ]
                                ]
                            ],
                            [
                                'tag' => 'Insureds',
                                'elements' => [ ]
                            ],
                            [
                                'tag' => 'Risks',
                                'elements' => [
                                    [
                                        'tag' => 'Risk',
                                        'elements' => [
                                            [
                                                'tag' => 'RiskId',
                                                'content' => '8d98d27c-3202-492e-81ba-d5fe6f0bbc7c'
                                            ],
                                            [
                                                'tag' => 'RiskVariantId',
                                                'content' => 'c6ee4b03-1239-40f1-bec0-d20654555d4b'
                                            ],
                                            [
                                                'tag' => 'AmountAtRisk',
                                                'content' => '30000'
                                            ],
                                            [
                                                'tag' => 'AmountCurrency',
                                                'content' => 'EUR'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];



    }

    public function getCalcParams($operation)
    {
        $insureds = [];
        $risks = [];
        foreach($this->insureds as $insured) {
            $insureds[] = [
                'tag' => 'Insured',
                'elements' => [
                    [
                        'tag' => 'FIO',
                        'content' => $insured['FIO']
                    ],
                    [
                        'tag' => 'DateOfBirth',
                        'content' => $insured['DateOfBirth']
                    ]
                ]
            ];

            $risks[] = [
                'tag' => 'Risk',
                'elements' => [
                    [
                        'tag' => 'RiskId',
                        'content' => '8d98d27c-3202-492e-81ba-d5fe6f0bbc7c'
                    ],
                    [
                        'tag' => 'RiskVariantId',
                        'content' => 'c6ee4b03-1239-40f1-bec0-d20654555d4b'
                    ],
                    [
                        'tag' => 'AmountAtRisk',
                        'content' => '30000'
                    ],
                    [
                        'tag' => 'AmountCurrency',
                        'content' => 'EUR'
                    ]
                ]
            ];
        }
        $this->xmlArray[0]['elements'][0]['elements'][1]['elements'] = $insureds;
        $this->xmlArray[0]['elements'][0]['elements'][2]['elements'] = $risks;

        $xmlString = (new \bupy7\xml\constructor\XmlConstructor(['startDocument' => false]))->fromArray($this->xmlArray)->toOutput();

        return [
            [
                'sUserId' => 'F24230CC-CFC3-4EC5-8D7D-E3D72E0D6DC8',
                'xml' => $this->xmlArray
            ]
        ];
    }
}