<?php

namespace Weather;

use Weather\Api\DataProvider;
use Weather\Api\DbRepository;
use Weather\Model\Weather;

class Manager
{
    /**
     * @var DataProvider
     */
    private $transporter;

    public function getTodayInfo(string $dataType): object
    {
        return $this->getTransporter()->selectByDate($dataType, new \DateTime());
    }

    public function getWeekInfo(string $dataType): array
    {
        return $this->getTransporter()->selectByRange($dataType, new \DateTime('midnight'), new \DateTime('+6 days midnight'));
    }

    private function getTransporter()
    {
        if (null === $this->transporter) {
            $this->transporter = new DbRepository();
        }

        return $this->transporter;
    }
}