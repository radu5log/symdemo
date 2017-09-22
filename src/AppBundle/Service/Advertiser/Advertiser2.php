<?php

namespace AppBundle\Service\Advertiser;

class Advertiser2 extends Advertiser implements AdvertiserInterface
{
    protected $id = 2;

    public function saveOffer($offer)
    {
        //do the mapping and send it to be stored
        $mappedOffer = [];

        $mappedOffer['country'] = $this
            ->convertCountryCode(
                array_shift($offer['campaigns']['countries'])
            );

        $mappedOffer['application_id'] = md5($offer['advertiser_id'] . '-' . $offer['id']);

        $mappedOffer['payout'] = $this
            ->calculatePayoutFromPoints($offer['campaigns']['points']);

        //no obvious name
        $mappedOffer['name'] = $offer['advertiser_id'].'-'.$offer['id'];
        $mappedOffer['platform'] = $offer['app_details']['platform'];

        if ($this->saveOfferInStorage($mappedOffer)) {
            return $mappedOffer;
        } else {
            return false;
        }
    }

    public function getAdvertiserId() : int
    {
        return $this->id;
    }

    /**
     * Obviously not the right way to do it but sufficient for this exercise
     *
     * @param string $country
     * @return string
     */
    public function convertCountryCode($country) : string
    {
        $map = array(
            "BGD" => "BD", "BEL" => "BE", "BFA" => "BF", "BGR" => "BG", "BIH" => "BA",
            "BRB" => "BB", "WLF" => "WF", "BLM" => "BL", "BMU" => "BM", "BRN" => "BN",
            "BOL" => "BO", "BHR" => "BH", "BDI" => "BI", "BEN" => "BJ", "BTN" => "BT",
            "JAM" => "JM", "BVT" => "BV", "BWA" => "BW", "WSM" => "WS", "BES" => "BQ",
            "BRA" => "BR", "BHS" => "BS", "JEY" => "JE", "BLR" => "BY", "BLZ" => "BZ",
            "RUS" => "RU", "RWA" => "RW", "SRB" => "RS", "TLS" => "TL", "REU" => "RE",
            "TKM" => "TM", "TJK" => "TJ", "ROU" => "RO", "TKL" => "TK", "GNB" => "GW",
            "GUM" => "GU", "GTM" => "GT", "SGS" => "GS", "GRC" => "GR", "GNQ" => "GQ",
            "GLP" => "GP", "JPN" => "JP", "GUY" => "GY", "GGY" => "GG", "GUF" => "GF",
            "GEO" => "GE", "GRD" => "GD", "GBR" => "GB", "GAB" => "GA", "SLV" => "SV",
            "GIN" => "GN", "GMB" => "GM", "GRL" => "GL", "GIB" => "GI", "GHA" => "GH",
            "OMN" => "OM", "TUN" => "TN", "JOR" => "JO", "HRV" => "HR", "HTI" => "HT",
            "HUN" => "HU", "HKG" => "HK", "HND" => "HN", "HMD" => "HM", "VEN" => "VE",
            "PRI" => "PR", "PSE" => "PS", "PLW" => "PW", "PRT" => "PT", "SJM" => "SJ",
            "PRY" => "PY", "IRQ" => "IQ", "PAN" => "PA", "PYF" => "PF", "PNG" => "PG",
            "PER" => "PE", "PAK" => "PK", "PHL" => "PH", "PCN" => "PN", "POL" => "PL",
            "SPM" => "PM", "ZMB" => "ZM", "ESH" => "EH", "EST" => "EE", "EGY" => "EG",
            "ZAF" => "ZA", "ECU" => "EC", "ITA" => "IT", "VNM" => "VN", "SLB" => "SB",
            "ETH" => "ET", "SOM" => "SO", "ZWE" => "ZW", "SAU" => "SA", "ESP" => "ES",
            "ERI" => "ER", "MNE" => "ME", "MDA" => "MD", "MDG" => "MG", "MAF" => "MF",
            "MAR" => "MA", "MCO" => "MC", "UZB" => "UZ", "MMR" => "MM", "MLI" => "ML",
            "MAC" => "MO", "MNG" => "MN", "MHL" => "MH", "MKD" => "MK", "MUS" => "MU",
            "MLT" => "MT", "MWI" => "MW", "MDV" => "MV", "MTQ" => "MQ", "MNP" => "MP",
            "MSR" => "MS", "SEÑMRT" => "OR", "IMN" => "IM", "UGA" => "UG", "TZA" => "TZ",
            "MYS" => "MIS", "MEX" => "MX", "ISR" => "IL", "FRA" => "FR", "IOT" => "IO",
            "SHN" => "SH", "FIN" => "FI", "FJI" => "FJ", "FLK" => "FK", "FSM" => "FM",
            "FRO" => "FO", "NIC" => "NI", "NLD" => "NL", "NOR" => "NO", "NAM" => "NA",
            "VUT" => "VU", "NCL" => "NC", "NER" => "NE", "NFK" => "NF", "NGA" => "NG",
            "NZL" => "NZ", "NPL" => "NP", "NRU" => "NR", "NIU" => "NU", "COK" => "CK",
            "XKX" => "XK", "CIV" => "CI", "CHE" => "CH", "COL" => "CO", "CHN" => "CN",
            "CMR" => "CM", "CHL" => "CL", "CCK" => "CC", "CAN" => "CA", "COG" => "CG",
            "CAF" => "CF", "COD" => "CD", "CZE" => "CZ", "CYP" => "CY", "CXR" => "CX",
            "CRI" => "CR", "CUW" => "CW", "CPV" => "CV", "CUB" => "CU", "SWZ" => "SZ",
            "SYR" => "SY", "SXM" => "SX", "KGZ" => "KG", "KEN" => "KE", "SSD" => "SS",
            "SUR" => "SR", "KIR" => "KI", "KHM" => "KH", "KNA" => "KN", "COM" => "KM",
            "STP" => "ST", "SVK" => "SK", "KOR" => "KR", "SVN" => "SI", "PRK" => "KP",
            "KWT" => "KW", "SEN" => "SN", "SMR" => "SM", "SLE" => "SL", "SYC" => "SC",
            "KAZ" => "KZ", "CYM" => "KY", "SGP" => "SG", "SWE" => "SE", "SDN" => "SD",
            "DOM" => "DO", "DMA" => "DM", "DJI" => "DJ", "DNK" => "DK", "VGB" => "VG",
            "DEU" => "DE", "YEM" => "YE", "DZA" => "DZ", "USA" => "US", "URY" => "UY",
            "MYT" => "YT", "UMI" => "UM", "LBN" => "LB", "LCA" => "LC", "LAO" => "LA",
            "TUV" => "TV", "TWN" => "TW", "TTO" => "TT", "TUR" => "TR", "LKA" => "LK",
            "LIE" => "LI", "LVA" => "LV", "TON" => "TO", "LTU" => "LT", "LUX" => "LU",
            "LBR" => "LR", "LSO" => "LS", "THA" => "TH", "ATF" => "TF", "TGO" => "TG",
            "TCD" => "TD", "TCA" => "TC", "LBY" => "LY", "VAT" => "VA", "VCT" => "VC",
            "ARE" => "AE", "AND" => "AD", "ATG" => "AG", "AFG" => "AF", "AIA" => "AI",
            "VIR" => "VI", "ISL" => "IS", "IRN" => "IR", "ARM" => "AM", "ALB" => "AL",
            "AGO" => "AO", "ATA" => "AQ", "ASM" => "AS", "ARG" => "AR", "AUS" => "AU",
            "AUT" => "AT", "ABW" => "AW", "IND" => "IN", "ALA" => "AX", "AZE" => "AZ",
            "IRL" => "IE", "IDN" => "ID", "UKR" => "UA", "QAT" => "QA", "MOZ" => "MZ"
        );
        
        return $map[$country];
    }

    public function calculatePayoutFromPoints($points) : float
    {
        return $points / 1000;
    }
}

/*
 * Left here for convenience
"3":{
    "id":3,
    "advertiser_id":2,
    "app_details":{
        "bundle_id":"com.ncsoft.aramipuzzventure",
        "platform":"Android",
        "store_rating":4.5,
        "total_ratings":2770,
        "category":"Games - Casual Management",
        "size":"N\/A",
        "developer":"NCSOFT Corporation",
        "version":"1.0.6"
    },
    "campaigns":{
        "cid":"13213622",
        "click_url":"http => \/\/exampleclickurl.com",
        "global":false,
        "countries":[
            "IND"
        ],
        "points":330,
        "min_os_version":"4.1",
        "device_id_required":false
    }
}
*/
