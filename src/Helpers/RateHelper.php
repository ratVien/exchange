<?php

namespace Rate\Helpers;

use DateTime;

trait RateHelper
{
    /**
     * @param string $date
     *
     * @return bool
     * @throws \Exception
     */
    public function validateDate($date)
    {
        $dateToCompare = DateTime::createFromFormat('Y-m-d', $date);
        if (!$dateToCompare || $dateToCompare->format('Y-m-d') != $date) {
            throw new \Exception('Date is not valid!');
        }
        return true;
    }

    /**
     * @param string $date
     *
     * @param string $format
     * @return string
     */
    public function convertDate($date, $format)
    {
        $date = DateTime::createFromFormat(self::DATE_FORMAT, $date);

        return $date->format($format);
    }
}