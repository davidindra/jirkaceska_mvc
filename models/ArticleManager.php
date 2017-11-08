<?php
/**
 * Created by PhpStorm.
 * User: Jirka
 * Date: 6.11.2017
 * Time: 11:23
 */

/**
 * Class ArticleManager takes care about article set lying in database.
 */
class ArticleManager
{
    /**
     * Returns article from database by its URL
     * @param $url string URL
     * @return Article
     * @throws Exception when article doesn't exist
     */
    public function getArticle($url)
    {
        $item = Db::queryOneRow('
                SELECT `article_id`, `title`, `content`, `url`, `description`, `key_words`
                FROM `article`
                WHERE `url` = ?
        ', array($url));

        if($item == null) throw new Exception("Article with that URL doesn't exist.");

        $article = new Article();

        $article->id = $item['id'];
        $article->slug = $item['url'];
        $article->keyWords = $item['key_words'];
        $article->title = $item['title'];
        $article->description = $item['description'];
        $article->content = $item['content'];

        return $article;
    }

    /**
     * Returns all existing articles
     * @return Article[]
     */
    public function getAllArticles()
    {
        $data = Db::queryFewRows('
                SELECT `article_id`, `title`, `url`, `description`
                FROM `article`
                ORDER BY `article_id` DESC
        ');

        $articles = [];

        foreach ($data as $articleData) {
            $article = new Article();

            $article->id = $articleData['id'];
            $article->slug = $articleData['url'];
            $article->keyWords = $articleData['key_words'];
            $article->title = $articleData['title'];
            $article->description = $articleData['description'];
            $article->content = $articleData['content'];

            $articles[] = $article;
        }

        return $articles;
    }

    /**
     * Updates some article (paired by ID)
     * @param $article Article
     */
    public function updateArticle(Article $article)
    {
        Db::update('
                UPDATE `article`
                SET title=?,content=?,url=?,description=?,key_words=?
                WHERE article_id=?
        ', array(
            $article->title,
            $article->content,
            $article->slug,
            $article->description,
            $article->keyWords,
            $article->id
        ));
    }
}