<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('Page/home.html.twig', [
            'foo' => 'bar',
            'super_list' => [
                'Bob',
                'Eponge'
            ],
        ]);
    }
}
