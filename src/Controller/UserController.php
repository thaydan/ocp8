<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/users')]
class UserController extends AbstractController
{
    private ManagerRegistry $doctrine;
    private UserPasswordHasherInterface $userPasswordHasher;
    private EntityManagerInterface $manager;

    public function __construct(ManagerRegistry $doctrine, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $manager)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->doctrine = $doctrine;
        $this->manager = $manager;
    }

    #[Route(path: '', name: 'user_list')]
    public function listUser(): Response
    {
        return $this->render(
            'user/list.html.twig',
            ['users' => $this->doctrine->getRepository(User::class)->findAll()]
        );
    }

    #[Route(path: '/create', name: 'user_create')]
    public function createUser(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->doctrine->getManager();
            $user->setPassword($this->userPasswordHasher->hashPassword($user, $user->getPassword()));

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', "L'utilisateur a bien été ajouté.");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/create.html.twig', ['form' => $form->createView()]);
    }

    #[Route(path: '/{id}/edit', name: 'user_edit')]
    public function editUser(User $user, Request $request): Response
    {
        $this->denyAccessUnlessGranted('edit', $user);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($user->getPassword()) {
                $user->setPassword($this->userPasswordHasher->hashPassword($user, $user->getPassword()));
            }

            $this->doctrine->getManager()->flush();

            $this->addFlash('success', "L'utilisateur a bien été modifié");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig', ['form' => $form->createView(), 'user' => $user]);
    }

    #[Route(path: '/{id}/delete', name: 'user_delete')]
    public function deleteUser(User $user): Response
    {
        $this->denyAccessUnlessGranted('delete', $user);

        foreach ($user->getTasks() as $task) {
            $task->setUser(null);
            $this->manager->persist($task);
            $this->manager->flush();
        }

        $this->manager->remove($user);
        $this->manager->flush();

        $this->addFlash('success', "L'utilisateur a bien été supprimé.");

        //return new Response('fff');
        return $this->redirectToRoute('user_list');
    }
}
