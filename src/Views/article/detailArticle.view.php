<?php
require_once(__DIR__ . "/../partials/head.php");
?>


<div class="conteneur espace-haut">
    <?php if (!empty($article)) { ?>
        <div class="carte-detail ombre-legere">
            <?php if (!empty($article->getImage())) { ?>
                <img src="/public/img/<?= $article->getImage()?>" class="carte-image-detail" alt="Image de l'article">
            <?php } ?>
            <div class="carte-corps-detail">
                <h1 class="carte-titre-detail"><?= htmlspecialchars($article->getTitre()); ?></h1>
                <p class="texte-secondaire">Par <?= htmlspecialchars($article->getAuteur()); ?> | Publié le <?= htmlspecialchars($article->getDatePublication()); ?></p>
                <p class="carte-texte-detail"><?= nl2br(htmlspecialchars($article->getContenu())); ?></p>

                <a href="/article" class="bouton bouton-retour">Retour aux articles</a>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_role'] == 1) { ?>
                    <a href="/editArticle?id=<?= $article->getId(); ?>" class="bouton bouton-avertissement">Modifier</a>
                    <form action="/deleteArticle" method="POST" class="formulaire-ligne">
                        <input type="hidden" name="id" value="<?= $article->getId(); ?>">
                        <button type="submit" class="bouton bouton-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <p class="texte-centre espace-haut-moyen">Article introuvable.</p>
    <?php } ?>
</div>

<!-- Vérifier si l'utilisateur est connecté -->
<?php if (isset($_SESSION['user'])) { ?>
    <div class="comment-form mt-4">
        <h4>Ajouter un commentaire</h4>
        <form action="/addComment" method="POST">
            <input type="hidden" name="article_id" value="<?= $article->getId(); ?>">
            <textarea name="contenu" class="form-control" rows="3" required></textarea>
            <button type="submit" class="btn btn-primary mt-2">Commenter</button>
        </form>
    </div>
<?php } else { ?>
    <p class="alert alert-warning">Vous devez être connecté pour commenter.</p>
<?php } ?>

<!-- Affichage des commentaires -->
<div class="comments mt-5">
    <h4>Commentaires :</h4>
    <?php if (!empty($comments)) { ?>
        <?php foreach ($comments as $comment) { ?>
            <div class="comment-box border p-3 mb-3">
                <p><strong><?= htmlspecialchars($comment['username']); ?></strong> 
                    <small class="text-muted">(<?= date("d/m/Y H:i", strtotime($comment['date_commentaire'])); ?>)</small>
                </p>
                <p><?= nl2br(htmlspecialchars($comment['contenu'])); ?></p>

                <!-- Bouton Supprimer (si l'utilisateur est l'auteur du commentaire) -->
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_user'] == $comment['id_user']) { ?>
                    <form action="/deleteComment" method="POST" class="mt-2">
                        <input type="hidden" name="comment_id" value="<?= $comment['id']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>Aucun commentaire pour le moment.</p>
    <?php } ?>
</div>


<?php
require_once(__DIR__ . "/../partials/footer.php");
?>