<?php

namespace App\Tests\Functional\Controller;

use App\Repository\UserRepository;
use App\Tests\Functional\AbstractWebTestCase;
use Symfony\Component\Form\FormFactoryInterface;

class UserControllerTest extends AbstractWebTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->factory = static::getContainer()->get(FormFactoryInterface::class);
        $this->userRepository = static::getContainer()->get(UserRepository::class);

    }

    public function testUserList(): void
    {
        $this->testPageAccess('admin@admin.com', 'user_list');
    }

    public function testUserCreateAndDelete()
    {
        $this->loginAs('admin@admin.com');
        $this->client->followRedirects();

        $crawler = $this->client->request('GET', '/users/create');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $username = 'Joe';

        $form = $crawler->selectButton('Ajouter')->form();
        $form['user[username]']->setValue($username);
        $form['user[password][first]']->setValue('test');
        $form['user[password][second]']->setValue('test');
        $form['user[email]']->setValue('test@test.com');
        $this->client->submit($form);

        // check creation
        $user = $this->userRepository->findOneBy(['username' => $username]);
        $this->assertEquals(true, (bool)$user);
        $userId = $user->getId();

        // delete user
        $this->client->request('GET', "/users/" . $userId . "/delete");

        // check deletion
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        $this->assertEquals(false, (bool)$user);
    }

    public function testEditUser()
    {
        $user = $this->loginAs('admin@admin.com');

        $testedUser = $this->userRepository->findOneBy(['email' => 'user@user.com']);

        $crawler = $this->client->request('GET', "/users/" . $testedUser->getId() . "/edit");

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $newUsername = 'New username';
        $newEmail = 'newemail@test.com';

        $form = $crawler->selectButton('Modifier')->form();
        $form['user[username]']->setValue($newUsername);
        $form['user[password][first]']->setValue('test');
        $form['user[password][second]']->setValue('test');
        $form['user[email]']->setValue($newEmail);
        $this->client->submit($form);

        $editedUser = $this->userRepository->findOneBy(['id' => $user->getId()]);

        $this->assertNotEquals($newUsername, $editedUser->getUsername());
        $this->assertNotEquals($newEmail, $editedUser->getEmail());
    }


}
