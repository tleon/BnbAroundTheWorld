<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;
use App\Model\ReservationManager;

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {

        /*
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ((!empty($_POST['email'])) && (!empty($_POST['pass']))) {
                if (($_POST['email'] == 'admin') && ($_POST['pass'] == 'admin')) {
                    header('Location:/Admin/index');
                }else {
                    return $this->twig->render('Home/index.html.twig', [
                        'error' => ' : Email ou mot de passe incorrect.'
                    ]);
                }
            }
        }
        */
        return $this->twig->render('Home/index.html.twig',['test'=>$_POST]);
    }




}