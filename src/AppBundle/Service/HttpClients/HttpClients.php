<?php

namespace AppBundle\Service\HttpClients;

class HttpClients
{
    public static function getHttpClient($httpClient)
    {
        if ($httpClient == 'random') {
            return RandomClient::getHttpClient();
        }
    }
}
