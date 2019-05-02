<?php

namespace Weather\Api;

use Weather\Model\NullWeather;
use Weather\Model\Weather;

class GoogleApi
{
    /**
     * @return Weather
     * @throws \Exception
     */
    public function getToday() : Weather
    {
        $today = $this->load(new NullWeather());
        $today->setDate(new \DateTime());

        return $today;
    }

    /**
     * @param Weather $before
     * @return Weather
     * @throws \Exception
     */
    private function load(Weather $before)
    {
        $now = new Weather();
        $base = $before->getDayTemp();
        $now->setDayTemp(random_int($base - 5, $base + 5));

        $base = $before->getNightTemp();
        $now->setNightTemp(random_int(-5 - abs($base), -5 + abs($base)));

        $now->setSky(random_int(1, 3));

        return $now;
    }

    public function getWeek(\DateTime $to) : array
    {
        $weathers = [];
        $day = $this->load(new NullWeather());
        $day->setDate(new \DateTime());
        $weathers[] = $day;
        for($i = 1; $i < 7;$i++){
            $day = $this->load(end($weathers));
            $day->setDate(new \DateTime('+'.$i.' days midnight'));
            $weathers[] = $day;
        }
        return $weathers;
    }
}
