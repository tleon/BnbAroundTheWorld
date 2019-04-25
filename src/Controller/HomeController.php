<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;
use App\Model\ReservationManager;
use App\Model\UsersManager;


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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ((!empty($_POST['username'])) && (!empty($_POST['password']))) {
                    $credentials = new UsersManager();
                    $userCheck = $credentials->checkUser($_POST['username'], $_POST['password']);
                if ($userCheck['logged']) {
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['email'] = $userCheck['email'];
                    $_SESSION['status'] = $userCheck['status'];
                    if($userCheck['status'] == "Administrator"){
                        header('Location: /Admin/index');
                    }else{
                        header('Location: /Home/index');
                    }
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
    }


    /**
     * Allow the user to create his account if the username is not already taken.
     * 
     * 
     */
    public function signIn() {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                $account = ["username" => $_POST['username'],
                            "pass" => $_POST['password'],
                            "mail" => $_POST['email'],
                            "status" => "User" ];
                $user = new UsersManager();
                //check if user already exist
                $users = $user->selectAll();
                $exist = false;
                foreach($users as $u ){
                    if(in_array($account['username'], $u)){
                        $exist = true;
                        break;
                    }
                }
                if (!$exist){
                    if($user->insert($account)){
                        return $this->twig->render('Home/signIn.html.twig', ['error' => "", "success" => "Votre compte a été créé ". $_POST['username']]);
                    }else {
                        return $this->twig->render('Home/signIn.html.twig', ['error' => "Une erreur est survenue pendant l'inscription", "success" => ""]);
                    }
                }else {
                    return $this->twig->render('Home/signIn.html.twig', ['error' => "Cet utilisateur existe déjà.", "success" => ""]);
                }
            }else {
                return $this->twig->render('Home/signIn.html.twig', ['error' => "Tous les champs sont obligatoires", "success" => ""]);
            }
        }else{
            return $this->twig->render('Home/signIn.html.twig', ['error' => "", "success" => ""]);
        }
    }

    /**
     * logs out the user and destroy the session.
     */

    public function logout(){
        session_destroy();
        header('Location: /Home/index');
    }

  
}