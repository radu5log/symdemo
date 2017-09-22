<?php

namespace AppBundle\Service\Advertiser;

use AppBundle\Entity\Offer;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;

abstract class Advertiser
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function saveOfferInStorage($mappedOffer)
    {
        $offer = $this
            ->em
            ->getRepository('AppBundle:Offer')
            ->findOneBy([
            'applicationId' => $mappedOffer['application_id']
        ]);

        if (!$offer) {
            $offer = new Offer();
        }

        $offer->setApplicationId($mappedOffer['application_id']);
        $offer->setCountry($mappedOffer['country']);
        $offer->setName($mappedOffer['name']);
        $offer->setPayout($mappedOffer['payout']);
        $offer->setPlatform($mappedOffer['platform']);

        $this->em->persist($offer);
        $this->em->flush($offer);

        return true;
    }
}
