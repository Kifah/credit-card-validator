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
        if (self::subArrayIsLargerThanInputArray($subsequence, $inputArray)) {
            return false;
        }
        $resultingArray = [];
        for ($i = 0; $i < sizeof($subsequence); $i++) {
            for ($j = 0; $j < sizeof($inputArray); $j++) {
                if ($subsequence[$i] === $inputArray[$j]) {
                    $resultingArray[] = $inputArray[$j];
                }
                if (self::subArrayContentComplete($resultingArray, $subsequence)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param array $subsequence
     * @param array $inputArray
     * @return bool
     */
    private static function subArrayIsLargerThanInputArray(array $subsequence, array $inputArray): bool
    {
        return sizeof($subsequence) > sizeof($inputArray);
    }

    /**
     * @param array $resultingArray
     * @param array $subsequence
     * @return bool
     */
    private static function subArrayContentComplete(array $resultingArray, array $subsequence): bool
    {
        return sizeof($resultingArray) === sizeof($subsequence);
    }

}