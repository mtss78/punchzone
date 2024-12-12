<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PunchZone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/public/css/style.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark">
      <!-- Logo -->
      <a class="navbar-brand" href="/">
        <img src="/public/img/logo.pz.png" alt="Logo" width="50" height="50">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Links -->
      <div class="collapse navbar-collapse fw-bold me-3" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Article</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Classements</a>
          </li>
        </ul>
        <!-- Buttons -->
        <div class="ms-3">
          <a href="/login" class="btn btn-outline-light me-2">Connexion</a>
          <a href="/register" class="btn btn-light">Inscription</a>
        </div>
      </div>
  </nav>
                <?php
            if(isset($_SESSION['user'])){
                ?>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Article</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Classements</a>
                </li>
                <a href="#" class="btn btn-outline-light me-2">Connexion</a>
                <a href="#" class="btn btn-light">Inscription</a>

                <?php
                if($_SESSION['user']['role']== "Admin"){
                    ?>
                    
                    <?php
                }
            } else {
            ?>
                
            <?php
            }
            ?>
        </ul>
    </div>
</nav>
<div class="myBody">