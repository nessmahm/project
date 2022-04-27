<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FirstController extends AbstractController 
{

  #[Route('/first', name: 'first')]  
  /**
   * index
   *
   * @return Response
   */
  public function index(): Response
  { 


      
    return $this->render('first/index.html.twig',[
      'name'=>'nessma',
      'firstname'=>'hamidou'
    ]);


  }


   #[Route('/sayHello', name: 'say.hello')]  
  /**
   * sayHello
   *
   * @return Response
   */
  public function sayHello(): Response
  { 
    $rand = rand(0,10) ;
    echo $rand  ;
    if($rand > 7) {
      //return $this-->redirectToRoute('first');
      return $this->redirectToRoute('first');
    }
    echo " meee ";
    return $this->forward('App\Controller\FirstController::index'
    );


  } 



  #[Route('/sayHello2/{name}/{firstname}', name: 'say.hello2')]  
  /**
   * sayHello2
   *
   * @param  mixed $req
   * @param  mixed $name
   * @param  mixed $firstname
   * @return Response
   */
  public function sayHello2(Request $req , $name,$firstname): Response
  { 
    return $this->render('first/index.html.twig',[
      'firstname'=>$firstname , 'name'=>$name ]);
  }



}
