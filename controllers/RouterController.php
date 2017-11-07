<?php
/**
 * Created by PhpStorm.
 * User: Jirka
 * Date: 2.11.2017
 * Time: 15:49
 */

class RouterController extends Controller
{
    protected $controller;

    public function process($params)
    {
        $parsedURL = $this->parseURL($params[0]);
        if (empty($parsedURL[0]))
            $this->redirect('article/uvod');

        $controllerClass = $this->dashToCamelCase(array_shift($parsedURL)) . 'Controller';
        if (count($parsedURL) > 1 && $parsedURL[1] == "edit") {
            $controllerClass = ucwords($parsedURL[1]) . $controllerClass;
        }
        if (file_exists('controllers/' . $controllerClass . '.php'))
            $this->controller = new $controllerClass;
        else
            $this->redirect('not-found');

        $this->controller->process($parsedURL);

        $this->data['title'] = $this->controller->header['title'];
        $this->data['description'] = $this->controller->header['description'];
        $this->data['key_words'] = $this->controller->header['key_words'];

        $this->view = 'layout';
    }

    private function parseURL($url)
    {
        $parsedURL = parse_url($url);
        $parsedURL["path"] = ltrim($parsedURL["path"], "/");
        $parsedURL["path"] = trim($parsedURL["path"]);

        $urlArray = explode("/", $parsedURL["path"]);
        return $urlArray;
    }

    private function dashToCamelCase($text)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $text)));
    }
}