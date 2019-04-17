<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

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
        return $this->twig->render('Home/index.html.twig');






/*verification des données de reservation renvoyer par le calendrier
*
*
*/


//definition de tableau valide auquel on compare les valeurs renvoyer

$validValues = array 
(
'country' => ["1","2","3","4","5"],
'date' => ["date"],
'numberGuest' => ["1","2","3","4","5","6","7","8","9","10"]
);

$error = array();




function test_input($value) 
{
    $data = trim($value);
    $data = stripslashes($value);
    $data = htmlspecialchars($value);
    return $value;
}


if ($_SERVER("REQUEST_METHOD") == "POST")
{
    foreach ($_POST as $key => $value)
    {
        if (empty($_POST[$value]) || !in_array($_POST[$value], $validValues[$value]))
        {
            $error[$key] = "erreur pendant la reservation, recharger la page et retentez";
        }
        else
        {
            $reservation[$key] = test_input($value);
        }
    }
    if (empty($error))
    {
        $reservation;
    }
}
    }
}