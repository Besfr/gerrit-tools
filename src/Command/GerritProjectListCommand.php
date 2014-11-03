<?php

namespace Gerrit\GerritTools\Cli\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use GuzzleHttp\Message;


class GerritProjectListCommand extends GerritCommand {

  protected function configure() {
    $this
      ->setName('list')
      ->setDescription('List all your projects.');
  }

  protected function execute(InputInterface $input, OutputInterface $output) {

    $client = $this->getClient();

    $baseUrl = $client->getBaseUrl();
    $res = $client->get($baseUrl . '/projects/');
    try {

      $body_troncated = $this->fixGerritJson((string) $res->getBody());
      $projects = json_decode($body_troncated);
      $output->writeln("\n### Project Listing ### \n");
      foreach($projects as $key => $project) {
        $output->writeln(urldecode($project->id) .  "\n > " . urldecode($key) . "\n");
      }
    } catch (Exception $e) {
      echo $res->getResponse()->getRawHeaders();
    }
  }
}
