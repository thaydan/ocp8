<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    #[Route(path: '/tasks', name: 'task_list')]
    public function listTask(TaskRepository $taskRepository): Response
    {
        return $this->render('task/list.html.twig', [
            'list_title' => 'Tâches à faire',
            'list_custom_button' => [
                'route_name' => 'task_list_done',
                'title' => 'Tâches terminées',
                'color' => 'secondary'
            ],
            'tasks' => $taskRepository->findBy(['isDone' => false])
        ]);
    }

    #[Route(path: '/tasks/done', name: 'task_list_done')]
    public function listTaskDone(TaskRepository $taskRepository): Response
    {
        return $this->render('task/list.html.twig', [
            'list_title' => 'Tâches terminées',
            'list_custom_button' => [
                'route_name' => 'task_list',
                'title' => 'Tâches à faire',
                'color' => 'info'
            ],
            'tasks' => $taskRepository->findBy(['isDone' => true])
        ]);
    }

    #[Route(path: '/tasks/create', name: 'task_create')]
    public function createTask(Request $request): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setUser($this->getUser());

            $this->manager->persist($task);
            $this->manager->flush();

            $this->addFlash('success', 'La tâche a été bien été ajoutée.');

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/create.html.twig', ['form' => $form->createView()]);
    }

    #[Route(path: '/tasks/{id}/edit', name: 'task_edit')]
    public function editTask(Task $task, Request $request): Response
    {
        $this->denyAccessUnlessGranted('edit', $task);

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            $this->addFlash('success', 'La tâche a bien été modifiée.');

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
            'task' => $task,
        ]);
    }

    #[Route(path: '/tasks/{id}/toggle', name: 'task_toggle')]
    public function toggleTask(Task $task): Response
    {
        $this->denyAccessUnlessGranted('edit', $task);

        $task->toggle(!$task->isDone());
        $this->manager->flush();

        $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme faite.', $task->getTitle()));

        return $this->redirectToRoute('task_list');
    }

    #[Route(path: '/tasks/{id}/delete', name: 'task_delete')]
    public function deleteTask(Task $task): Response
    {
        $this->denyAccessUnlessGranted('edit', $task);

        $this->manager->remove($task);
        $this->manager->flush();

        $this->addFlash('success', 'La tâche a bien été supprimée.');

        return $this->redirectToRoute('task_list');
    }
}
