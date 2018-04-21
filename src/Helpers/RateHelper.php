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
    protected function validateDate($date)
    {
        $dateToCompare = DateTime::createFromFormat('Y-m-d', $date);
        if ($dateToCompare !== $date) {
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
    protected function convertDate($date, $format)
    {
        $date = DateTime::createFromFormat(self::DATE_FORMAT, $date);

        return $date->format($format);
    }
}