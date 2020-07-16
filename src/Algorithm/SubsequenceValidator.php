<?php


namespace Algorithm;


class SubsequenceValidator
{
    public static function validate(array $inputArray, array $subsequence): bool
    {
        $resultingArray=[];
        for ($i = 0; $i < sizeof($subsequence); $i++) {
            for ($j = 0; $j < sizeof($inputArray); $j++) {
                if ($subsequence[$i]===$inputArray[$j]){
                    $resultingArray[]=$inputArray[$j];
                }
                if (sizeof($resultingArray)===sizeof($subsequence)){
                    return true;
                }
            }
        }


        return false;
    }

}