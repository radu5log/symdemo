<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/advertiser/{id}/offers")
     */
    public function advertiserOffersAction($id)
    {
        var_dump('advertiser id'.$id);
    }

    /**
     * @Route("/advertiser/{id}/offers/{offer_id}")
     */
    public function advertiserOfferAction($id, $offer_id)
    {
        var_dump('advertiser offers id'.$offer_id);
    }
}
