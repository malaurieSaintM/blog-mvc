<?php
function login(){
    $db = dbConnect();
    if(empty($_POST['email']) OR empty($_POST['password'])){
        $loginMessage = "Merci de remplir tous les champs";
    }
    else{
        //on cherche un utilisateur correspondant au couple email / password renseigné
        $query = $db->prepare('SELECT *
							FROM user
							WHERE email = ? AND password = ?');
        $query->execute( array( $_POST['email'], hash('md5', $_POST['password']), ) );
        $user = $query->fetch();

        //si un utilisateur correspond
        if($user){
            //on prend en session ses droits d'administration pour vérifier s'il a la permission d'accès au back-office
            $_SESSION['user']['is_admin'] = $user['is_admin'];
            $_SESSION['user']['firstname'] = $user['firstname'];
        }
        else{ //si pas d'utilisateur correspondant on génère un message pour l'afficher plus bas
            $loginMessage = "Mauvais identifiants";
        }
    }
    return $loginMessage;
}

function register()
{
    $db = dbConnect();


    //en premier lieu, vérifier que l'adresse email renseignée n'est pas déjà utilisée
    $query = $db->prepare('SELECT email FROM user WHERE email = ?');
    $query->execute(array($_POST['email']));

    //$userAlreadyExists vaudra false si l'email n'a pas été trouvé, ou un tableau contenant le résultat dans le cas contraire
    $userAlreadyExists = $query->fetch();

    //on teste donc $userAlreadyExists. Si différent de false, l'adresse a été trouvée en base de données
    if ($userAlreadyExists) {
        $registerMessage = "Adresse email déjà enregistrée";
    } elseif (empty($_POST['firstname']) OR empty($_POST['password']) OR empty($_POST['email'])) {
        //ici on test si les champs obligatoires ont été remplis
        $registerMessage = "Merci de remplir tous les champs obligatoires (*)";
    } elseif ($_POST['password'] != $_POST['password_confirm']) {
        //ici on teste si les mots de passe renseignés sont identiques
        $registerMessage = "Les mots de passe ne sont pas identiques";
    } else {

        //si tout les tests ci-dessus sont passés avec succès, on peut enregistrer l'utilisateur
        //le champ is_admin étant par défaut à 0 dans la base de données, inutile de le renseigner dans la requête
        $query = $db->prepare('INSERT INTO user (firstname,lastname,email,password,bio) VALUES (?, ?, ?, ?, ?)');
        $newUser = $query->execute([
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['email'],
            hash('md5', $_POST['password']),
            $_POST['bio']
        ]);
//une fois l'utilisateur enregistré, on le connecte en créant sa session
        $_SESSION['user']['is_admin'] = 0; //PAS ADMIN !
        $_SESSION['user']['firstname'] = $_POST['firstname'];

    }
    return $registerMessage;
}