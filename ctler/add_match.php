<!-- -------------TO DO -------------------------------- -->
<!-- Voir onfocus du ballon quand on utilise la touche tab -->

<?php

if(!isset($_GET["show"])) {
    # Case the club number is NOT forwarded for any reason
    header('Location: ./index.php');
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
                            <span class="details-club-header">AJOUTER UN MATCH</span>
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionRank">
                            <div class="accordion-body addmatch">
                                <form method="post" action="index.php?action=addmatch&show=addmatch">
                                    <div class="container text-center">
                                        <div class="row">
                                            <div class="col-sd-12 col-md-5">
                                                <div class="text-club mb-3">
                                                    DOMICILE
                                                </div>
                                                <select required name="club-playhome" id="club-playhome">
                                                    <option value="">-- Choisir un club --</option>
                                                <?php foreach($clubs as $club) { ?>
                                                    <option name="<?php echo $club["id_club"]?>" value="<?php echo $club["id_club"]?>"><?php echo $club["nom_club"]?></option>
                                                <?php } ?>
                                                </select>
                                                <div class="input-club mt-3">
                                                    <input required type="number" id="club-home-goal" name="club-home-goal">
                                                </div>
                                            </div>
                                            <div class="col-sd-12 col-md-2 mt-5">
                                                <span>

                                                <button type="submit" class="addmatch-btn"><img src="./assets/img/soccer.png" alt="" height="75px" class="spinner-ball"></button>
                                                </span>
                                            </div>
                                            <div class="col-sd-12 col-md-5">
                                                <div class="text-ville mb-3">
                                                    EXTERIEUR
                                                </div>
                                                <select required name="club-playoutside" id="club-playoutside">
                                                    <option value="">-- Choisir un club --</option>
                                                <?php foreach($clubs as $club) { ?>
                                                    <option name="<?php echo $club["id_club"]?>" value="<?php echo $club["id_club"]?>"><?php echo $club["nom_club"]?></option>
                                                <?php } ?>
                                                </select>
                                                <div class="input-ville mt-3">
                                                    <input required type="number" id="club-out-goal" name="club-out-goal">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>