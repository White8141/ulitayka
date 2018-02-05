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
    public $client;
    public $insuredsCount;
    public $insureds;

    public $countryUIDs;
    public $additionalConditionsUIDs;
    public $riskUIDs;

    function __construct($request)
    {
        $this->request = $request;

        $this->countries = $request['countries'];
        $this->additionalConditions = [];
        $this->policyPeriodFrom = $request['dateFrom'] ?? date('Y-m-d') . 'T00:00:00';
        $this->policyPeriodTill = $request['dateTill'] ?? date('Y-m-d', strtotime('+1 month')) . 'T00:00:00';
        $this->client = [
            'name' => 'Testov Petr'
        ];


        $this->insureds = [];
        foreach ($request['travelers'] as $traveler) {
            if (isset($traveler['accept']) && $traveler['accept'] === 'true')

                $this->insureds['insured'] = [
                    'FIO' => ($traveler['firstName']  ?? 'Stan').' '.($traveler['lastName'] ?? 'Marsh'),
                    'DateOfBirth' => $traveler['birthDate'] ?? date('Y-m-d', strtotime('-' . $traveler['age'] . ' year')) . 'T00:00:00'
                ];

            /**$this->insureds[] = [
            'fio' => 'Vova Putin',
            'dateOfBirth' =>  date('Y-m-d', strtotime('-' . $traveler['age'] . ' year')) . 'T00:00:00'
            ];*/
        }

        $this->countryUIDs = [];
        foreach ($request['countries'] as $country) {
            $this->countryUIDs['countryUID'] = VskDirect::getCountryUID($country);
        }

        $this->additionalConditionsUIDs = [];
        foreach ($request['additionalConditions'] ?? [] as $additionalCondition) {
            if ((string)$additionalCondition['check'] === 'true') {
                $this->additionalConditionsUIDs[] = VskDirect::getAdditionalConditionUID($additionalCondition['name']);
            }
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
    }

    public function getCalcParams($operation)
    {
        $params = new \SoapVar('<Policies><Policy><Common><sUserId>f24230cc-cfc3-4ec5-8d7d-e3d72e0d6dc8</sUserId><DtCreated>21.05.2014</DtCreated><PolicyPeriodFrom>21.05.2014</PolicyPeriodFrom><PolicyPeriodTill>03.06.2014</PolicyPeriodTill><Days>14</Days><Country>9a12524e-0c2e-471a-a7eb-66bb0f0676c5</Country><FIO>DERYABINA ANASTASIA</FIO><DateOfBirth>21.08.1985</DateOfBirth></Common></Policy></Policies>', XSD_ANYXML);

        return [
            [
                'sUserId' => 'F24230CC-CFC3-4EC5-8D7D-E3D72E0D6DC8',
                'xml' => $params
                //'xml' => ""
                            /*<Insureds>
                            <Insured>
                            <FIO>DERYABINA ANASTASIA</FIO>
                            <DateOfBirth>21.08.1985</DateOfBirth>
                            <Passport>71 4212577</Passport>
                            </Insured>
                            <Insured>
                            <FIO>DERIABIN EVGENII</FIO>
                            <DateOfBirth>19.01.1981</DateOfBirth>
                            <Passport>65 0472109</Passport>
                            </Insured>
                            <Insured>
                            <FIO>DERYABIN VLADIMIR</FIO>
                            <DateOfBirth>05.02.2010</DateOfBirth>
                            <Passport>71 4059601</Passport>
                            </Insured>
                            </Insureds>
                            <Risks>
                            <Risk>
                            <RiskId>8d98d27c-3202-492e-81ba-d5fe6f0bbc7c</RiskId>
                            <RiskVariantId>c6ee4b03-1239-40f1-bec0-d20654555d4b</RiskVariantId>
                            <AmountAtRisk>30000</AmountAtRisk>
                            <AmountCurrency>USD</AmountCurrency>
                            <PremCurrency>1000</PremCurrency>
                            <PremRur>65464</PremRur>
                            <FranchiseTypeId>5758902F-52CA-4A5E-8D81-99B47B9624C8</FranchiseTypeId>
                            <FranchiseValue>50</FranchiseValue>
                            </Risk>
                            <Risk>
                            <RiskId>303a03ef-5a6e-45e1-8b3d-14cf1a863144</RiskId>
                            <RiskVariantId>37be7a9d-9f98-4fc0-b156-9a5c5096f830</RiskVariantId>
                            <AmountAtRisk>10000</AmountAtRisk>
                            <AmountCurrency>USD</AmountCurrency>
                            <PremCurrency/>
                            <PremRur/>
                            <FranchiseTypeId/>
                            <FranchiseValue/>
                            </Risk>
                            </Risks>
                            */

                    /*[ 'Policies' => [
                        'Policy' => [
                            'Common' => [
                                'sUserId' => 'F24230CC-CFC3-4EC5-8D7D-E3D72E0D6DC8',
                                'DtCreated' => '02.02.2018',
                                'PolicyPeriodFrom' => '05.02.2018',
                                'PolicyPeriodTill' => '12.02.2018',
                                'Days' => '7',
                                'Country' => '9a12524e-0c2e-471a-a7eb-66bb0f0676c5',
                                'FIO' => $this->client['name'],
                                'DateOfBirth' => '01.01.1980'
                                //'operation' => $operation


                            ],
                            'Insureds' => $this->insureds,
                            'Risks' => $this->risks
                            //'additionalConditions' => $this->additionalConditionsUIDs
                        ]
                    ]*/
                //]
            ]
        ];
    }
}