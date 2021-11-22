<?php

namespace App\Controller;

use App\Entity\Advert;
use App\Repository\AdvertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvertController extends AbstractController
{
    /**
     * @Route("/", defaults={"page": "1"}, methods="GET", name="advert_index")
     * @Route("/{page<[1-9]\d*>}", methods="GET", name="advert_index_paginated")
     */
    public function list(int $page, AdvertRepository $adverts): Response
    {
        $paginateAdverts = $adverts->findPaginateAdverts($page);

        return $this->render('advert/index.html.twig', [
            'paginator' => $paginateAdverts,
        ]);
    }

    /**
     * @Route("/view/{id}", methods="GET", name="advert_view")
     */
    public function show(int $id): Response
    {
        $advert = $this->getDoctrine()
            ->getRepository(Advert::class)
            ->find($id);

        if (!$advert) {
            throw $this->createNotFoundException('No product found for id ' . $id);
        }

        return $this->render('advert/show.html.twig', [
            'advert' => $advert,
        ]);
    }
}
