<?php

namespace App\Controller;

use App\Model\FeedbackManager;

class AboutUsController extends AbstractController
{

    /**
     * Display aboutus page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show()
    {
        return $this->twig->render('AboutUs/aboutUs.html.twig');
    }

 /*   public function donneTonAvis()
    {

    }*/
    
}
