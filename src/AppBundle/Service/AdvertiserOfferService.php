<?php

namespace AppBundle\Service;

use AppBundle\Service\Advertiser\Advertiser;

class AdvertiserOfferService
{
    /**
     *
     * @param object $httpClient
     * @param object $advertiser
     * @param int $offer_id
     */
    public function processOffersAndReturnStatus($httpClient, Advertiser $advertiser, $offer_id) : string
    {
        //@todo extract this to another method
        $url = 'http://process.xflirt.com/advertiser/'.$advertiser->getAdvertiserId().'/offers';

        if (null != $offer_id) {
            $url = $url.'/'.$offer_id;
        }

        $offersJson = $httpClient->get($url);

        $offers = json_decode($offersJson, true);

        if (null != $offer_id) {
            $offers = array($offers);
        }

        $responseStatus = '';
        if (is_array($offers)) {
            foreach ($offers as $offer_id => $offer) {
                $saveStatus = $advertiser->saveOffer($offer);
                
                if ($saveStatus) {
                    $responseStatus .= "\nOffer: ".$saveStatus['application_id'].' has been saved to storage';
                }
            }
        }

        return $responseStatus;
    }

    /**
     *
     * @param object $httpClient
     * @param string $url
     * @return string
     */
    public function getResponse($httpClient, $url) : string
    {
        return $httpClient->get($url);
    }
}
