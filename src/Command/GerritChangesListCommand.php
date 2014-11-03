<?php

namespace Gerrit\GerritTools\Cli\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use GuzzleHttp\Message;


class GerritChangesListCommand extends GerritCommand {

  protected function configure() {
    $this
      ->setName('changes:list')
      ->setDescription('List all open changes.');
  }

  protected function execute(InputInterface $input, OutputInterface $output) {

    $client = $this->getClient();
    $baseUrl = $client->getBaseUrl();
    $res = $client->get($baseUrl . '/changes/');

    // Todo: Nice output.
    $body = $res->getBody();
    $output->writeln((string) $body);

  }

}
