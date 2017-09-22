<?php

namespace AppBundle\Service\Advertiser;

class AdvertiserContext
{
    private $strategy = null;

    public function __construct($strategy_id)
    {
        switch ($strategy_id) {
            case 1:
                $this->strategy = new Advertiser1();
                break;
            case 2:
                $this->strategy = new Advertiser2();
                break;
        }
    }

    public function saveOffer($offer)
    {
        return $this->strategy->saveOffer($offer);
    }
}
