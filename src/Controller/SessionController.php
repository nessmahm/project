<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(Request $req): Response
    {   
        $session = $req->getSession(); 
        if($session->has('nbVisite')) {

            $nbr=$session->get('nbVisite');

        }
        else {
            $nbr=0;
        }
        $nbr++;
        $session->set('nbVisite',$nbr);
        return $this->render('session/index.html.twig', [
            'nbr' => $nbr,
        ]);
    }
}
 
