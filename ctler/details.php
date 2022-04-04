<?php

# AJOUTER UN CHECK POUR EVITER LE CALL DE LA PAGE EN DIRECT

if(!isset($_GET["club"]) || !isset($_GET["show"]) || !isset($_GET["rank"])) {
    # Case the club number is NOT forwarded for any reason
    header('Location: ./index.php');
}

$clubHighlight = clubHighlight($pdo, $_GET["club"]);

#var_dump($clubHighlight);
?>

<section>
    <article>
        <div class="container mt-3 class-head">
            <div class="row">
                <div class="accordion accordion-flush mb-2" id="accordionRank">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span class="details-club-header">Resultats <?php echo $clubHighlight["nom_club"] ?></span>
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionRank">
                            <div class="accordion-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-4 text-start">
                                            <div class="logo-highlight text-center mb-3"><img src="assets/logo/<?php echo $clubHighlight["id_club"].'.'.$clubHighlight["logo"]?>" height="70px" class="pe-2"></div>
                                            <hr class="ms-3 me-4">
                                            <div class="row ms-4">
                                                <div class="col-6 highlight-point">
                                                    <div class="details-point"><?php echo $clubHighlight["total_pts"] ?></div>
                                                    <div class="details-point-text">pts</div>
                                                </div>
                                                <div class="col-6 highlight-point">
                                                    <div class="details-point pt-5"><?php echo $clubHighlight["total_mj"] ?></div>
                                                    <div class="details-point-text">joués</div>
                                                </div>
                                            </div>
                                            <div class="row ms-2">
                                                <div class="col-6 highlight-point">
                                                    <div class="details-point"><?php echo $clubHighlight["mg"] ?></div>
                                                    <div class="details-point-text">gagnés</div>
                                                </div>
                                                <div class="col-6 highlight-point">
                                                    <div class="details-point pt-5"><?php echo $clubHighlight["bp"] ?></div>
                                                    <div class="details-point-text">but</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php $picture = clubPictures($clubHighlight["ville_club"]) ?>
                                                    <div class="carousel-item active">
                                                        <img src="./assets/match/<?php echo $picture[0]; ?>" height="75%" class="d-block w-100" alt="...">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="./assets/match/<?php echo $picture[1]; ?>" class="d-block w-100" alt="...">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="./assets/match/<?php echo $picture[2]; ?>" class="d-block w-100" alt="...">
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>                                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>
