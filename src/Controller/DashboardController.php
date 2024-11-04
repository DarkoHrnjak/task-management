<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{

    public function __construct(Security $security)
    {
    }

    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        // Retrieve the logged-in user
        $user = $this->getUser();

        // You can pass the user data or any other data to your view
        return $this->render('DashBoard/index.html.twig', [
            'user' => $user,
        ]);
    }
}
