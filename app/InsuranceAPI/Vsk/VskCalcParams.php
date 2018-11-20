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

        $this->countries = VskDirect::getCountryUID($request['countries'][0]['country_name'] ?? 'SCHENGEN');

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
        foreach ($request['risks'] ?? [['name' => 'medical', 'accept' => 'true', 'amountAtRisk' => 50000, 'amountCurrency' => 'EUR']] as $risk) {
            if (array_key_exists('accept', $risk) && (string)$risk['accept'] === 'true') {
                $this->risks[] = [
                    'RiskId' => VskDirect::getRiskUID($risk['name']),
                    'RiskVariantId' => VskDirect::getRiskVariantUID($risk['name'], $request['countries'][0]['country_name'] ?? 'SCHENGEN'),
                    'amountAtRisk' => $risk['amountAtRisk'],
                    'amountCurrency' => $risk['amountCurrency'] ?? $request['policy_currency']
                ];
            }
        }

        $this->additionalConditionsUIDs = [];
        foreach ($request['additionalConditions'] ?? [] as $additionalCondition) {
            if (array_key_exists('accept', $additionalCondition) && (string)$additionalCondition['accept'] === 'true') {
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
                                        'tag' => 'AddressTel',
                                        'content' => '5123123123'
                                    ],
                                    [
                                        'tag' => 'PolicyNumber',
                                        'content' => ''
                                    ],
                                    [
                                        'tag' => 'InsuranceProgrammId',
                                        'content' => ''//   InsuranceProgrammId
                                    ],
                                    [
                                        'tag' => 'UsdRate',
                                        'content' => ''
                                    ],
                                    [
                                        'tag' => 'EurRate',
                                        'content' => ''
                                    ],
                                    [
                                        'tag' => 'AdditionalCondition',
                                        'content' => '8cd88f7f-fa17-41bf-a214-379baa90598d'
                                    ],
                                    [
                                        'tag' => 'DtCreated',
                                        'content' => date("11.11.2018")
                                    ],
                                    [
                                        'tag' => 'PolicyPeriodFrom',
                                        //'content' => $this->policyPeriodFrom
                                        'content' => date("01.12.2019")
                                    ],
                                    [
                                        'tag' => 'PolicyPeriodTill',
                                        //'content' => $this->policyPeriodTill
                                        'content' => date("31.12.2019")
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
                                'elements' => [ ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

    }

    public function getCalcParams()
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
                    ],
                    [
                        'tag' => 'Passport',
                        'content' => ''
                    ]
                ]
            ];
        }

        foreach($this->risks as $risk) {
            $risks[] = [
                'tag' => 'Risk',
                'elements' => [
                    [
                        'tag' => 'RiskId',
                        'content' => $risk['RiskId']
                    ],
                    [
                        'tag' => 'RiskVariantId',
                        'content' => $risk['RiskVariantId']
                    ],
                    [
                        'tag' => 'AmountAtRisk',
                        'content' => $risk['amountAtRisk']
                    ],
                    [
                        'tag' => 'AmountCurrency',
                        'content' => $risk['amountCurrency']
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
                'xml' => $xmlString
            ]
        ];
    }
}