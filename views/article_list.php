<!DOCTYPE html>
<html>
<head>

    <title><?php if(isset($_GET['category_id'])): ?><?=  $categorySelect['name']; ?><?php else: ?>Tous les articles<?php endif; ?> - Mon premier blog !</title>
    <?php require '../partials/head_assets.php'; ?>

</head>
<body class="article-list-body">
<div class="container-fluid">

    <?php require '../partials/header.php'; ?>

    <div class="row my-3 article-list-content">

        <?php require('../controllers/nav.php'); ?>

        <main class="col-9">
            <section class="all_aricles">
                <header>
                    <?php if(isset($_GET['category_id'])): ?>
                        <h1 class="mb-4"><?php echo $categorySelect['name']; ?></h1>
                    <?php else: ?>
                        <h1 class="mb-4">Tous les articles :</h1>
                    <?php endif; ?>
                </header>

                <?php if(isset($_GET['category_id'])): ?>
                    <div class="category-description mb-4">
                        <?php echo $categorySelect['description']; ?>
                    </div>
                <?php endif; ?>

                <!-- s'il y a des articles à afficher -->
                <?php if(count($articles) > 0): ?>
                    <?php foreach($articles as $key => $article): ?>

                        <article class="mb-4">
                            <h2><?php echo $article['title']; ?></h2>
                            <?php if( !isset($_GET['category_id'])): ?>
                            <?php endif; ?>
                            <span class="article-date">
									<!-- affichage de la date de l'article selon le format %A %e %B %Y -->
									<strong style="color:red">[ <?php echo $article['name']; ?>] </strong><?php echo strftime("%A %e %B %Y", strtotime($article['published_at'])); ?>
								</span>
                            <div class="article-content">
                                <?php echo $article['summary']; ?>
                            </div>
                            <a href="article.php?article_id=<?php echo $article['id']; ?>"> Lire l'article</a>
                        </article>
                        <?php //endif; ?>
                    <?php endforeach; ?>
                    <!-- s'il n'y a pas d'articles à afficher -->
                <?php else: ?>
                    Aucun article
                <?php endif; ?>
            </section>
        </main>

    </div>

    <?php require '../partials/footer.php'; ?>

</div>
</body>
</html>
