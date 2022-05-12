<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Embed\Embed;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Bookmarks;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookmarksRepository;


/**
* @Route("/api")
*/

class BookmarksApiController extends AbstractController
{


    private $manager;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->manager = $doctrine->getManager();
    }
    /**
     * @Route("/bookmarks/create", name="app_bookmarks",methods={"POST"})
     */
    public function index(Request $request): Response
    {

        $url=$request->request->all()['url'];
     
        $embed = new Embed();

        $info = $embed->get($url);
       
        $url=$info->url;
        $provider=$info->providerName;
        $title=$info->title;
        $author=$info->authorName; 
        $date_pub=$info->publishedTime;
        $width=$info->code->width; 
        $height=$info->code->height;
        $date_add= new \DateTime();
        
        $bookmarks=new Bookmarks;
      
        $bookmarks->setUrl($url);
        $bookmarks->setProvider($provider);
        $bookmarks->setTitle($title);
        $bookmarks->setAuthor($author);
        $bookmarks->setDatePub($date_pub);
        $bookmarks->setWidth($width);
        $bookmarks->setHeight($height);
        $bookmarks->setDateAdd($date_add);

        if($provider=="Vimeo"){
            $bookmarks->setDuration('5');
        }
        $this->manager->persist($bookmarks);
        $this->manager->flush();
       
        return $this->json(['Succus'=>'bookmars was created succusfully'],200);
       
    }

    /**
     * @Route("/bookmarkss/list", name="app_bookmarks_list",methods={"GET"})
     */
    //public function readBookss(BookmarksRepository $bookmarksRepository){
          //  $bookmarks=$bookmarksRepository->findAll();
           // return $this->json($bookmarks,200);
   // }


   /**
     * @Route("/bookmarks/list", name="app_bookmarks_list")
     */
    public function readBooks(BookmarksRepository $bookmarksRepository): Response
    {
        $bookmarks=$bookmarksRepository->findAll();
        return $this->render('books_list/index.html.twig', [
            'bookmarks'=>$bookmarks
        ]);
    }



    //delete api

    /**
     * @Route("/bookmarks/deletee/{id}", name="app_bookmarks_deletee",methods={"DELETE"})
     */

  // public function deleteBookk(Bookmarks $bookmarks){
    
      //$this->manager->remove($bookmarks);
      // $this->manager->flush();  
     
      //  return $this->json(['Succus'=>'bookmars was deleted succusfully'],200);
      // }


   /**
     * @Route("/bookmarks/delete/{id}", name="app_bookmarks_delete")
     */

    public function deleteBook(Bookmarks $bookmarks,Request $request){
     if($this->isCsrfTokenValid('delete' .$bookmarks->getId(), $request->get('_token'))){
          $this->manager->remove($bookmarks);
           $this->manager->flush(); 
         
          
        }
 
      return $this->redirectToRoute('app_bookmarks_list');
    }   


}
