<!DOCTYPE html>
<html>
<head>
    <title>Administration des utilisateurs - Mon premier blog !</title>
    <?php require '../partials/head_assets.php'; ?>
</head>
<body class="index-body">
<div class="container-fluid">
    <?php require '../partials/header.php'; ?>
    <div class="row my-3 index-content">
        <?php require '../controllers/nav.php'; ?>
        <section class="col-9">
            <header class="pb-3">
                <!-- Si $user existe, on affiche "Modifier" SINON on affiche "Ajouter" -->
                <h4>Modifier un utilisateur</h4>
            </header>
            <?php if(isset($message)):  ?>
                <div class="bg-danger text-white">
                    <?= $message; ?>
                </div>
            <?php endif; ?>
            <!-- Si $user existe, chaque champ du formulaire sera pré-remplit avec les informations de l'utilisateur -->
            <form action="user-profile.php" method="post">
                <div class="form-group">
                    <label for="firstname">Prénom :</label>
                    <input class="form-control"
                           value="<?= isset($message) ? $_POST['firstname'] : $updUser['firstname'] ?>" type="text"
                           placeholder="Prénom" name="firstname" id="firstname" />
                </div>
                <div class="form-group">
                    <label for="lastname">Nom de famille : </label>
                    <input class="form-control" value="<?= isset($message) ? $_POST['lastname']: $updUser['lastname'] ?>" type="text" placeholder="Nom de famille" name="lastname" id="lastname" />
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input class="form-control" value="<?= isset($message) ? $_POST['email'] : $updUser['email'] ?>" type="email" placeholder="Email" name="email" id="email" />
                </div>
                <div class="form-group">
                    <label for="password">Password <?= isset($updUser) ? '(uniquement si vous souhaitez modifier le mot de passe actuel)' : '';?>: </label>
                    <input class="form-control" type="password" placeholder="Mot de passe" name="password" id="password" />
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmation du mot de passe <?= isset($updUser) ? '(uniquement si vous souhaitez modifier le mot de passe actuel)' : '';?>: </label>
                    <input class="form-control" type="password" placeholder="Mot de passe" name="confirm_password" id="confirm_password" />
                </div>
                <div class="form-group">
                    <label for="bio">Biographie :</label>
                    <textarea class="form-control"
                              name="bio" id="bio" placeholder="Sa vie son oeuvre..."><?= isset($message) ? $_POST['bio'] : $updUser['bio'] ?></textarea>
                </div>
                <div class="text-right col-sm-8 offset-sm-2">

                    <input class="btn btn-success" type="submit" name="update" value="Valider" />
                </div>


            </form>
        </section>
    </div>
</div>
</body>
</html>
