<?php

namespace App\Controller;

Use App\Classes\Calendar;

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
        return $this->twig->render('Admin/index.html.twig');
    }

    /**
     * Display planning page
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function planning()
    {
        try {
            $month = new Calendar($_GET['month'] ?? null, $_GET['year'] ?? null);
        } catch (\Exception $e) {
            $month = new Calendar;
        }
        return $this->twig->render('Admin/planning.html.twig', ['planning' => $month]);
    }
}
