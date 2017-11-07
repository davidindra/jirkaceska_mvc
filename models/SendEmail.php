<?php
/**
 * Created by PhpStorm.
 * User: Jirka
 * Date: 5.11.2017
 * Time: 20:52
 */

class SendEmail
{
    public function send($to, $subject, $message, $from)
    {
        $header = "From: " . $from;
        $header .= "\nMIME-Version: 1.0\n";
        $header .= "Content-Type: text/html; charset=\"utf-8\"\n";
        return mb_send_mail($to, $subject, $message, $header);
    }
}