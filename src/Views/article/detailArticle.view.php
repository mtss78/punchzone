<?php
require_once(__DIR__ . "/../partials/head.php");
?>


<div class="bloc-principal marge-sup">
    <?php if (!empty($article)) { ?>
        <div class="carte-info ombre-legere-alt">
            <?php if (!empty($article->getImage())) { ?>
                <img src="/public/img/<?= $article->getImage()?>" class="image-carte-detail" alt="Image de l'article">
            <?php } ?>
            <div class="contenu-carte-detail">
                <h1 class="titre-carte-detail"><?= htmlspecialchars($article->getTitre()); ?></h1>
                <p class="texte-annexe">Par <?= htmlspecialchars($article->getAuteur()); ?> | Publié le <?= htmlspecialchars($article->getDatePublication()); ?></p>
                <p class="description-carte-detail"><?=(htmlspecialchars($article->getContenu())); ?></p>

                <a href="/article" class="bouton-action bouton-retour-alt">Retour aux articles</a>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_role'] == 1) { ?>
                    <a href="/editArticle?id=<?= $article->getId(); ?>" class="bouton-action bouton-modification">Modifier</a>
                    <form action="/deleteArticle" method="POST" class="form-rapide">
                        <input type="hidden" name="id" value="<?= $article->getId(); ?>">
                        <button type="submit" class="bouton-action bouton-suppression" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <p class="texte-centre espace-haut-moyen">Article introuvable.</p>
    <?php } ?>
</div>

<div class="bloc-commentaires marge-sup">
    <h2>Commentaires</h2>

    <?php if (!empty($commentaires)) { ?>
        <?php foreach ($commentaires as $commentaire) { ?>
            <div class="commentaire">
                <p class="texte-annexe">Par <?= htmlspecialchars($commentaire->getAuteur()); ?> | Le <?= htmlspecialchars($commentaire->getDateCommentaire()); ?></p>
                <p class="contenu-commentaire"><?= nl2br(htmlspecialchars($commentaire->getContenu())); ?></p>

                <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == $commentaire->getUserId() || $_SESSION['user']['id_role'] == 1)) { ?>
                    <form action="/deleteComment" method="POST" class="form-rapide">
                        <input type="hidden" name="id" value="<?= $commentaire->getId(); ?>">
                        <button type="submit" class="bouton-action bouton-suppression" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">Supprimer</button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p class="texte-centre">Aucun commentaire pour cet article.</p>
    <?php } ?>

    <?php if (isset($_SESSION['user'])) { ?>
        <div class="ajout-commentaire">
            <h3>Ajouter un commentaire</h3>
            <form action="/article" method="POST">
                <input type="hidden" name="article_id" value="<?= $article->getId(); ?>">
                <textarea name="contenu" class="form-control" rows="4" placeholder="Votre commentaire..." required></textarea>
                <button type="submit" class="bouton-action bouton-ajout">Publier</button>
            </form>
        </div>
    <?php } else { ?>
        <p class="texte-centre">Vous devez être connecté pour commenter.</p>
    <?php } ?>
</div>


<?php
require_once(__DIR__ . "/../partials/footer.php");
?>