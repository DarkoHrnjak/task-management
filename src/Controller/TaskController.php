<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Form\TaskFilterType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
	#[Route('/tasks', name: 'tasks_index', methods: ['GET', 'POST'])]
	public function index(Request $request, TaskRepository $taskRepository): Response
	{
		// Create the filter form
		$form = $this->createForm(TaskFilterType::class);
		$form->handleRequest($request);

		// Default query to fetch all tasks
		$queryBuilder = $taskRepository->createQueryBuilder('t');

		if ($form->isSubmitted() && $form->isValid()) {
			$data = $form->getData();

			// Apply filters based on form data
			if (!empty($data['title'])) {
				$queryBuilder->andWhere('t.title LIKE :title')
							 ->setParameter('title', '%' . $data['title'] . '%');
			}

			if (!empty($data['status'])) {
				$queryBuilder->andWhere('t.status = :status')
							 ->setParameter('status', $data['status']);
			}

			if (!empty($data['priority'])) {
				$queryBuilder->andWhere('t.priority = :priority')
							 ->setParameter('priority', $data['priority']);
			}
		}

		$tasks = $queryBuilder->getQuery()->getResult();

		return $this->render('task/index.html.twig', [
			'tasks' => $tasks,
			'filterForm' => $form->createView(),
		]);
	}


	#[Route('/tasks/new', name: 'task_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        // Initialize the isCompleted property to false
        $task->setCompleted(false);

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Persist the task
            $entityManager->persist($task);
            $entityManager->flush();

            // Redirect to the correct route
            return $this->redirectToRoute('tasks_index'); // Ensure this matches your route name
        }

        return $this->render('task/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/tasks/{id}/edit', name: 'task_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('tasks_index');
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView(),
            'task' => $task,
        ]);
    }

    #[Route('/tasks/{id}/delete', name: 'task_delete', methods: ['GET','POST'])]
    public function delete(Task $task, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($task);
        $entityManager->flush();
        return $this->redirectToRoute('tasks_index');
    }

    #[Route('/tasks/{id}', name: 'task_show', methods: ['GET','POST'])]
    public function show(Task $task): Response
    {
        return $this->render('task/show.html.twig', [
            'task' => $task,
        ]);
    }

}
