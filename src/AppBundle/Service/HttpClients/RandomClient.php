<?php

namespace AppBundle\Service\HttpClients;

class RandomClient
{
    private static $httpClient;

    private function __construct()
    {
    }

    public static function getHttpClient()
    {
        if (null == self::$httpClient) {
            self::$httpClient = new RandomClient();
        }

        return self::$httpClient;
    }

    public function get($url)
    {
        //mock some data
        switch ($url) {
            case 'http://process.xflirt.com/advertiser/1/offers':
                $response = '{"1":{"id":1,"advertiser_id":1,"campaign_id":6310236,"end_date":"2032-12-31T00=>00=>00+00=>00","restrictions":["Invalid or duplicate leads unaccepted","Absolutely no Incentivization"],"restrictions_text":"","payout_amount":4.6,"payout_currency":"USD","daily_remaining_leads":625,"countries":["GB"],"mobile_app_id":"air.com.casinogamestudio.roulette","mobile_platform":"Android","mobile_min_version":"4.0","mobile_max_version":null,"incentivized":0,"internal_category_id":"10","internal_subcategory_id":"39","click_url":"http=>\/\/exampleclickurl.com","name":"RRRouletteee","category":"Casino"},"2":{"id":2,"advertiser_id":1,"campaign_id":2310928,"end_date":"2032-12-31T00=>00=>00+00=>00","restrictions":["Invalid or duplicate leads unaccepted","Absolutely no Incentivization","No Search","No Adult Content","Own Creatives need Approval","No Social Networks","No Redirect Traffic"],"restrictions_text":"Min KPI=> 1% Purchases","payout_amount":0.7,"payout_currency":"USD","daily_remaining_leads":836,"countries":["ID"],"mobile_app_id":"1195509064","mobile_platform":"iOS","mobile_min_version":"8.0","mobile_max_version":null,"incentivized":0,"internal_category_id":"22","internal_subcategory_id":null,"click_url":"http=>\/\/exampleclickurl.com","name":"Sale Stock Toko Baju Online","category":"Shopping"},"3":{"id":3,"advertiser_id":1,"campaign_id":456906,"end_date":"2032-12-31T00=>00=>00+00=>00","restrictions":["Invalid or duplicate leads unaccepted","Absolutely no Incentivization","No Search","No E-Mailings","No Adult Content","No Pop Traffic","Own Creatives need Approval","No Social Networks","No Facebook Traffic","No Rebrokering"],"restrictions_text":"","payout_amount":2.4,"payout_currency":"USD","daily_remaining_leads":50,"countries":["JP"],"mobile_app_id":"872834141","mobile_platform":"iOS","mobile_min_version":"8.1","mobile_max_version":null,"incentivized":0,"internal_category_id":"20","internal_subcategory_id":null,"click_url":"http=>\/\/exampleclickurl.com","name":"Famm=> print & easy baby photo share","category":"Lifestyle"}}';
                break;
            case 'http://process.xflirt.com/advertiser/1/offers/1':
                $response = '{"id":3,"advertiser_id":1,"campaign_id":456906,"end_date":"2032-12-31T00=>00=>00+00=>00","restrictions":["Invalid or duplicate leads unaccepted","Absolutely no Incentivization","No Search","No E-Mailings","No Adult Content","No Pop Traffic","Own Creatives need Approval","No Social Networks","No Facebook Traffic","No Rebrokering"],"restrictions_text":"","payout_amount":2.4,"payout_currency":"USD","daily_remaining_leads":50,"countries":["JP"],"mobile_app_id":"872834141","mobile_platform":"iOS","mobile_min_version":"8.1","mobile_max_version":null,"incentivized":0,"internal_category_id":"20","internal_subcategory_id":null,"click_url":"http=>\/\/exampleclickurl.com","name":"Famm=> print & easy baby photo share","category":"Lifestyle"}';
                break;
            case 'http://process.xflirt.com/advertiser/2/offers':
                $response = '{"1":{"id":1,"advertiser_id":2,"app_details":{"bundle_id":"com.amazon.tahoe","platform":"Android","store_rating":4.1,"total_ratings":921,"category":"Entertainment","size":"N\/A","developer":"Amazon Mobile LLC","version":"FreeTimeApp-aosp_v3.9_Build-1.0.83.18.9674"},"campaigns":{"cid":"1244775","click_url":"http=>\/\/exampleclickurl.com","global":false,"countries":["USA"],"points":1930,"min_os_version":"5.0","device_id_required":false}},"2":{"id":2,"advertiser_id":2,"app_details":{"bundle_id":"1218137964","platform":"iOS","store_rating":4.5,"total_ratings":10,"category":"Games - Casual","size":"251.0 MB","developer":"NCSOFT","version":"1.0.6"},"campaigns":{"cid":"12343623","click_url":"http=>\/\/exampleclickurl.com","global":false,"countries":["BRA"],"points":520,"min_os_version":null,"device_id_required":false}},"3":{"id":3,"advertiser_id":2,"app_details":{"bundle_id":"com.ncsoft.aramipuzzventure","platform":"Android","store_rating":4.5,"total_ratings":2770,"category":"Games - Casual Management","size":"N\/A","developer":"NCSOFT Corporation","version":"1.0.6"},"campaigns":{"cid":"13213622","click_url":"http=>\/\/exampleclickurl.com","global":false,"countries":["IND"],"points":330,"min_os_version":"4.1","device_id_required":false}}}';
                break;
            case 'http://process.xflirt.com/advertiser/2/offers/3':
                $response = '{"id":2,"advertiser_id":2,"app_details":{"bundle_id":"1218137964","platform":"iOS","store_rating":4.5,"total_ratings":10,"category":"Games - Casual","size":"251.0 MB","developer":"NCSOFT","version":"1.0.6"},"campaigns":{"cid":"12343623","click_url":"http=>\/\/exampleclickurl.com","global":false,"countries":["BRA"],"points":520,"min_os_version":null,"device_id_required":false}}';
                break;
            default:
                throw new \Exception("URL not valid. For the purpose of this exercise, please use one of the 4 provided options"
                    . "\nphp bin/console app:fetch-advertiser-offers 1"
                    . "\nphp bin/console app:fetch-advertiser-offers 1 1"
                    . "\nphp bin/console app:fetch-advertiser-offers 2"
                    . "\nphp bin/console app:fetch-advertiser-offers 2 3");
        }

        return $response;
    }
}
