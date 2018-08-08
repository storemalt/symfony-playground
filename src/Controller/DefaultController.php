<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function index(): Response
    {
        return $this->render('index.html.twig', ['myCoolVariable' => 'Yay! It works.']);
    }

    public function hello(Request $request, string $name): Response
    {
        $lastName = $request->get('lastName', 'noName');
        return $this->render('hello.html.twig', ['firstName' => $name, 'lastName' => $lastName]);
    }
}
