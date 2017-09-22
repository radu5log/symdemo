<?php

namespace AppBundle\Service\Advertiser;

class Advertiser1 extends Advertiser implements AdvertiserInterface
{
    protected $id = 1;

    public function saveOffer($offer)
    {
        //do the mapping and send it to be stored
        $mappedOffer = [];
        $mappedOffer['application_id'] = md5($offer['advertiser_id'] . '-' . $offer['id']);
        $mappedOffer['country'] = array_shift($offer['countries']);
        $mappedOffer['payout'] = $offer['payout_amount'];
        $mappedOffer['name'] = $offer['name'];
        $mappedOffer['platform'] = $offer['mobile_platform'];

        if ($this->saveOfferInStorage($mappedOffer)) {
            return $mappedOffer;
        } else {
            return false;
        }
    }

    public function getAdvertiserId(): int
    {
        return $this->id;
    }
}

/*
 * Left here for convenience
"1":{

    "id":1,
    "advertiser_id":1,
    "campaign_id":6310236,
    "end_date":"2032-12-31T00=>00=>00+00=>00",
    "restrictions":[
        "Invalid or duplicate leads unaccepted",
        "Absolutely no Incentivization"
    ],
    "restrictions_text":"",
    "payout_amount":4.6,
    "payout_currency":"USD",
    "daily_remaining_leads":625,
    "countries":[
        "GB"
    ],
    "mobile_app_id":"air.com.casinogamestudio.roulette",
    "mobile_platform":"Android",
    "mobile_min_version":"4.0",
    "mobile_max_version":null,
    "incentivized":0,
    "internal_category_id":"10",
    "internal_subcategory_id":"39",
    "click_url":"http=>\/\/exampleclickurl.com",
    "name":"Roulette",
    "category":"Casino"
}

*/
