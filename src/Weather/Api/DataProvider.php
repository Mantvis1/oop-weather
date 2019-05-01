<?php

namespace Weather\Api;

use Weather\Model\Weather;

interface DataProvider
{
    /**
     * @param \DateTime $date
     * @return Weather
     */
    public function selectByDate(string $dataType,\DateTime $date):object ;

    /**
     * @param \DateTime $from
     * @param \DateTime $to
     * @return array
     */
    public function selectByRange(string $dataType,\DateTime $from, \DateTime $to): array;
}
