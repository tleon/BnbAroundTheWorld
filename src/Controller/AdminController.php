<?php

namespace App\Controller;


class AdminController extends AbstractController
{
    /**
     * Display admin home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {   
        if(($_SESSION['status'] != 'Administrator') || empty($_SESSION)){
            return $this->twig->render('Home/index.html.twig', ["error" => 'You can\'t access the admin space.']);
        }else{
            return $this->twig->render('Admin/index.html.twig');
        }

    }

    /**
     * Allow connection to admin page
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    
}
