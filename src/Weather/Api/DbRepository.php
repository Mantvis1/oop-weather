<?php

namespace Weather\Api;

use Weather\Model\NewWeather;
use Weather\Model\NullWeather;
use Weather\Model\Weather;

class DbRepository implements DataProvider
{
    /**
     * @param \DateTime $date
     * @param string $dataType
     * @return Weather
     */
    public function selectByDate(string $dataType,\DateTime $date) : object
    {
        $items = $this->selectAll($dataType);
        $result = new NullWeather();

        foreach ($items as $item) {
            if ($item->getDate()->format('Y-m-d') === $date->format('Y-m-d')) {
                $result = $item;
            }
        }

        return $result;
    }

    public function selectByRange(string $dataType,\DateTime $from, \DateTime $to): array
    {
        $items = $this->selectAll($dataType);
        $result = [];

        foreach ($items as $item) {
            if ($item->getDate() >= $from && $item->getDate() <= $to) {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @return Weather[]
     */
    private function selectAll(string $dataType): array
    {
        $i = 0;
        $result = [];
        if ($dataType === "old") {
            $data = json_decode(
                file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Db' . DIRECTORY_SEPARATOR . 'Data.json'),
                true
            );
            foreach ($data as $item) {
                $record = new Weather();
                $record->setDate(new \DateTime($item['date']));
                $record->setDayTemp($item['dayTemp']);
                $record->setNightTemp($item['nightTemp']);
                $record->setSky($item['sky']);
                $result[] = $record;
            }
        } else if ($dataType === "new"){
                $data = json_decode(
                    file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Db' . DIRECTORY_SEPARATOR . 'Weather.json'),
                    true
                );
                foreach ($data as $item) {
                    $record = new NewWeather();
                    $record->setDate(new \DateTime($item['date']));
                    $record->setDay($item['day']);
                    $record->setHigh($item['high']);
                    $record->setLow($item['low']);
                    $record->setText($item['text']);
                    $result[] = $record;
                }
            }

            return $result;
        }

}