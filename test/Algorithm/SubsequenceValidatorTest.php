<?php

namespace Algorithm;

use PHPUnit\Framework\TestCase;

class SubsequenceValidatorTest extends TestCase
{

    /**
     * @dataProvider InputOutputProvider
     * @param array $inputArray
     * @param array $subArray
     * @param bool $expected
     */
    public function testValidate($inputArray, array $subArray, bool $expected)
    {
        $isSubsequent = SubsequenceValidator::validate($inputArray, $subArray);
        $this->assertEquals($isSubsequent, $expected);


    }

    public function InputOutputProvider()
    {
        return [
            'returnsTrue1' => [
                [5, 2], [5], true
            ],
            'returnsTrue2' => [
                [5, 2, 3], [5], true
            ],
            'returnsFalse1' => [
                [5, 2, 3], [6], false
            ],
            'returnsTrue3' => [
                [5, 1, 22, 25, 6, -1, 8, 10], [1, 6, -1, 10], true
            ],
            'returnsFalse2' => [
                [5, 1, 22, 25, 6, -1, 8, 10], [1, 6, -1, 12], false
            ],
            'returnsFalse3' => [
                [1, 6, -1, 12], [5, 1, 22, 25, 6, -1, 8, 10], false
            ],
            'returnsFalse4' => [
                [1, 6, -1, 12], [1, 6, -1, 12, -1, 8, 10], false
            ],
        ];

    }
}
