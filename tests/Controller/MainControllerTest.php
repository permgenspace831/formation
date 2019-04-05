<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainControllerTest extends WebTestCase
{

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    private $client;

    protected function setUp()
    {
        $this->client = self::createClient();
        $this->client->followRedirects();
    }

    public function testHomepage(): void
    {
        $client = static::createClient();
        $client->request(Request::METHOD_GET, '/');

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function testContact(): void
    {
        $this->client->request(Request::METHOD_GET, '/contact');

        $this->client->submitForm('Submit', [
            'contact[name]' => 'John',
            'contact[dateOfBirth][day]' => '2',
            'contact[dateOfBirth][month]' => '3',
            'contact[dateOfBirth][year]' => '1980',
            'contact[email]' => 'john@doe.fr',
            'contact[message]' => 'Bonjour',
        ]);

        self::assertContains(
            'John',
            $this->client->getCrawler()->filter('p.message')->text()
        );
    }
}
