<?php
/**
 * Created by PhpStorm.
 * User: Jirka
 * Date: 6.11.2017
 * Time: 11:27
 */

class ArticleController extends Controller
{
    public function process($params)
    {
        // Vytvoření instance modelu, který nám umožní pracovat s články
        $loadArticle = new ArticleManager();

        if (!empty($params[0])) {
            // Získání článku podle URL
            $article = $loadArticle->getArticle($params[0]);
            // Pokud nebyl článek s danou URL nalezen, přesměrujeme na ChybaKontroler
            if (!$article)
                $this->redirect('not-found');

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

            $this->view = 'article';
        } else {
            $articles = $loadArticle->getAllArticles();
            $this->data['articles'] = $articles;
            $this->view = 'articles';
        }
    }
}