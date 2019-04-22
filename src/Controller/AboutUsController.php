<?php

namespace App\Controller;

class AboutUsController extends AbstractController
{

    /**
     * Display admin home page
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

    /**
     * Allow connection to admin page
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    
}
