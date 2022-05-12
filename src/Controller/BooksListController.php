<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookmarksRepository;

class BooksListController extends AbstractController
{
    /**
     * @Route("/books/list", name="app_books_list")
     */
    public function index(): Response
    {
        return $this->render('books_list/index.html.twig');

    }
    /**
     * @Route("/vimeo/list", name="app_vimeo_list")
     */
    public function vimeo(BookmarksRepository $bookmarksRepository): Response
    {
        $vimeos=$bookmarksRepository->findBy(['provider'=>'Vimeo']);
        return $this->render('books_list/vimeo.html.twig', [
             'vimeos'=>$vimeos
        ]);
    }

    /**
     * @Route("/flickr/list", name="app_flickr_list")
     */
    public function flickr(BookmarksRepository $bookmarksRepository): Response
    {
        $flickrs=$bookmarksRepository->findBy(['provider'=>'Flickr']);
        return $this->render('books_list/flickr.html.twig', [
            'flickrs'=>$flickrs
        ]);
    }
    
}
