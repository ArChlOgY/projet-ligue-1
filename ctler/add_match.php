<?php

# Prevent direct access to this file
if(!isset($perms) AND $perms != 1) {
    header("Location: http://".$_SERVER['HTTP_HOST']."/projet-ligue-1/");
}

if(!isset($_GET["show"])) {
    # Case the club number is NOT forwarded for any reason
    header('Location: ./index.php');
}

// Get the current journee
if(isset($_GET['journee']) && !empty($_GET['journee'])){
    $currentPage = strip_tags($_GET['journee']);
}else{
    $currentPage = 1;
}

$totalMatch = countMatch($pdo);
$nbMatchPage = 10;

// Calculate quantity of pages
$nbpage = ceil($totalMatch['totalmatch'] / $nbMatchPage);
$first = ($currentPage * $nbMatchPage) - $nbMatchPage;

$clubs = getClub($pdo);
$matchs = getMatch($pdo, $first, $nbMatchPage);

?>
<section>
    <article>
        <div class="container mt-3 class-head">
            <div class="row">
                <div class="accordion accordion-flush mb-2" id="accordionRank">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span class="details-club-header">AJOUTER UN MATCH</span>
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionRank">
                            <div class="accordion-body addmatch">
                                <form method="post" action="index.php?action=addmatch&show=addmatch">
                                    <div class="container text-center">
                                        <div class="row">
                                            <div class="col-sd-12 col-md-5">
                                                <div class="text-club mb-3">
                                                    DOMICILE
                                                </div>
                                                <select required name="club-playhome" id="club-playhome">
                                                    <option value="">Choisir un club</option>
                                                <?php foreach($clubs as $club) { ?>
                                                    <option name="<?php echo $club["id_club"]?>" value="<?php echo $club["id_club"]?>"><?php echo $club["nom_club"]?></option>
                                                <?php } ?>
                                                </select>
                                                <div class="input-club mt-3">
                                                    <input required type="number" id="club-home-goal" name="club-home-goal">
                                                </div>
                                            </div>
                                            <div class="col-sd-12 col-md-2 align-self-end">
                                                <button type="submit" class="addmatch-btn"><img src="./assets/img/soccer.png" alt="" height="75px" class="spinner-ball"></button>
                                            </div>
                                            <div class="col-sd-12 col-md-5">
                                                <div class="text-ville mb-3">
                                                    EXTERIEUR
                                                </div>
                                                <select required name="club-playoutside" id="club-playoutside">
                                                    <option value="">Choisir un club</option>
                                                <?php foreach($clubs as $club) { ?>
                                                    <option name="<?php echo $club["id_club"]?>" value="<?php echo $club["id_club"]?>"><?php echo $club["nom_club"]?></option>
                                                <?php } ?>
                                                </select>
                                                <div class="input-ville mt-3">
                                                    <input required type="number" id="club-out-goal" name="club-out-goal">
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if(!empty($matchs)) { ?>
                <?php foreach($matchs as $match) { ?>
                <div class="row text-center pt-3 pb-3">
                    <?php $detailsMatchHome = detailsMatch($pdo, $match["idclub_home"], $match["id_match"]);?>
                        <div class="col-4"><img src="assets/logo/<?php echo $detailsMatchHome["id_club"].'.'.$detailsMatchHome["logo"]?>" height="60px">
                        </div>
                        <div class="col-1 align-self-center"><?php echo $detailsMatchHome["bp"]?></div>
                        <div class="col-2 align-self-center">-</div>
                    <?php $detailsMatchOut = detailsMatch($pdo, $match["idclub_out"], $match["id_match"]); ?>
                        <div class="col-1 align-self-center"><?php echo $detailsMatchOut["bp"]?></div>
                        <div class="col-4"><img src="assets/logo/<?php echo $detailsMatchOut["id_club"].'.'.$detailsMatchOut["logo"]?>" height="60px">
                        </div>
                </div>
                <?php } ?>
            <?php } ?>
            <div class="row pagination text-center mt-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?php echo ($currentPage == 1) ? "disabled" : "" ?> pe-5">
                            <a href="./?show=addmatch&journee=<?php echo $currentPage - 1 ?>" class="page-link"><i class="fa-solid fa-circle-chevron-left"></i></i></a>
                        </li>
                        <div class="pagination-text align-self-center">J-<?php echo $currentPage; ?></div>
                        <li class="page-item <?php echo ($currentPage == $nbpage) ? "disabled" : "" ?> ps-5">
                            <a href="./?show=addmatch&journee=<?php echo $currentPage + 1 ?>" class="page-link"><i class="fa-solid fa-circle-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </article>
</section>