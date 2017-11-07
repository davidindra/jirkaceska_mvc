<?php
/**
 * Created by PhpStorm.
 * User: Jirka
 * Date: 6.11.2017
 * Time: 16:29
 */

class EditArticleController extends Controller
{
    public function process($params)
    {
        // Vytvoření instance modelu, který nám umožní pracovat s články
        $loadArticle = new ArticleManager();

        // Získání článku podle URL
        $article = $loadArticle->getArticle($params[0]);

        // Hlavička stránky
        $this->header = array(
            'title' => $article['title'],
            'key_words' => $article['key_words'],
            'description' => $article['description'],
        );

        // Naplnění proměnných pro šablonu
        $this->data['title'] = $article['title'];
        $this->data['content'] = $article['content'];
        $this->data['url'] = $article['url'];
        $this->data['description'] = $article['description'];
        $this->data['key_words'] = $article['key_words'];

        if (isset($_POST) && count($_POST)) {
            $_POST = $this->trimValues($_POST);
            $this->data = $this->trimValues($this->data);

            if ($_POST != $this->data) {
               $loadArticle->updateArticle($_POST, $article['article_id']);
                echo "Změna";
            }

             $this->redirect("article/".$article['url']);
        }




        $this->view = 'article_edit';
    }

    public function trimValues($array) {
        foreach ($array as $key => $item) {
            $array[$key] = trim($item);
        }
        return $array;
    }
}