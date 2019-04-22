<?php
require_once('./models/article.php');
$homeArticles = Articles();
require('./views/index.php');