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
        $articleManager = new ArticleManager();

        if (!empty($params[0])) {
            // Získání článku podle URL
            $article = $articleManager->getArticle($params[0]);

            // Pokud nebyl článek s danou URL nalezen, přesměrujeme na ChybaKontroler
            if (!$article)
                $this->redirect('not-found');

            // Hlavička stránky
            $this->pageTitle = $article->title;
            $this->metaDescription = $article->description;
            $this->metaKeywords = $article->keyWords;

            // Naplnění proměnných pro šablonu
            $this->data['article'] = $article;

            $this->view = 'article';
        } else {
            $articles = $articleManager->getAllArticles();
            $this->data['articles'] = $articles;
            $this->view = 'articles';
        }
    }
}