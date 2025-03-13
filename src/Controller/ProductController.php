<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/products', name: 'app_product')]
    public function index(EntityManagerInterface $entityManager): Response
    {

    $products = $entityManager->getRepository(Product::class)->findAll() ;

        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/product/{id}', name: 'app_product_by_id')]
    public function ficheProduit($id,EntityManagerInterface $entityManager): Response
    {

    $product = $entityManager->getRepository(Product::class)->find($id) ;

        return $this->render('product/fiche_produit.html.twig', [
            'product' => $product
        ]);
    }
}
