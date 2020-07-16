<?php

namespace Algorithm;

class TwoNumberSum
{
    public static function run(array $input, int $result): array
    {
        $returnArray = [];
        for ($index = 0; $index < count($input); $index++) {
            for ($secondIndex = $index + 1; $secondIndex < count($input); $secondIndex++) {
                $sumOfCurrentAndFollowing = $input[$index] + $input[$secondIndex];
                if ($sumOfCurrentAndFollowing === $result) {
                    $returnArray[] = [$input[$index], $input[$secondIndex]];
                }
            }
        }
        return $returnArray;

    }

}