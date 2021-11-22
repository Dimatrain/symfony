<?php

namespace App\Controller;

use App\Repository\AdvertRepository;
use Faker\Provider\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdvertController extends AbstractController
{
    /**
     * Получение списка
     *
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
     * @Route("/view/{id<[1-9]\d*>}", methods="GET", name="advert_view")
     */
    public function show(int $id, AdvertRepository $adverts): Response
    {
        $advert = $adverts->find($id);

        if (!$advert) {
            throw $this->createNotFoundException('No product found for id ' . $id);
        }

        return $this->render('advert/show.html.twig', [
            'picture' => Image::imageUrl(),
            'advert' => $advert,
        ]);
    }
}
