<?php

# AJOUTER UN CHECK POUR EVITER LE CALL DE LA PAGE EN DIRECT

if(!isset($_GET["club"]) || !isset($_GET["show"]) || !isset($_GET["rank"])) {
    # Case the club number is NOT forwarded for any reason
    header('Location: ./index.php');
}

$clubDetails = detailsClub($pdo, $_GET["club"]);

?>

<section>
    <article>
        <div class="container mt-3 class-head">
            <div class="row">
                <div class="accordion accordion-flush mb-2" id="accordionRank">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <img src="assets/logo/<?php echo $clubDetails["id_club"].'.'.$clubDetails["logo"]?>" height="50px" class="pe-2">
                            <span class="details-club-header">Resultats <?php echo $clubDetails["nom_club"] ?></span>
                            <span class="details-club-header">&nbsp;-&nbsp;<?php echo $clubDetails["point"] ?></span>
                            <span class="details-club-header">pts</span>
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionRank">
                            <div class="accordion-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-4 text-start">
                                            <div class="row pt-4">
                                                <div class="col-6 highlight-point">
                                                    <div class="details-point"><?php echo $clubDetails["point"] ?></div>
                                                    <div class="details-point-text">pts</div>
                                                </div>
                                                <div class="col-6 highlight-point">
                                                    <div class="details-point pt-5">29</div>
                                                    <div class="details-point-text">joués</div>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col-6 highlight-point">
                                                    <div class="details-point">20</div>
                                                    <div class="details-point-text">gagnés</div>
                                                </div>
                                                <div class="col-6 highlight-point">
                                                    <div class="details-point pt-5">59</div>
                                                    <div class="details-point-text">but</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                    <img src="https://photos.madeinparisiens.com/ligue-1/2022/zoom/l1-20220320140500-3337.jpg" height="75%" class="d-block w-100" alt="...">
                                                    </div>
                                                    <div class="carousel-item">
                                                    <img src="https://photos.madeinparisiens.com/ligue-1/2022/zoom/l1-20220320140442-9645.jpg" class="d-block w-100" alt="...">
                                                    </div>
                                                    <div class="carousel-item">
                                                    <img src="https://photos.madeinparisiens.com/ligue-1/2022/zoom/l1-20220320140509-3209.jpg" class="d-block w-100" alt="...">
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
        </div>
    </article>
</section>
