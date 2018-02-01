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
            'name' => 'Vova Putin'
        ];


        $this->insureds = [];
        foreach ($request['travelers'] as $traveler) {
            if (isset($traveler['accept']) && $traveler['accept'] === 'true')

                $this->insureds[] = [
                    'fio' => ($traveler['firstName']  ?? 'Stan').' '.($traveler['lastName'] ?? 'Marsh'),
                    'dateOfBirth' => $traveler['birthDate'] ?? date('Y-m-d', strtotime('-' . $traveler['age'] . ' year')) . 'T00:00:00'
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
                $this->risks[] = [
                    'riskUID' => VskDirect::getRiskUID($risk['name']),
                    'amountAtRisk' => $risk['amountAtRisk'],
                    'amountCurrency' => $risk['amountCurrency']
                ];
            }
        }
    }

    public function getCalcParams($operation)
    {
        return [
            [
                'policy' => [
                    'common' => [
                        'userId' => '9B724100-83B5-4EA0-9F55-452C07D131AE',
                        'userLogin' => 'AS_test',
                        'userPSW' => '8Pq7YS3V',
                        'insuranceProgrammUID' => 'bae89816-a75b-4d82-8741-409f42de0876',
                        'operation' => $operation,

                        'policyPeriodFrom' => $this->policyPeriodFrom,
                        'policyPeriodTill' => $this->policyPeriodTill,
                        'fio' => $this->client['name'],
                    ],
                    'insureds' => $this->insureds,
                    'risks' => $this->risks,
                    'countryUIDs' => $this->countryUIDs,
                    'additionalConditions' => $this->additionalConditionsUIDs
                ]

            ]
        ];
    }
}