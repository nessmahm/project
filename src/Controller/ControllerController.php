<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContollerController extends AbstractController
{
    #[Route('/first1', name: 'first1')]
    public function ex1(): Response
    {
        return $this->render('contoller/index.html.twig');
    }

    //----------------------------------

    #[Route('/first2/{name}', name: 'first2', defaults: ['name' => null])]
    public function ex2($name = null): Response
    {
        return $this->render('contoller/index2.html.twig', ["name" => $name]);
    }

    //---------------------------------

    #[Route('/first3/{name}', name: 'first3', defaults: ['name' => null])]
    public function ex3(Request $req, $name = null): Response
    {
        $req = new Request();

        return $this->render('contoller/index3.html.twig', ["name" => $name, "request" => $req]);
    }

    //----------------------------------

    #[Route('/cv', name: 'first5')]
    public function ex4(Request $req): Response
    {
        $session = $req->getSession();
        $tab = [];
        if (!$session->has('tab')) {
            $tab = ["name" => "nessma", "firstname" => "Hamidou", "age" => 20, "section" => "GL"];
            $session->set('tab', $tab);
        }
        return $this->render('contoller/index4.html.twig', ["tab" => $tab]);
    }


    //--------------------------Exercice1-twig

    #[Route('/forminsat/{nom}/{prenom}/{section}/{age}', name: 'first4',
        requirements: ['nom'=>'\w','prenom'=>'\w','section'=>'GL' ]
         )]
    public function exercice1(Request $req, string  $nom, string $prenom, string $section, int $age): Response
    {
        $session = $req->getSession();
        $tab = [];
        $tab = ["name" => $nom, "firstname" => $prenom, "age" => $age, "section" => $section];
        $session->set('tab', $tab);

        return ($this->redirectToRoute('first5'));




    }


    //----------------------------------


    #[Route('/req/{tst}/{tsst}', name: 'firstreq',
    requirements: ['tst'=>"da | m"]
    )]
    public function req(Request $req,$tst,$tsst): Response
    {

        return $this->render( 'contoller/index.html.twig');
    }



}
