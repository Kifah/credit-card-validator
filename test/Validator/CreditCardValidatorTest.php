<?php

namespace Validator;

use DateTime;
use PHPUnit\Framework\TestCase;

class CreditCardValidatorTest extends TestCase
{

    /**
     * @dataProvider creditCardProvider
     * @param array $creditCardArray
     * @param bool $result
     */
    public function testValidate(array $creditCardArray, bool $result)
    {
        $validator = new CreditCardValidator();
        $isValid = $validator->validate($creditCardArray);
        $this->assertEquals($result, $isValid);

    }

    public function creditCardProvider()
    {
        $oneYearInFuture = new DateTime('+1 year');
        $formattedYearInFuture = (int)$oneYearInFuture->format('Y');
        return [
            'monthOver12' => [
                ['number' => '3538800247772065533', 'month' => 13, 'year' => $formattedYearInFuture],
                false
            ],
            'monthWithinRange' => [
                ['number' => '3538800247772065533', 'month' => 12, 'year' => $formattedYearInFuture],
                true
            ], 'monthBelowOne' => [
                ['number' => '3538800247772065533', 'month' => 0, 'year' => $formattedYearInFuture],
                false
            ]
            , 'yearInvalidInPast' => [
                ['number' => '3538800247772065533', 'month' => 12, 'year' => 2019],
                false
            ],
            'combinedMonthYearInvalid' => [
                ['number' => '3538800247772065533', 'month' => 5, 'year' => 2020],
                false
            ],
            'combinedMonthYearValid' => [
                ['number' => '3538800247772065533', 'month' => 5, 'year' => $formattedYearInFuture],
                true
            ],

            'creditCardNumberInvalid1' => [
                ['number' => '353880024777206553', 'month' => 5, 'year' => $formattedYearInFuture],
                false
            ],

            'creditCardNumberValid1' => [
                ['number' => '4485660890868604', 'month' => 5, 'year' => $formattedYearInFuture],
                true
            ], 'creditCardNumberValid2' => [
                ['number' => '4556738307601992', 'month' => 5, 'year' => $formattedYearInFuture],
                true
            ],

        ];

    }
}
