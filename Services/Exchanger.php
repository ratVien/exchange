<?php
namespace Rate;

use DateTime;

abstract class Exchanger
{
    const DATE_FORMAT = 'Y-m-d';

    /**
     * @param string$date
     *
     * @return bool
     */
    protected function validateDate($date)
    {
        //$dateTocompare = date(self::DATE_FORMAT, strtotime($date));
        $dateTocompare = DateTime::createFromFormat(self::DATE_FORMAT, $date);
//        return $dateTocompare && $dateTocompare->format($format) == $date;
        //return strtotime($date) < time();
        return $dateTocompare == $date;
    }

    protected function convertDate($date)
    {

    }
}