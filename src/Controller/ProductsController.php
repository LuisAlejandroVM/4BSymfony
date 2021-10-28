<?php

namespace App\Controller;

header('Access-Control-Allow-Origin: *');

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

// Json Response
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductsController extends AbstractController{
    
    public function products(){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT p.idproduct, p.name, p.price, p.status FROM App:Products p');
        $listProducts = $query->getResult();

        $data = ['status' => 200,'message' => 'No se encontraron resultados.'];

        if(count($listProducts) > 0){
            $data = [
                'status' => 200,
                'message' => 'Se encontraron ' . count($listProducts) . ' resultados.',
                'listProducts' => $listProducts
            ];
        }

        return new JsonResponse($data);
    }

    public function product_by_id($id){
        $em = $this->getDoctrine()->getManager();

        //$product = $em->getRepository('App:Products')->findOneBy(['idproduct' => $id]);
        $query = $em->createQuery('SELECT p.idproduct, p.name, p.price, p.status FROM App:Products p WHERE p.idproduct = :p');
        $query->setParameter(':p', $id);
        $product = $query->getResult();

        $data = [
            'status' => 200,
            'message' => 'Se encontró el producto',
            'product' => $product
        ];

        return new JsonResponse($data);
    }

    public function create_product(Request $request){
        $em = $this->getDoctrine()->getManager();
        
        $name = $request->get('name', null);
        $price = $request->get('price', null);

        $product = new \App\Entity\Products();

        $product->setName($name);
        $product->setPrice($price);
        $product->setStatus(1);

        $em->persist($product);
        $em->flush();

        $data = [
            'status' => 200,
            'message' => 'Se ha creado correctamente.'
        ];

        return new JsonResponse($data);
    }

    public function update_product(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        
        $name = $request->get('name', null);
        $price = $request->get('price', null);

        // $product = new \App\Entity\Products();
        $query = $em->createQuery('UPDATE App:Products p SET p.name = :name, p.price = :price WHERE p.idproduct = :id');
        $query->setParameter(':name', $name);
        $query->setParameter(':price', $price);
        $query->setParameter(':id', $id);
        $flag = $query->getResult();

        if($flag == 1){
            $data = [ 'status' => 200, 'message' => 'Se ha actualizado correctamente.' ];
        } else {
            $data = [ 'status' => 400, 'message' => 'No se ha actualizado correctamente.' ];
        }

        return new JsonResponse($data);
    }
}
