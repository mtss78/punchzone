<?php
require_once(__DIR__ . '/partials/head.php');
?>

<!--Hey! This is the original version
of Simple CSS Waves-->

<div class="header">

<!--Content before waves-->
<div class="inner-header flex">
<!--Just the logo.. Don't mind this-->
</div>

<!--Waves Container-->
<div>
<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
<defs>
<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
</defs>
<g class="parallax">
<use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
<use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
<use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
<use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
</g>
</svg>
</div>
<!--Waves end-->

</div>
<!--Header ends-->

<section class="contenair_article">
    <div class="title_article">
        <h1>LES DERNIÈRES NEWS </h1>
        <div class="custom_line"></div>
    </div>
    <div class="band">
    <div class="item-1">
        <a href="#" class="card">
        <div class="thumb" style="background-image: url(/public/img/pfl-abdoul.jpeg);"></div>
        <article>
            <h1>PFL – Abdoul Abdouraguimov fait son grand retour contre Staropoli</h1>
            <span>Mary Winkler</span>
        </article>
        </a>
    </div>
    <div class="item-2">
        <a href="#" class="card">
        <div class="thumb" style="background-image: url(/public/img/benoit-saint-denis-tko.jpg);"></div>
        <article>
            <h1>UFC Paris - Benoît Saint-Denis s'incline sur TKO après un arrêt du docteur</h1>
            <p>Benoît Saint Denis s'est incliné face à Renato Moicano sur TKO, lors de l'UFC Paris 3 le 28 septembre 2024. Le combattant français, trop touché aux yeux, a été arrêté par le médecin. </p>
            <span>Harry Brignull</span>
        </article>
        </a>
    </div>
    <div class="item-3">
        <a href="#" class="card">
        <div class="thumb" style="background-image: url(/public/img/ufc-paris-morgan-charriere-ko.jpg);"></div>
        <article>
            <h1>UFC Paris - Morgan Charrière claque un énorme KO sur crochet gauche</h1>
            <p> Le Pirate évoluait de nouveau devant son public à Paris. Finalement, Morgan Charrière claque un énorme KO sur un crochet. </p>
            <span>Melody Nieves</span>
        </article>
        </a>
    </div>
    <div class="item-4">
        <a href="#" class="card">
        <div class="thumb" style="background-image: url(/public/img/benoit-saint-denis-forfait.jpg);"></div>
        <article>
            <h1>UFC Paris 3 - Benoit Saint-Denis vs. Renato Moicano : tous les résultats</h1>
            <p>Devant leur public, les combattants français de l’UFC auront à cœur de briller comme les années précédentes.</p>
            <span>Kezz Bracey</span>
        </article>
        </a>
    </div>
    <div class="item-5">
        <a href="#" class="card">
        <div class="thumb" style="background-image: url(/public/img/makhachev-moicano-premier-round.jpg);"></div>
        <article>
            <h1>UFC 311 – Islam Makhachev roule sur Moicano au premier round</h1>
            <p>Événement principal d’une carte chamboulée. Finalement, Islam Makhachev roule sur Moicano au premier round.</p>
            <span>Rose</span>
        </article>
        </a>
    </div>
    <div class="item-6">
        <a href="#" class="card">
        <div class="thumb" style="background-image: url(/public/img/pereira-ankalaev-ufc-313.jpg);"></div>
        <article>
            <h1>Alex Pereira vs Magomed Ankalaev, officialisé pour l’UFC 313</h1>
            <p>Malgré les rumeurs, le choc va avoir lieu. En effet, Alex Pereira vs Magomed Ankalaev est officialisé pour l’UFC 313.</p>
            <span>Marie Gardiner</span>
        </article>
        </a>
    </div>
    <div class="item-7">
        <a href="#" class="card">
        <div class="thumb" style="background-image: url(/public//img/dana-white-bellator-pfl.jpeg);"></div>
        <article>
            <h1>L’UFC bientôt diffusé sur Netflix ? Le boss répond</h1>
            <p>Ted Sarandos, co-PDG de Netflix, a laissé place aux doutes concernant une éventuelle arrivée de l’UFC sur la plateforme.</p>
            <span>Kendra Schaefer</span>
        </article>
        </a>
    </div>
    </div>
</section>
<?php
require_once(__DIR__ . "/partials/footer.php");
?>