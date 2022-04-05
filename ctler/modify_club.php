<?php

if(!isset($_GET["show"]) && !isset($_GET["clubid"])) {
    # Case the club number is NOT forwarded for any reason
    header('Location: ./index.php');
}

$clubInfo = getClubInfo($pdo, $_GET["clubid"]);

?>

<section>
    <article>
        <div class="container mt-3 class-head">
            <div class="row">
                <div class="accordion accordion-flush mb-2" id="accordionRank">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span class="details-club-header">MODIFIER CLUB - <?php echo $clubInfo["nom_club"]?></span>
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionRank">
                            <div class="accordion-body addclub">
                                <form action="index.php?action=modifclub&show=addclub" method="post" enctype="multipart/form-data">
                                    <div class="row g-0">
                                        <input type="hidden" class="form-control" id="form-clubid" name="form-clubid" value="<?php echo $clubInfo["id_club"]?>">
                                        <div class="col-md-1 me-3">
                                            <label class="label-logo submit-btn" for="form-logo">LOGO</label>
                                            <input type="file" class="form-control" id="form-logo" name="file">
                                        </div>
                                        <div class="col-md-4 me-3">
                                            <label class="sr-only" for="form-clubname">Nom Club</label>
                                            <input required type="text" class="form-control mb-2 mr-sm-2" id="form-clubname" name="form-clubname" value="<?php echo $clubInfo["nom_club"]?>">
                                        </div>
                                        <div class="col-md-4 me-3">
                                            <label class="sr-only" for="form-city">Ville</label>
                                            <input required type="text" class="form-control" id="form-city" name="form-city" value="<?php echo $clubInfo["ville_club"]?>">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" name="submit" class="btn mb-2 submit-btn">MODIFIER</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($clubInfo)) { ?>
            <div class="container">
                <div class="row text-center pb-3">
                    <div class="col-12"><img src="assets/logo/<?php echo $clubInfo["id_club"].'.'.$clubInfo["logo"]?>" height="70px"></div>
                    <div class="logo-text"><?php echo $clubInfo["nom_club"]?></div>
                    <div class="club-delete mt-3">
                        <span class="menu-btn"><a href="./index.php?show=addclub&action=delclub&clubid=<?php echo $clubInfo["id_club"]?>">Supprimer</a></span>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </article>
</section>
