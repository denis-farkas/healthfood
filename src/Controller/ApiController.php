<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api', name: 'app_api', methods: ['GET'])]
    public function getProducts(ProductRepository $productRepository): JsonResponse
    {
        $products = $productRepository->findAll();
        
        // Add debug info to verify products are being fetched
        $count = count($products);
        if ($count > 0) {
            $sample = [
                'id' => $products[0]->getId(),
                'name' => $products[0]->getName(),
                // Add other fields you expect to be here
            ];
        } else {
            $sample = null;
        }
        
        // Log debug info
        $this->addFlash('debug', "Found $count products. Sample: " . json_encode($sample));
        
        // Return with ignored_attributes option to avoid circular references
        return $this->json($products, 200, [], [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            },
            'ignored_attributes' => ['category.products', 'products.category']
        ]);
    }
}