<?php
namespace App\Controller;

require_once '/vendor/autoload.php';

class mail extends AbstractController
{
    public function mail()
    {


    // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 25))
  ->setUsername('BnB.aroundWorld@gmail.com')
  ->setPassword('your password');
    

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Confirmation de reservation'))
    ->setFrom(['BnB.aroundWorld@gmail.com' => 'BnB Around The World'])
    ->setTo([$session["email"]])
    ->setBody("Votre reservation a bien été prise en compte. Nous vous remercions de votre confiance et vous souhaitons un agreable sejours.
    Pour annuler votre reservation veuillez suivre ce lien : www.blabla.com*
    *Attention : l'annulation d'une reservation doit se fair dans les 48h avant le debut du sejour.");

        // Send the message
        $result = $mailer->send($message);
    }
}
