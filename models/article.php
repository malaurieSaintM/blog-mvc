<?php
function Articles($pIndex = false, $category = false){
    $db = dbConnect();
    if ($category){
        $queryString = 'SELECT a.* , c.name as category_name, c.id as category_id
			FROM article a JOIN article_category ac
			ON a.id = ac.article_id
			 JOIN category c 
			 ON ac.category_id = c.id';
    }
    else{
        $queryString = 'SELECT a.*, GROUP_CONCAT(c.name) as category_name
        FROM article.a JOIN article_category ac 
        ON a.id = ac.article_category ac
        JOIN category c 
        ON ac.category_id = c.id';
    }
    $queryParameters = [];
    if ($category){
        $queryString .= ' WHERE ac.category_id = ? AND a.published_at <= NOW() AND a.is_published = 1 ORDER BY a.published_at DESC';
    }
    else{
        $queryString .= ' WHERE a.published_at <= NOW() AND a.is_published = 1 GROUP BY a.id DESC';
    }
    if (!$pIndex){
        $queryString .= ' LIMIT 3';
    }
    $homeArticle = $db->prepare($queryString);
    $homeArticle->execute($queryParameters);
}

function Article($articleId){
    $db = dbConnect();
    $query = $db->prepare('SELECT a.* , GROUP_CONCAT(c.name) as category_name
    FROM article a JOIN article_category ac
    ON a.id = ac.article_id
    JOIN category c
    ON ac.category_id = c.id
    WHERE published_at <= NOW() AND is_published = 1 AND a.id = ? ');

    $query->execute(array($articleId));
    return $article = $query->fetch();

}