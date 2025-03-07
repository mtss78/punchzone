<?php
require_once(__DIR__ . "/../partials/head.php");
?>

<div class="create_article">
    <h1>Contactez-nous</h1>
</div>

<form method='POST' enctype="multipart/form-data">
    <div class="col-md-6 mx-auto d-block mt-5">

        <!-- Auteur -->
        <div class="mb-3">
            <label for="auteur">Nom</label>
            <input type="text" name='auteur' class="form-control" required>
        </div>

        <!-- email -->
        <div class="mb-3">
            <label for="mail">Email</label>
            <input type="email" name='mail'>
        </div>

        <!-- Contenu du message -->
        <div class="mb-3">
            <label for="contenu">Contenu du message</label>
            <textarea class="form-control" name="contenu" rows="5" required></textarea>
        </div>

        

        <button type="submit" class='btn btn-success mt-3'>Envoyer votre message</button>
    </div>
</form>
<?php
require_once(__DIR__ . "/../partials/footer.php");
?>
