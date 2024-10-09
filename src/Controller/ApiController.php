<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
	#[Route('/api/submit', name: 'api_submit', methods: ['POST'])]
	public function submit(Request $request): JsonResponse
	{
		// Handle the request data
		return new JsonResponse(['message' => 'Response from Symfony!']);
	}
}
