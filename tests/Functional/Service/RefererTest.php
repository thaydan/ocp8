<?php

namespace App\Tests\Functional\Service;

use App\Service\Referer;
use App\Tests\Functional\AbstractWebTestCase;

class RefererTest extends AbstractWebTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->referer = static::getContainer()->get(Referer::class);
    }

    public function testSetAndGet(): void
    {
        $this->loginAs('user@user.com');

        $url1 = $this->router->generate('homepage');
        $url2 = $this->router->generate('task_list');

        $this->client->request('GET', $url1);
        $this->client->request('GET', $url2);

        $this->referer->set();
        $result = $this->referer->get();

        $this->assertEquals($url1, $result);
    }
}
