<?php

namespace App\Tests\Functional\Controller;

use App\Repository\UserRepository;
use App\Tests\Functional\AbstractWebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;

class SecurityControllerTest extends AbstractWebTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->security = static::getContainer()->get(Security::class);
        $this->userRepo = static::getContainer()->get(UserRepository::class);
        $this->token = static::getContainer()->get(TokenStorageInterface::class);
    }

    public function testLoginPage(): void
    {
        $this->client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
    }

    public function testLogin()
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', "/login");

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Se connecter')->form();
        $form['email']->setValue('user@user.com');
        $form['password']->setValue('user');
        $crawler = $this->client->submit($form);

        $crawler = $this->client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Bienvenue sur Todo List');
    }
}
