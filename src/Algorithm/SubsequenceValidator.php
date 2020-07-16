<?php


namespace Algorithm;


class SubsequenceValidator
{
    /**
     * @param array $inputArray
     * @param array $subsequence
     * @return bool
     */
    public static function validate(array $inputArray, array $subsequence): bool
    {
        if (sizeof($subsequence) > sizeof($inputArray)) {
            return false;
        }
        $resultingArray = [];
        for ($i = 0; $i < sizeof($subsequence); $i++) {
            for ($j = 0; $j < sizeof($inputArray); $j++) {
                if ($subsequence[$i] === $inputArray[$j]) {
                    $resultingArray[] = $inputArray[$j];
                }
                if (sizeof($resultingArray) === sizeof($subsequence)) {
                    return true;
                }
            }
        }
        return false;
    }

}