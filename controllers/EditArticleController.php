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
        $articleManager = new ArticleManager();

        // Získání článku podle URL
        $article = $articleManager->getArticle($params[0]);

        // Hlavička stránky
        $this->pageTitle = $article->title;
        $this->metaDescription = $article->description;
        $this->metaKeywords = $article->keyWords;

        // Naplnění proměnných pro šablonu
        $this->data['article'] = $article;

        if (isset($_POST) && count($_POST)) {
            $data = $this->trimValues($_POST);

            $newArticle = new Article();

            $newArticle->id = $data['id'];
            $newArticle->slug = $data['url'];
            $newArticle->keyWords = $data['key_words'];
            $newArticle->title = $data['title'];
            $newArticle->description = $data['description'];
            $newArticle->content = $data['content'];

            $articleManager->updateArticle($newArticle);

            echo "Článek byl změněn.";

            $this->redirect("article/" . $article->slug);
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