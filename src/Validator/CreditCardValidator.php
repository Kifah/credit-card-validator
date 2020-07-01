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
        if ($isMonthValid && $isYearValid && $isYearAndMonthValid) return true;
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

}