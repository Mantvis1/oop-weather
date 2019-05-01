<?php

namespace Weather\Model;

class NewWeather
{
    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var string
     */
    protected $day;

    /**
     * @var integer
     */
    protected $high;

    /**
     * @var integer
     */
    protected $low;

    /**
     * @var string
     */
    protected $text;

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day): void
    {
        $this->day = $day;
    }

    /**
     * @return integer
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * @param integer $high
     */
    public function setHigh($high): void
    {
        $this->high = $high;
    }

    /**
     * @return integer
     */
    public function getLow()
    {
        return $this->low;
    }

    /**
     * @param integer $low
     */
    public function setLow($low): void
    {
        $this->low = $low;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

}