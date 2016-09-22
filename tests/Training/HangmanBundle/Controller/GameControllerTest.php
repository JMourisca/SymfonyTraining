<?php
/**
 * Created by PhpStorm.
 * User: juliana
 * Date: 22/09/16
 * Time: 09:31
 */

namespace Training\HangmanBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

class GameControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->client->followRedirects(true);
    }

    public function tearDown()
    {
        $this->client = null;
    }

    public function testGamePageLoads()
    {
        $this->client->request('GET', '/game');

        $response = $this->client->getResponse();

        $this->assertTrue($response->isSuccessful());
    }

    public function testPlayGameAndWin()
    {
        $letters = ['a','i', 'r', 'p', 'l', 'n', 'e'];
        $crawler = $this->client->request('GET', '/game');

        foreach ($letters as $letter) {
            $link = $crawler->selectLink(strtoupper($letter))->link();
            $crawler = $this->client->click($link);
        }

        $crawler = $this->client->getCrawler();
        $nodes = $crawler->filter("html:contains('Congratulations')");

        $this->assertCount(1, $nodes);
    }
}