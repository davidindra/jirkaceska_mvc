<?php
/**
 * Created by PhpStorm.
 * User: Jirka
 * Date: 2.11.2017
 * Time: 15:42
 */

abstract class Controller
{

    protected $data = array();
    protected $view = "";
    protected $header = array('title' => '', 'key_words' => '', 'description' => '');

    abstract function process($params);

    public function returnView()
    {
        if ($this->view)
        {
            extract($this->saveHandler($this->data));
            extract($this->data, EXTR_PREFIX_ALL, "");
            require("views/" . $this->view. ".phtml");
        }
    }

    public function redirect($url)
    {
        header("Location: /$url");
        header("Connection: close");
        exit;
    }

    private function saveHandler($x = null)
    {
        if (!isset($x))
            return null;
        elseif (is_string($x))
            return htmlspecialchars($x, ENT_QUOTES);
        elseif (is_array($x))
        {
            foreach($x as $k => $v)
            {
                $x[$k] = $this->saveHandler($v);
            }
            return $x;
        }
        else
            return $x;
    }
}