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
        $isconnected = isset($_SESSION['id']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['id'])){
                $opinionData['user_id'] = $_SESSION['id'];
            }
            else{
                $opinionData['user_id']='NULL';
            }

            $opinionData['room_id']=$_POST['roomId'];
            $opinionData['comment']=$_POST['opinion'];
            $opinionData['grade']=$_POST['star'];

            $feedback = new FeedbackManager();
            $feedback->insertOpinion($opinionData);
        }

        return $this->twig->render('AboutUs/aboutUs.html.twig', ['session' => $_SESSION, 'isconnected'=>$isconnected]);
    }
    
}
