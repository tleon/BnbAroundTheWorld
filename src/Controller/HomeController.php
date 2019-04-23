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
     *Email
     * also check the credentials for the admin page redirection
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxErrorEmail
     */
    public function index()
    {

        /*
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ((!empty($_POST['email'])) && (!empty($_POST['password']))) {
                if (($_POST['email'] == 'admin') && ($_POST['password'] == 'admin')) {
                    header('Location: /Admin/index');
                }else {
                    return $this->twig->render('Home/index.html.twig', [
                        'error' => "Email ou mot de passe incorrect."
                    ]);
                }
            } else {
                return $this->twig->render('Home/index.html.twig', [
                    'error' => "L'email et le mot de passe ne peuvent être vide."
                ]);
            }
        }else {
            return $this->twig->render('Home/index.html.twig', ['error' => ""]);
        }
        */
        return $this->twig->render('Home/index.html.twig');
    }




}