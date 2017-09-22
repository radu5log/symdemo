<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 */
class Offer
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $applicationId;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $payout;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $platform;

    public function getId()
    {
        return $this->id;
    }

    public function getApplicationId()
    {
        return $this->applicationId;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getPayout()
    {
        return $this->payout;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPlatform()
    {
        return $this->platform;
    }

    public function setApplicationId($applicationId)
    {
        $this->applicationId = $applicationId;
        return $this;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    public function setPayout($payout)
    {
        $this->payout = $payout;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setPlatform($platform)
    {
        $this->platform = $platform;
        return $this;
    }
}
