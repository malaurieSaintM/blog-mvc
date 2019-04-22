<?php
require_once('../models/article.php');
$pIndex = true;
if (isset($_GET['category_id'])){
    $articles = Article($pIndex, $category =$_GET['category_id']);
}
else{
    $articles = Article($pIndex);
}
require_once('../models/category.php');
if (isset($_GET['category_id'])) $categorySelect = Category();
{
    if ($articles)
    {
        require('../views/article_list.php');
    }
    else{header('location:index.php');}
}