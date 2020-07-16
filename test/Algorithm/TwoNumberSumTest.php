<?php

namespace Algorithm;

use PHPUnit\Framework\TestCase;

class TwoNumberSumTest extends TestCase
{

    /**
     * @dataProvider InputOutputProvider
     * @param array $
     * @param bool $result
     */
    public function testValidate(array $inputArray, int $targetSum, array $expectedOutputArray)
    {
        $twoNumberSum=TwoNumberSum::run($inputArray,$targetSum);
        $this->assertEquals($twoNumberSum, $expectedOutputArray);

    }

    public function InputOutputProvider()
    {
        return [
            '5And2Return5And2' => [
                [5, 2], 7, [[5, 2]]
            ],
            '5And7And3Return8' => [
                [5, 7,3], 8, [[5, 3]]
            ],
            'multiarray1' => [
                [5,7,3,-1,12,4], 8, [[5, 3]]
            ],
            'multiarray2' => [
                [5,7,3,-1,12,4,1], 8, [[5, 3],[7, 1]]
            ],
            'multiarray3' => [
                [5,7,3,-1,12,9,1], 8, [[5, 3],[7, 1],[-1, 9]]
            ],

        ];

    }

}
