<?php

namespace AppBundle\Service\Advertiser;

interface AdvertiserInterface
{
    public function saveOffer($offer);
    public function getAdvertiserId();
}
