<?php
require_once(__DIR__ . "/../partials/head.php");
?>

<div class="conteneur espace-haut">
    <h1 class="titre-centre">Liste des Articles</h1>

    <div class="ligne espace-haut-moyen">
        <?php if (!empty($allArticles)) { ?>
            <?php foreach ($allArticles as $article) { ?>
                <div class="colonne-moyenne-4">
                    <div class="carte marge-bas ombre-legere">
                        <?php if (!empty($article->getImage())) { ?>
                            <img src="/public/img/<?= $article->getImage()?>" class="carte-image" alt="Image de l'article">
                        <?php } ?>
                        <div class="carte-corps">
                            <h5 class="carte-titre"><?= htmlspecialchars($article->getTitre()); ?></h5>
                            <p class="carte-texte"><?= nl2br(htmlspecialchars(substr($article->getContenu(), 0, 100))) . '...'; ?></p>
                            <p class="texte-secondaire">Par <?= htmlspecialchars($article->getAuteur()); ?> | <?= htmlspecialchars($article->getDatePublication()); ?></p>
                            <a href="/detailArticle?id=<?= $article->getId(); ?>" class="bouton bouton-principal">Lire l'article</a>

                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_role'] == 1) { ?>
                                <a href="/editArticle?id=<?= $article->getId(); ?>" class="bouton bouton-avertissement">Modifier</a>
                                <form action="/deleteArticle" method="POST" class="formulaire-ligne">
                                    <input type="hidden" name="id" value="<?= $article->getId(); ?>">
                                    <button type="submit" class="bouton bouton-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p class="texte-centre espace-haut-moyen">Aucun article disponible pour le moment.</p>
        <?php } ?>
    </div>
</div>

<?php
require_once(__DIR__ . "/../partials/footer.php");
?>
