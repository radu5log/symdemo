<?php

/**
 * @author rplamadeala
 */

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use AppBundle\Service\HttpClients\HttpClients;

class FetchAdvertiserOffersCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName('app:fetch-advertiser-offers')
            ->setDescription('Fetching all offers from this advertiser')
            ->setHelp('This command allows you to see a list of offers')
            ->addArgument('advertiser_id', InputArgument::OPTIONAL, "Please provide an Advertiser ID")
            ->addArgument('offer_id', InputArgument::OPTIONAL)
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $advertiser_id = $input->getArgument('advertiser_id');
        $offer_id = $input->getArgument('offer_id');

        $randomHttpClient = HttpClients::getHttpClient('random');

        $service = $this->getApplication()->getKernel()->getContainer()->get('app.advertiser_offer_service');

        $advertiser = $this->getApplication()->getKernel()->getContainer()->get('app.advertiser'.$advertiser_id);

        $output->writeln("<info>\n\nGetting Status\n\n</info>");
        
        $status = $service->processOffersAndReturnStatus($randomHttpClient, $advertiser, $offer_id);
        $output->writeln($status);
        $output->writeln("<info>\n\nDone\n\n</info>");
    }
}
