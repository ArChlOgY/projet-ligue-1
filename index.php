<?php 
session_start();
require './modele/db.php'; 
require './modele/functions.php'; 

if(isset($_GET["action"])) {

    switch ($_GET["action"]) {
        case 'login':
            if(isset($_POST['email'])) {
                actionLogin($pdo, $_POST['email'], $_POST['password']);
            }
            break;
        case 'logout':
            actionLogout($_GET["action"]);
            break;
        case 'addclub':
            if(!empty($_POST['form-clubname']) && !empty($_POST['form-city']) && !empty($_FILES['file'])){   
                try {
                    $addClub = actionAddclub($pdo, $_POST['form-clubname'], $_POST['form-city'], $_FILES['file'], '');
                } catch(Exception $e) {
                    $addClub = false;
                    $error = $e->getMessage();
                }
            }
            break;
        case 'addmatch':
            #var_dump($_POST);
            if(!empty($_POST['club-playhome']) && !empty($_POST['club-playoutside'])){    
                try {
                    $addmatch = addmatch($pdo, $_POST['club-playhome'], $_POST['club-home-goal'], $_POST['club-playoutside'], $_POST['club-out-goal']);
                } catch(Exception $e) {
                    $addmatch = false;
                    $error = $e->getMessage();
                }
            }
            break;
        }
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <!-- BOOTSTRAP -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Classement Ligue 1 - Uber Eats</title>
        <!-- FONT AWESOME-->
        <script src="https://kit.fontawesome.com/6ebea31493.js" crossorigin="anonymous"></script>
        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:wght@100&display=swap" rel="stylesheet">
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
                        <a href="index.php"><img src="https://upload.wikimedia.org/wikipedia/fr/thumb/c/ca/Logo_Ligue_1_Uber_Eats_2020.svg/langfr-1280px-Logo_Ligue_1_Uber_Eats_2020.svg.png" height="300px" alt="Ligue 1 Uber Eats"></a>
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
                            if(!isset($_SESSION["email"])) {
                        ?>
                        <div class="row">
                            <div class="welcome text-center p-3">VEUILLEZ SAISIR VOS IDENTIFIANTS</div>
                                <form method="post" action="index.php?action=login">
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
                </div>
        </section>
        <?php if(isset($_SESSION["email"])) { ?>
        <section>
            <div class="container menu">
                <div class="row justify-content-center mb-4 mt-4">
                        <div class="col-4 col-sm-1 menu-btn me-2"><a href="./index.php?show=addmatch">MATCH +</a></div>
                        <div class="col-4 col-sm-1 menu-btn me-2"><a href="./index.php?show=addclub">CLUB +</a></div>
                        <div class="col-4 col-sm-1 menu-btn"><a href="./index.php?action=logout">A+</a></div>
                </div>
            </div>
                <?php

                #$addClub = false;
                
                if(isset($addClub) || isset($addmatch) ) { ?>
            <div class="container error-message pt-3">
                <div class="row">
                    <div class="col-12">
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </symbol>
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </symbol>
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </symbol>
                        </svg>
                        <?php if(isset($addClub) && $addClub === true || isset($addmatch) && $addmatch === true) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                            <span class=text-success> Ajouté avec succès !</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php } else { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Error:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                <span class=text-fail> <?php print $error;?></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php } ?>

                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
        <?php
        if(isset($_GET["show"])) {
            switch ($_GET["show"]) {
                case 'details':
                    require('./ctler/details.php');
                    break;
                case 'addclub':
                    require('./ctler/add_club.php');
                    break;
                case 'addmatch':
                    require('./ctler/add_match.php');
                    break;
                }
            } else {
                require('./ctler/main.php');
            }
        ?>
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