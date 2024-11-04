<?php
// src/Controller/Api/YourApiController.php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\YourService;

class YourApiController extends AbstractController
{
	private $yourService;

	public function __construct(YourService $yourService)
	{
		$this->yourService = $yourService;
	}

	/**
	 * @Route("/api/your-endpoint", methods={"GET"})
	 */
	public function getYourData(SerializerInterface $serializer)
	{
		$data = $this->yourService->yourLogic();

		// Serialize the data into JSON
		$jsonData = $serializer->serialize($data, 'json');

		return new JsonResponse($jsonData, 200, [], true); // Pass `true` to skip double encoding
	}
}
