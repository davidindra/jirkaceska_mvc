<?php
/**
 * Created by PhpStorm.
 * User: Jirka
 * Date: 2.11.2017
 * Time: 18:22
 */

class NotFoundController extends Controller
{
    public function process($params)
    {
        // Hlavička požadavku
        header("HTTP/1.0 404 Not Found");
        // Hlavička stránky
        $this->header['title'] = 'Chyba 404';
        // Nastavení šablony
        $this->view = 'notFound';
    }
}