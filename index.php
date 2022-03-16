<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <!-- BOOTSTRAP -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Classement Ligue</title>
        <!-- FONT AWESOME-->
        <script src="https://kit.fontawesome.com/6ebea31493.js" crossorigin="anonymous"></script>
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:wght@100&display=swap" rel="stylesheet">
        <!-- JQUERY -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- BOOTSTRAP -->
        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <!-- CSS INTERNAL -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <!-- SITE HEADER -->
        <header>
            <div class="container mt-3">
                <div class="row text-center mb-3">
                    <div class="logo-ligue">
                        <img src="https://upload.wikimedia.org/wikipedia/fr/thumb/c/ca/Logo_Ligue_1_Uber_Eats_2020.svg/langfr-1280px-Logo_Ligue_1_Uber_Eats_2020.svg.png" height="300px" alt="Ligue 1 Uber Eats">
                    </div>
                </div>
            </div>      
        </header>
        <main>
        <section>
                <div class="container mt-2 loginForm">
                    <div class="row ms-5 me-5">
                    <?php
                        if(isset($_GET["return"])) {
                            if($_GET["return"] == "error") {
                                echo '<div class="col-12 text-center error-login mt-2 mb-2 mb-3">';
                                echo "[I]nformations [I]ncorrectes";
                                echo "</div>";
                            }
                        }
                    ?>
                    </div>
                    <?php 
                        if(!isset($_GET['return']) OR $_GET["return"] == "error") {
                    ?>
                    <div class="row">
                        <div class="welcome text-center p-3">VEUILLEZ SAISIR VOS IDENTIFIANTS</div>
                        <form method="post" action="ctler/login.php">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-at"></i></span>
                            <input type="email" id="email" name="email" class="form-control" placeholder="azerty@foreach.com" aria-label="Email">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="1234" aria-label="Password">
                        </div>
                        <div class="loginBtn text-end mb-5">
                            <button type="submit" class="btn btn-success">VALIDER</button>
                        </div>
                        </form>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
            </section>
            <?php
                if(isset($_GET['return'])) {
                    if($_GET['return'] == "success") {  
            ?>
                <!-- Top Header Rank -->
                <section>
                    <article>
                        <div class="container mt-3 class-head">
                            <div class="row">
                                <div class="accordion accordion-flush mb-2" id="accordionRank">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            CLASSEMENT LIGUE 1 - FR
                                            <span class="header-date">>> mise à jour 16/03/2022</span>
                                        </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionRank">
                                            <div class="accordion-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <ul>
                                                                <li class="rank-legende-1 mb-2"><span class="bullet-text">Ligue des Champions – Phase de groupes</span></li>
                                                                <li class="rank-legende-2 mb-2"><span class="bullet-text">Ligue des Champions – Phase éliminatoire</span></li>
                                                                <li class="rank-legende-3"><span class="bullet-text">Ligue Europa – Phase de groupes</span></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-6">
                                                            <ul>
                                                                <li class="rank-legende-4 mb-2"><span class="bullet-text">Ligue Europa Conférence – éliminatoire</span></li>
                                                                <li class="rank-legende-5 mb-2"><span class="bullet-text">Barrages pour le maintien</span></li>
                                                                <li class="rank-legende-6"><span class="bullet-text">Relégation</span></li>
                                                            </ul>
                                                        </div>                                                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Header Rank -->
                            <div class="row class-top">
                                <div class="col-auto">&nbsp&nbsp</div>
                                <div class="col-1 rank-logo"></div>
                                <div class="col-2 rank-club">CLUB</div>
                                <div class="col-1 rank-matchPlay">MJ</div>
                                <div class="col-1 rank-win">G</div>
                                <div class="col-1 rank-equal">N</div>
                                <div class="col-1 rank-lost">P</div>
                                <div class="col-1 goal-for">BP</div>
                                <div class="col-1 goal-against">BC</div>
                                <div class="col-1 rank-diff">DB</div>
                                <div class="col-1">Pts</div>
                            </div>
                    <!-- Open the foreach loop PHP -->
                    <?php        
                        $clubs = [
                            ['nom' => 'psg', 'ville' => 'Paris', 'stats' => [
                                'mj' => 28,
                                'mg' => 20,
                                'mn' => 5,
                                'mp' => 3,
                                'bp' => 59,
                                'bc' => 24,
                                'db' => 35,
                                'points' => 65,
                            ] ],
                            ['nom' => 'om', 'ville' => 'Marseille', 'stats' => [
                                'mj' => 28,
                                'mg' => 14,
                                'mn' => 8,
                                'mp' => 6,
                                'bp' => 43,
                                'bc' => 26,
                                'db' => 17,
                                'points' => 50,
                            ] ],
                            ['nom' => 'nice', 'ville' => 'Nice', 'stats' => [
                                'mj' => 28,
                                'mg' => 15,
                                'mn' => 6,
                                'mp' => 7,
                                'bp' => 38,
                                'bc' => 21,
                                'db' => 17,
                                'points' => 50,
                            ] ],
                            ['nom' => 'rennes', 'ville' => 'Rennes', 'stats' => [
                                'mj' => 28,
                                'mg' => 15,
                                'mn' => 4,
                                'mp' => 9,
                                'bp' => 57,
                                'bc' => 27,
                                'db' => 30,
                                'points' => 49,
                            ] ],
                            ['nom' => 'strasbourg', 'ville' => 'Strasbourg', 'stats' => [
                                'mj' => 28,
                                'mg' => 13,
                                'mn' => 8,
                                'mp' => 7,
                                'bp' => 50,
                                'bc' => 32,
                                'db' => 18,
                                'points' => 47,
                            ] ],
                            ['nom' => 'lille', 'ville' => 'Lille', 'stats' => [
                                'mj' => 28,
                                'mg' => 11,
                                'mn' => 10,
                                'mp' => 7,
                                'bp' => 37,
                                'bc' => 35,
                                'db' => 2,
                                'points' => 43,
                            ] ],
                            ['nom' => 'nantes', 'ville' => 'Nantes', 'stats' => [
                                'mj' => 28,
                                'mg' => 12,
                                'mn' => 6,
                                'mp' => 10,
                                'bp' => 36,
                                'bc' => 30,
                                'db' => 6,
                                'points' => 42,
                            ] ],
                            ['nom' => 'monaco', 'ville' => 'Monaco', 'stats' => [
                                'mj' => 28,
                                'mg' => 11,
                                'mn' => 8,
                                'mp' => 9,
                                'bp' => 40,
                                'bc' => 30,
                                'db' => 10,
                                'points' => 41,
                            ] ],
                            ['nom' => 'lens', 'ville' => 'Lens', 'stats' => [
                                'mj' => 28,
                                'mg' => 11,
                                'mn' => 8,
                                'mp' => 9,
                                'bp' => 42,
                                'bc' => 38,
                                'db' => 4,
                                'points' => 41,
                            ] ],
                            ['nom' => 'lyon', 'ville' => 'Lyon', 'stats' => [
                                'mj' => 28,
                                'mg' => 11,
                                'mn' => 9,
                                'mp' => 8,
                                'bp' => 40,
                                'bc' => 37,
                                'db' => 3,
                                'points' => 41,
                            ] ],
                            ['nom' => 'montpellier', 'ville' => 'Montpellier', 'stats' => [
                                'mj' => 28,
                                'mg' => 11,
                                'mn' => 5,
                                'mp' => 12,
                                'bp' => 41,
                                'bc' => 40,
                                'db' => 1,
                                'points' => 38,
                            ] ],
                            ['nom' => 'reims', 'ville' => 'Reims', 'stats' => [
                                'mj' => 28,
                                'mg' => 8,
                                'mn' => 11,
                                'mp' => 9,
                                'bp' => 32,
                                'bc' => 31,
                                'db' => 1,
                                'points' => 35,
                            ] ],
                            ['nom' => 'brest', 'ville' => 'Brest', 'stats' => [
                                'mj' => 28,
                                'mg' => 9,
                                'mn' => 8,
                                'mp' => 11,
                                'bp' => 36,
                                'bc' => 42,
                                'db' => -6,
                                'points' => 35,
                            ] ],
                            ['nom' => 'angers', 'ville' => 'Angers', 'stats' => [
                                'mj' => 28,
                                'mg' => 7,
                                'mn' => 8,
                                'mp' => 13,
                                'bp' => 31,
                                'bc' => 41,
                                'db' => -10,
                                'points' => 29,
                            ] ],
                            ['nom' => 'troyes', 'ville' => 'Troyes', 'stats' => [
                                'mj' => 28,
                                'mg' => 7,
                                'mn' => 7,
                                'mp' => 14,
                                'bp' => 26,
                                'bc' => 41,
                                'db' => -15,
                                'points' => 28,
                            ] ],
                            ['nom' => 'clermont', 'ville' => 'Clermont', 'stats' => [
                                'mj' => 28,
                                'mg' => 7,
                                'mn' => 7,
                                'mp' => 14,
                                'bp' => 27,
                                'bc' => 48,
                                'db' => -21,
                                'points' => 28,
                            ] ],
                            ['nom' => 'lorient', 'ville' => 'Lorient', 'stats' => [
                                'mj' => 28,
                                'mg' => 6,
                                'mn' => 9,
                                'mp' => 13,
                                'bp' => 24,
                                'bc' => 43,
                                'db' => -19,
                                'points' => 27,
                            ] ],
                            ['nom' => 'saint-etienne', 'ville' => 'Saint-Etienne', 'stats' => [
                                'mj' => 28,
                                'mg' => 6,
                                'mn' => 8,
                                'mp' => 14,
                                'bp' => 28,
                                'bc' => 50,
                                'db' => -22,
                                'points' => 26,
                            ] ],
                            ['nom' => 'metz', 'ville' => 'Metz', 'stats' => [
                                'mj' => 28,
                                'mg' => 4,
                                'mn' => 11,
                                'mp' => 13,
                                'bp' => 25,
                                'bc' => 46,
                                'db' => -21,
                                'points' => 23,
                            ] ],
                            ['nom' => 'bordeaux', 'ville' => 'Bordeaux', 'stats' => [
                                'mj' => 28,
                                'mg' => 4,
                                'mn' => 10,
                                'mp' => 14,
                                'bp' => 38,
                                'bc' => 68,
                                'db' => -30,
                                'points' => 22,
                            ] ],
                        ];

                        # Rank Counter
                        $i = 0;

                        foreach ($clubs as $club) {
                            $i++;
                    ?>
                            <hr>
                            <div class="row classement <?php echo $club["nom"] ?>">
                                <div class="col-auto rank-position rank-highlight-<?php echo $i ?>"><?php echo $i ?></div>
                                <div class="col-1 rank-logo"><img src="assets/img/<?php echo $club["nom"] ?>.png" class="club-logo"></div>
                                <div class="col-2 rank-club"><?php echo strtoupper($club["nom"]) ?></div>
                                <div class="col-1 rank-matchPlay"><?php echo $club["stats"]["mj"] ?></div>
                                <div class="col-1 rank-win"><?php echo $club["stats"]["mg"] ?></div>
                                <div class="col-1 rank-equal"><?php echo $club["stats"]["mn"] ?></div>
                                <div class="col-1 rank-lost"><?php echo $club["stats"]["mp"] ?></div>
                                <div class="col-1 goal-for"><?php echo $club["stats"]["bp"] ?></div>
                                <div class="col-1 goal-against"><?php echo $club["stats"]["bc"] ?></div>
                                <div class="col-1 rank-diff"><?php echo $club["stats"]["db"] ?></div>
                                <div class="col-1 rank-points"><?php echo $club["stats"]["points"] ?></div>
                            </div>
                        <?php } } ?>
                        <!-- Close the foreach loop PHP -->
                        </div>
                    </article>
                <!-- Close the condition if{isset} PHP -->
                </section>
            <?php } ?>
        </main>
        <footer>
            <div class="container-fluid footer mt-3">
                <div class="row">
                    <div class="col-12 text-center">
                        <i class="fa-brands fa-html5"></i>
                        <i class="fa-brands fa-css3-alt"></i>
                        <i class="fa-brands fa-php"></i>
                        <i class="fa-brands fa-github"></i>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>