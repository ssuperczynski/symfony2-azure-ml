<?php

namespace MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class DefaultControllerTest
 * @package MainBundle\Tests\Controller
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * Test main page
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertTrue($crawler->filter('html:contains("Dashboard")')->count() > 0);
    }
}
