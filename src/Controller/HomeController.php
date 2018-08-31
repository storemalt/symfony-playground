<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

Class HomeController extends Controller {

    public function index(): Response {
        $data = [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'address' => '1 D 2nd Avenue Cor 3rd Street, Melbourne, Australia',
        ];

        return $this->render('home/index.html.twig', [
            'data' => $data
        ]);
    }

}