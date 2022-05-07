<?php

namespace App\Tests\Functional\Controller;

use App\Tests\Functional\AbstractWebTestCase;

class DefaultControllerTest extends AbstractWebTestCase
{
    public function testIndexAnonymous()
    {
        $this->testIndex(302);
    }

    public function testIndexLogged()
    {
        $this->loginAs('user@user.com');
        $this->testIndex(200);
    }

    protected function testIndex(int $expectedCode)
    {
        $this->client->request('GET', '/');
        $this->assertEquals($expectedCode, $this->client->getResponse()->getStatusCode());
    }
}
