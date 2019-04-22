<?php
function profileUpdt(){
    $db = dbConnect();

    $queryString = 'UPDATE user SET firstname = :firstname, lastname = :lastname, email = :email, bio = :bio ';
    $queryParameters = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'email' => $_POST['email'],
        'bio' => $_POST['bio'],
        'id' => $_SESSION['user']['id']
    ];

    if (!empty($_POST['password']) AND $_POST['password'] != $_POST['password_confirm']){
        $message = 'Votre mot de passe n\'a pas été modifié !';
    }
    elseif (!empty($_POST['password']) AND $_POST['password'] = $_POST['password_confirm']){
        $queryString .= ', password = :password ';
        $queryParameters['password'] = hash('md5', $_POST['password']);
    }
    $queryString .= ' WHERE id = :id';

    $query = $db->prepare($queryString);
    $update = $query->execute($queryParameters);
    if ($update){
        $_SESSION['user']['firstname'] = $_POST['firstname'];
        $_SESSION['user']['lastname'] = $_POST['lastname'];
        $_SESSION['user']['email'] = $_POST['email'];
        $_SESSION['user']['bio'] = $_POST['bio'];
        $success = $_SESSION['user']['message'] = 'Modification réussie';
    }
    else{
        $message = "Impossible de modifier.";
    }
    return array($success, isset($message) ? $message : '');
}
function ProfileRecup(){
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM user WHERE id = ?');
    $query->execute(array($_SESSION['user']['id']));
    return $updtUser = $query->fetch();
}