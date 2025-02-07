<?php
require_once(__DIR__ . "/partials/head.php");
?>

<div class="create_article">
    <h1>Création d'un article</h1>
</div>

<form method='POST'>
    <div class="col-md-6 mx-auto d-block mt-5">
        
        <!-- Titre de l'article -->
        <div class="mb-3">
            <label for="titre">Titre de l'article</label>
            <input type="text" name='titre' class="form-control" required>
            <?php if (isset($this->arrayError['titre'])) { ?>
                <p class='text-danger'><?= $this->arrayError['titre'] ?></p>
            <?php } ?>
        </div>

        <!-- Auteur -->
        <div class="mb-3">
            <label for="auteur">Nom de l'auteur</label>
            <input type="text" name='auteur' class="form-control" required>
            <?php if (isset($this->arrayError['auteur'])) { ?>
                <p class='text-danger'><?= $this->arrayError['auteur'] ?></p>
            <?php } ?>
        </div>

        <!-- Contenu de l'article -->
        <div class="mb-3">
            <label for="contenu">Contenu de l'article</label>
            <textarea class="form-control" name="contenu" rows="5" required></textarea>
            <?php if (isset($this->arrayError['contenu'])) { ?>
                <p class='text-danger'><?= $this->arrayError['contenu'] ?></p>
            <?php } ?>
        </div>

        <!-- Date de publication -->
        <div class="mb-3">
            <label for="date_publication">Date de publication</label>
            <input type="date" name='date_publication' class="form-control" value="<?= date("Y-m-d") ?>" required>
            <?php if (isset($this->arrayError['date_publication'])) { ?>
                <p class='text-danger'><?= $this->arrayError['date_publication'] ?></p>
            <?php } ?>
        </div>

        <button type="submit" class='btn btn-success mt-3'>Créer l'article</button>
    </div>
</form>

<?php
require_once(__DIR__ . "/partials/footer.php");
?>