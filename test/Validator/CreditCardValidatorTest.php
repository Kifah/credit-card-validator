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
        $formattedYearInFuture=(int)$oneYearInFuture->format('Y');
        return [
            'monthOver12' => [
                ['number' => '4716540558964740', 'month' => 13, 'year' => $formattedYearInFuture],
                false
            ],
            'monthWithinRange' => [
                ['number' => '4716540558964740', 'month' => 12, 'year' => $formattedYearInFuture],
                true
            ], 'monthBelowOne' => [
                ['number' => '4716540558964740', 'month' => 0, 'year' => $formattedYearInFuture],
                false
            ]
            , 'yearInvalidInPast' => [
                ['number' => '4716540558964740', 'month' => 12, 'year' => 2019],
                false
            ],
            'combinedMonthYearInvalid' => [
                ['number' => '4716540558964740', 'month' => 5, 'year' => 2020],
                false
            ],
            'combinedMonthYearValid' => [
                ['number' => '4716540558964740', 'month' => 5, 'year' => $formattedYearInFuture],
                true
            ],
        ];

    }
}
