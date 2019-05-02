<?php

namespace Weather;

use Weather\Api\DataProvider;
use Weather\Api\DbRepository;
use Weather\Api\GoogleApi;
use Weather\Model\Weather;

class Manager
{
    /**
     * @var DataProvider
     */
    private $transporter;

    /**
     * @var GoogleApi
     */
    private $api;

    /**
     * @param string $dataType
     * @return object
     * @throws \Exception
     */
    public function getTodayInfo(string $dataType): object
    {
        if($dataType == "api"){
            return $this->getApi()->getToday();
        }
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

    private function getApi()
    {
        if(null === $this->api){
            $this->api = new GoogleApi();
        }

        return $this->api;
    }
}