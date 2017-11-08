<?php
/**
 * Created by PhpStorm.
 * User: David Indra
 * Date: 08.11.2017
 * Time: 0:13
 */

/**
 * Class representing one web article.
 */
class Article
{
    /**
     * @var int primary database key, unique identifier of article
     */
    public $id;

    /**
     * @var string headline of article
     */
    public $title;

    /**
     * @var string main content
     */
    public $content;

    /**
     * @var string article URL
     */
    public $slug;

    /**
     * @var string article perex
     */
    public $description;

    /**
     * @var article keywords
     */
    public $keyWords;
}