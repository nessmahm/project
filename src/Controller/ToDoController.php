<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/todo' ,name: 'todo' )]

class ToDoController extends AbstractController
{
          
    
    //----------------------------------

    #[Route("/" ,name: 'todo' )]
    public function indexAction(Request $request): Response
        {  
            $session = $request->getSession(); 
            if(!$session->has('todos')) {
                
                $todos=array(
                    'achat'=>'acheter clé usb',
                    'cours'=>'Finaliser mon cours',
                    'correction'=>'corriger mes examens'
                    );

            $session->set('todos',$todos); 
            $this->addFlash("info","La liste des todos viens d étre initialisée");
            }


    
            return $this->render('contoller/listeToDo.html.twig');
        }
    //-----------------------------------
    #[Route('/todo/add/{name}/{content}' ,name: 'todo.add' )]
    public function indexAction2(Request $request,$name,$content): Response
        {   $session = $request->getSession(); 
        
            if($session->has('todos') ) {
                $todos=  $session->get('todos');
                if(isset($todos[$name])) {
                      $this->addFlash("error","le todo d'id  $name existe deja ");
                }
        
               else {
            
                    $todos[$name]=$content;
                    $session->set('todos',$todos);
                    $this->addFlash("success","le todo d'id  $name a été ajouté avec succés ");

                
                }
            }
                
            else {
                    $error="";
                    $this->addFlash("error","La liste des todos n'est pas encore initialisée");
            }
                    return $this->redirectToRoute('todo');



    
            return $this->render('contoller/listeToDo.html.twig');
        }  
    
    //------------------------------------

    #[Route('/todo/update/{name}/{content}' ,name: 'todo.update' )]
        public function indexAction3(Request $request,$name,$content): Response
        {   $session = $request->getSession(); 
        
            if($session->has('todos') ) {
                $todos=  $session->get('todos');
                if(!isset($todos[$name])) {
                      $this->addFlash("error","le todo d'id  $name n'existe pas ");
                }
        
               else {
            
                    $todos[$name]=$content;
                    $session->set('todos',$todos);
                    $this->addFlash("success","le todo d'id  $name a été mis a jour avec succés ");

                
                }
            }
                
            else {
                    $error="";
                    $this->addFlash("error","La liste des todos n'est pas encore initialisée");
            }
                    return $this->redirectToRoute('todo');



    
            return $this->render('contoller/listeToDo.html.twig');
        }

    //-----------------------------------------------------------
        
    #[Route('/todo/delete/{name}' ,name: 'todo.delete' )]
        public function indexAction4(Request $request,$name): Response
        {   $session = $request->getSession(); 
        
            if($session->has('todos') ) {
                $todos=  $session->get('todos');
                if(!isset($todos[$name])) {
                      $this->addFlash("error","le todo d'id  $name n'existe pas ");

                }
            
        
               else {
            
                   unset( $todos[$name]);
                    $session->set('todos',$todos);
                    $this->addFlash("success","le todo a été supprimé avec succés ");
                
                }
            }
                
            else {
                    $error="";
                    $this->addFlash("error","La liste des todos n'est pas encore initialisée");
            }
                    return $this->redirectToRoute('todo');



    
            return $this->render('contoller/listeToDo.html.twig');
        }
    
    //-----------------------------------------------------------
        
    #[Route('/todo/reset/{name}/{content}' ,name: 'todo.reset' )]
        public function indexAction5(Request $request): Response
        {
            $session = $request->getSession(); 
            $session->remove('todos');
        
             
            return $this->render('contoller/listeToDo.html.twig');
        } 
  
  

}
