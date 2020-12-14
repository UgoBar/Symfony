<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Entity\Product;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $repository): Response
    {
        $products = $repository->findAll();
        
        return $this->render('front/index.html.twig', [
            'products' => $products
        ]);
    }
    
    
    /**
     * @Route("/product/{permalink}", name="productDetail")
     */
    public function productDetail(Product $product): Response
    {
        return $this->render('front/productDetail.html.twig', [
            'product' => $product
        ]);
    }
    /*public function productDetail($permalink, ProductRepository $repository): Response
    {
       
        $product = $repository->findByPermalink($permalink);
         dump($product);
        return $this->render('front/detailProduct.html.twig', [
            'product' => $product[0]
        ]);
    }*/
}

