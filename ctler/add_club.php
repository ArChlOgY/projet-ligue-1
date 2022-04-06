<?php

# Prevent direct access to this file
if(!isset($perms) AND $perms != 1) {
    header("Location: http://".$_SERVER['HTTP_HOST']."/projet-ligue-1/");
}

$clubs = getClub($pdo);

?>
<section>
    <article>
        <div class="container mt-3 class-head">
            <div class="row">
                <div class="accordion accordion-flush mb-2" id="accordionRank">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span class="details-club-header">AJOUTER UN CLUB</span>
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionRank">
                            <div class="accordion-body addclub">
                                <form action="index.php?action=addclub&show=addclub" method="post" enctype="multipart/form-data">
                                    <div class="row g-0">
                                        <div class="col-md-1 me-3">
                                            <label class="label-logo submit-btn" for="form-logo">LOGO</label>
                                            <input type="file" class="form-control" id="form-logo" name="file">
                                        </div>
                                        <div class="col-md-4 me-3">
                                            <label class="sr-only" for="form-clubname">Nom Club</label>
                                            <input required type="text" class="form-control mb-2 mr-sm-2" id="form-clubname" name="form-clubname" placeholder="Nom du Club">
                                        </div>
                                        <div class="col-md-4 me-3">
                                            <label class="sr-only" for="form-city">Ville</label>
                                            <input required type="text" class="form-control" id="form-city" name="form-city" placeholder="Ville">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" name="submit" class="btn mb-2 submit-btn">ENVOYER</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($clubs)) { ?>
            <div class="container">
                <div class="row text-center">
                <?php foreach($clubs as $club) {
                    ?>
                    <div class="col-sm-6 col-md-3 mt-4 mb-4">
                        <a href="./index.php?show=modifclub&clubid=<?php echo $club["id_club"]?>"><img src="assets/logo/<?php echo $club["id_club"].'.'.$club["logo"]?>" height="75px"></a>
                        <div class="logo-text"><?php echo $club["nom_club"]?></div>
                    </div>
                <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </article>
</section>
