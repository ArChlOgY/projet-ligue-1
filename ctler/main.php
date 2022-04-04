<?php

# AJOUTER UN CHECK POUR EVITER LE CALL DE LA PAGE EN DIRECT

$clubres = getClassement($pdo);
   
?>
<section>
    <article>
        <div class="container mt-3 class-head">
            <div class="row">
                <div class="accordion accordion-flush mb-2" id="accordionRank">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span class="accordion-head-shorttext">LIGUE 1 - FR</span>
                            <span class="accordion-head-longtext">CLASSEMENT LIGUE 1 - FR</span>
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionRank">
                            <div class="accordion-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <ul>
                                                <li class="rank-legende-1 mb-2"><span class="bullet-text">Ligue des Champions – Phase de groupes</span></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <ul>
                                                <li class="rank-legende-2 mb-2"><span class="bullet-text">Ligue des Champions – Phase éliminatoire</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <ul>
                                                <li class="rank-legende-3"><span class="bullet-text">Ligue Europa – Phase de groupes</span></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <ul>
                                                <li class="rank-legende-4 mb-2"><span class="bullet-text">Ligue Europa Conférence – éliminatoire</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <ul>
                                                <li class="rank-legende-5 mb-2"><span class="bullet-text">Barrages pour le maintien</span></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <ul>
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
                <div class="col-1 rank-points">Pts</div>
            </div>
            <?php
                $rank = 0;
                foreach($clubres as $team) {
                    $rank ++;            ?>
            <hr>
            <a href="./index.php?club=<?php echo $team["id_club"]?>&rank=<?php echo $rank?>&show=details">
                <div class="row classement ">
                    <div class="col-1 rank-position rank-highlight-<?php echo $rank ?>"><?php echo $rank ?></div>
                    <div class="col-1 rank-logo text-center"><img src="assets/logo/<?php echo $team["id_club"].'.'.$team["logo"]?>" class="club-logo"></div>
                    <div class="col-2 rank-club"><?php echo $team["nom_club"] ?></div>
                    <div class="col-1 rank-matchPlay"><?php echo $team["total_mj"] ?></div>
                    <div class="col-1 rank-win"><?php echo $team["mg"] ?></div>
                    <div class="col-1 rank-equal"><?php echo $team["mn"] ?></div>
                    <div class="col-1 rank-lost"><?php echo $team["mp"] ?></div>
                    <div class="col-1 goal-for"><?php echo $team["bp"] ?></div>
                    <div class="col-1 goal-against"><?php echo $team["bc"] ?></div>
                    <div class="col-1 rank-diff"><?php echo $team["db"] ?></div>
                    <div class="col-1 rank-points"><?php echo $team["total_pts"] ?></div>
                </div>
            </a>

            <?php } ?>
        </div>
    </article>
<!-- Close the condition if{isset} PHP -->
</section>
