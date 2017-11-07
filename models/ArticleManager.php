<?php
/**
 * Created by PhpStorm.
 * User: Jirka
 * Date: 6.11.2017
 * Time: 11:23
 */

class ArticleManager
{
    // Vrátí článek z databáze podle jeho URL
    public function getArticle($url)
    {
        return Db::queryOneRow('
                SELECT `article_id`, `title`, `content`, `url`, `description`, `key_words`
                FROM `article`
                WHERE `url` = ?
        ', array($url));
    }

    // Vrátí seznam článků v databázi
    public function getAllArticles()
    {
        return Db::queryFewRows('
                SELECT `article_id`, `title`, `url`, `description`
                FROM `article`
                ORDER BY `article_id` DESC
        ');
    }

    public function updateArticle($article, $article_id)
    {
        Db::update('
                UPDATE `article`
                SET title=?,content=?,url=?,description=?,key_words=?
                WHERE article_id=?
        ', array(
                $article['title'],
                $article['content'],
                $article['url'],
                $article['description'],
                $article['key_words'],
                $article_id
        ));
    }
}