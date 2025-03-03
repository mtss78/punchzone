<?php
require_once(__DIR__ . "/../partials/head.php");
?>

<h1>Modifier l'Article</h1>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <p style="color: green;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($myArticle->getTitre()); ?>" required>

        <label for="contenu">Contenu :</label>
        <textarea id="contenu" name="contenu" rows="5" required><?php echo htmlspecialchars($myArticle->getContenu()); ?></textarea>

        <label for="image">URL de l'image :</label>
        <input type="file" name='image' class="form-control<?php echo htmlspecialchars($myArticle->getImage()); ?>">

        <button type="submit">Mettre à jour</button>
    </form>

    <a href="/article" class="bouton bouton-retour">Retour aux articles</a>

<?php
require_once(__DIR__ . "/../partials/footer.php");
?>