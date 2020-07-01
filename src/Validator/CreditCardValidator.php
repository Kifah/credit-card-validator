<?php


namespace Validator;


use DateInterval;
use DateTime;

class CreditCardValidator implements Validator
{

    public function validate(array $params): bool
    {
        $creditCardNumber = $params['number'];
        $month = $params['month'];
        $year = $params['year'];
        $isMonthValid = $this->monthIsValid($month);
        $isYearValid = $this->yearIsValid($year);
        $isYearAndMonthValid = $this->yearAndMonthValid($year, $month);
        $cardIsValid = $this->cardNumberIsValid($creditCardNumber);
        if ($isMonthValid && $isYearValid && $isYearAndMonthValid && $cardIsValid) return true;
        return false;
    }

    /**
     * @param int $month
     * @return bool
     */
    private function monthIsValid(int $month): bool
    {
        if ($month > 12 || $month < 1) return false;
        return true;
    }

    /**
     * @param int $year
     * @return bool
     */
    private function yearIsValid(int $year): bool
    {
        $currentYear = date("Y");
        if ($year < $currentYear) {
            return false;
        }
        return true;
    }

    /**
     * @param int $year
     * @param int $month
     * @return bool
     */
    private function yearAndMonthValid(int $year, int $month): bool
    {

        $now = new DateTime('now');
        $combinedDate = $month . '-' . $year;
        $maxValidityDate = date_create_from_format('d-m-Y', '1-' . $combinedDate);
        $monthInterval = new DateInterval('P1M');
        $maxValidityDate->add($monthInterval);
        if ($now->getTimestamp() >= $maxValidityDate->getTimestamp()) {
            return false;
        }
        return true;
    }

    /**
     * @param string $pan
     * @return bool
     */
    private function cardNumberIsValid(string $pan): bool
    {
        $withoutLastDigit = substr($pan, 0, -1);
        $digitsArray = str_split($withoutLastDigit);
        $newPosition = 1;
        $allNumbers = 0;
        for ($i = count($digitsArray) - 1; $i >= 0; $i--) {
            if ($newPosition % 2 !== 0) {
                $newElement = $digitsArray[$i] * 2;
                if ($newElement > 9) {
                    $newElement = $newElement - 9;
                }
            } else {
                $newElement = $digitsArray[$i];
            }
            $newPosition++;
            $allNumbers += $newElement;
        }
        $LeftOfModOverTen = 10 - ($allNumbers % 10);
        $lastDigit = (int)substr($pan, -1);
        return ($lastDigit === $LeftOfModOverTen);
    }

}