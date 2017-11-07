<?php
/**
 * Created by PhpStorm.
 * User: Jirka
 * Date: 5.11.2017
 * Time: 20:56
 */

class ContactController extends Controller
{
    public function process($params)
    {
        $this->header = array(
            'title' => 'Kontaktní formulář',
            'key_words' => 'kontakt, email, formulář',
            'description' => 'Kontaktní formulář našeho webu.'
        );

        if (isset($_POST["email"])) {
            if ($_POST['year'] == date("Y")) {
                $emailSender = new SendEmail();
                $emailSender->send("admin@adresa.cz", "Email z webu", $_POST['zprava'], $_POST['email']);
            }
        }

        $this->view = 'contact';
    }
}