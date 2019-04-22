<?php
function Category(){
    $db = dbConnect();
    $queryCategory = $db->prepare('SELECT * FROM category WHERE id = ?');
    $queryCategory->execute(array($_GET['category_id']));
    return $categorySelect = $queryCategory->fetch();
}