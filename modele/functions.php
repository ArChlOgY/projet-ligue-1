<?php

function getClub($pdo) {

    # Create SQL request to get all clubs
    $requete = "SELECT * FROM club ORDER BY nom_club ASC;";
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    $clubs = $stmt->fetchAll();

    return $clubs;
}

function getClubInfo($pdo, $idclub) {

    # Create SQL request to get club information
    $requete = "SELECT * FROM club WHERE id_club = :idclub";
    $stmt = $pdo->prepare($requete);
    $stmt->execute([':idclub' => $idclub]);
    $clubInfo = $stmt->fetch();
    
    return $clubInfo;  
}

function actionModifyClub($pdo, $clubname, $clubcity, $file, $clubid) {

    // Clen the clubname & clubcity inputs as we want only letters
    $clubcity = preg_replace('/[^\s\p{L}]/u', '', $clubcity);
    $clubname = preg_replace('/[^\s\p{L}]/u', '', $clubname);
    // After cleaning , check if there is still some letters in case user only typed number and special chars
    if (empty($clubcity) or empty($clubname)) {
        throw new Exception('Le nom du club/ville doit comporter uniquement des lettres');
    }

    // Check file exist -> note that file can be empty if the size is over MAXPOST php.ini 
    if (empty($file["size"])) {

        $requete = "UPDATE club SET nom_club = :clubname, ville_club = :clubcity WHERE id_club = :idclub";
        $stmt = $pdo->prepare($requete);
        $clubModify = $stmt->execute([
            ':clubname' => $clubname,
            ':clubcity' => $clubcity,
            ':idclub' => $clubid
        ]);
 
    } else { 

        # Check file size
        if ($file["size"] > 1000000) { 
            throw new Exception('Fichier trop volumineux - 1Mo max');
        }

        // Check file type (only jpg/png.jpeg)
        $imageFileType = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            throw new Exception("Le fichier n'est pas une image (jpg/png/jpeg)");
        }  

        // Rename the logo file with the club id to avoid duplicate file
        $newfilename = $clubid . '.' . strtolower($clubname. '.' .$imageFileType);

        // Move the file to target dir
        if (!move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/logo/" . $newfilename)) {
            throw new Exception("Le fichier chargé n'a pas pu être déplacé");
        }

        $requete = "UPDATE club SET nom_club = :clubname, logo = :logo, ville_club = :clubcity WHERE id_club = :idclub";
        $stmt = $pdo->prepare($requete);
        $clubModify = $stmt->execute([
            ':clubname' => $clubname,
            ':logo' => strtolower($clubname. '.' .$imageFileType),
            ':clubcity' => $clubcity,
            ':idclub' => $clubid
        ]);
    }

    return $clubModify;
}

function actionDelclub($pdo, $clubid) {

    $requete = "DELETE FROM club  WHERE id_club = :idclub";
    $stmt = $pdo->prepare($requete);
    $clubModify = $stmt->execute([':idclub' => $clubid]);

    // Handle error message from SQL server (eg : foreign key constraint)
    $error = $stmt->errorInfo();
    if($error[0] != 0)
        throw new Exception($error[2]);

    return $clubModify;

}

function getClassement($pdo, $search) {

    # Create SQL request to get overall ranking
    $requete = "SELECT c.id_club, nom_club, logo, SUM(IFNULL(mj, 0)) total_mj, SUM(IFNULL(mg, 0)) mg , SUM(IFNULL(mn, 0)) mn, SUM(IFNULL(mp, 0)) mp, SUM(IFNULL(bp, 0)) bp, SUM(IFNULL(bc, 0)) bc, SUM(IFNULL(dp, 0)) db, SUM(IFNULL(mg*3, 0)) + SUM(IFNULL(mn*1, 0)) total_pts 
    FROM `club` c LEFT JOIN stats s ON c.id_club = s.id_club WHERE 1=1";
    if(!empty($search))
    {
        $requete .=  " AND nom_club LIKE '%".$search."%'";
        $requete .=  " OR ville_club LIKE '%".$search."%'";
    }
    $requete .=  " GROUP BY c.id_club ORDER BY total_pts DESC, mj DESC, db DESC;";
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    $clubres = $stmt->fetchAll();

    return $clubres;
}

function clubHighlight($pdo, $idclub) {

    # Create SQL request to get specific club highlight results
    $requete = "SELECT c.id_club, nom_club, logo, ville_club, SUM(IFNULL(mj, 0)) total_mj, SUM(IFNULL(mg, 0)) mg, SUM(IFNULL(mg*3, 0)) + SUM(IFNULL(mn*1, 0)) total_pts, SUM(IFNULL(bp, 0)) bp 
    FROM club C 
    LEFT JOIN stats S ON C.id_club = S.id_club 
    WHERE C.id_club = :idclub";
    $stmt = $pdo->prepare($requete);
    $stmt->execute([':idclub' => $idclub]);
    $clubHighlight = $stmt->fetch();
    
    return $clubHighlight;  
}

function clubPictures($clubville) {

    $clubville = strtolower($clubville);
    $images = preg_grep('/\b(\w*'.preg_quote($clubville).'\w*)\b/', scandir("./assets/match/"));
    if(!$images){
        #$images = ['01.monaco_psg.jpg', '01.monaco_psg.jpg', '01.monaco_psg.jpg'];
        $clubville = 'defaut';
        $images = preg_grep('/\b(\w*'.preg_quote($clubville).'\w*)\b/', scandir("./assets/match/"));
    }

    shuffle($images);

    return $images;
}

function actionAddclub($pdo, $clubname, $clubcity, $file) {

    # add a control check if club already exists....but would be better in AJAX :)

    // Clen the clubname & clubcity inputs as we want only letters
    $clubcity = preg_replace('/[^\s\p{L}]/u', '', $clubcity);
    $clubname = preg_replace('/[^\s\p{L}]/u', '', $clubname);
    // After cleaning , check if there is still some letters in case user only typed number and special chars
    if (empty($clubcity) or empty($clubname)) {
        throw new Exception('Le nom du club/ville doit comporter uniquement des lettres');
    }

    // Check file exist -> note that file can be empty if the size is over MAXPOST php.ini 
    if (empty($file["size"])) {
        throw new Exception('Vous devez ajouter un logo (jpg/png/jpeg - 1Mo max)');
    // Then the image size        
    } elseif ($file["size"] > 1000000) { 
        throw new Exception('Fichier trop volumineux - 1Mo max');
    }

    // Check file type (only jpg/png.jpeg)
    $imageFileType = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        throw new Exception("Le fichier n'est pas une image (jpg/png/jpeg)");
    }  
    
    // Insert new club in db
    $requete = "INSERT INTO club (nom_club, logo, ville_club) VALUES (:clubname, :logo, :clubcity);";
    $stmt = $pdo->prepare($requete);
    $addClub = $stmt->execute([':clubname' => $clubname, ':logo' => strtolower($clubname. '.' .$imageFileType), ':clubcity' => $clubcity ]);
    $club_id = $pdo->lastInsertId();

    // Rename the logo file with the club id to avoid duplicate file
    $newfilename = $club_id . '.' . strtolower($clubname. '.' .$imageFileType);

    // Move the file to target dir
    if (!move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/logo/" . $newfilename)) {
         throw new Exception("Le fichier chargé n'a pas pu être déplacé");
    }

    return $addClub;
}

function addmatch($pdo, $clubid_home, $goal_home, $clubid_out, $goal_out) {

    # Check values are passed correctly
    if(!isset($clubid_home) || !isset($goal_home) || !isset($clubid_out) || !isset($goal_out) ){
        throw new Exception("Les informations saisies sont incomplètes");
    }

    # Ensure the goals is 0 or any positive number
    if($goal_home < 0 || $goal_out < 0){
        throw new Exception("Le nombre de but ne peut pas être inférieur à zéro");
    }

    # Same club , same match !? Nop
    if($clubid_home == $clubid_out){
        throw new Exception("Un club ne peut pas se recontrer lui même...");
    }

    # Is the match already played ?
    $requete = "SELECT id_match FROM matchs WHERE idclub_home = :idclub_home AND idclub_out = :idclub_out";
    $stmt = $pdo->prepare($requete);
    $stmt->execute([':idclub_home' => $clubid_home, ':idclub_out' => $clubid_out]);
    $clubDetails = $stmt->fetch();
    if($clubDetails){
        throw new Exception("Ce match a déjà été joué -> match_id ". $clubDetails["id_match"]);
    }

    # Save the match for later use...?
    $requete = "INSERT INTO matchs (idclub_home, idclub_out) VALUES (:idclub_home, :idclub_out);";
    $stmt = $pdo->prepare($requete);
    $addmatch = $stmt->execute([':idclub_home' => $clubid_home, ':idclub_out' => $clubid_out ]);
    $match_id = $pdo->lastInsertId();
    if(!$addmatch){
        throw new Exception("Le match n'a pas pu être ajouté à la db, vérifier la requete SQL");
    }

    # First insert for the club that played at home
    if($clubid_home) {

        $mj = 1;
        $bp = $goal_home;
        $bc = $goal_out;
        $dp = $goal_home - $goal_out;

        if ($goal_home > $goal_out) {
            $mg = 1;
            $mn = 0;
            $mp = 0;
            $points = 3;
        } elseif ($goal_home == $goal_out) {
            $mg = 0;
            $mn = 1;
            $mp = 0;
            $points = 1;
        } else {
            $mg = 0;
            $mn = 0;
            $mp = 1;
            $points = 0;
        }

        $requete = "INSERT INTO stats (mj, mg, mn, mp, bp, bc, dp, points, id_club, id_match) VALUES (:mj, :mg, :mn, :mp, :bp, :bc, :dp, :points, :id_club, :id_match);";
        $stmt = $pdo->prepare($requete);
        $addstats = $stmt->execute([
        ':mj'          => $mj,
        ':mg'          => $mg,
        ':mn'          => $mn,
        ':mp'          => $mp,
        ':bp'          => $bp,
        ':bc'          => $bc,
        ':dp'          => $dp,
        ':points'      => $points,
        ':id_club'     => $clubid_home,
        ':id_match'    => $match_id
        ]);
    }
    if(!$addstats){
        throw new Exception("Les stats du match domicile n'ont pas été ajouté , vérifier la requete SQL");
    }

    # Second insert for the club that played outside
    if($clubid_out) {

        $mj = 1;
        $bp = $goal_out;
        $bc = $goal_home;
        $dp = $goal_out - $goal_home;

        if ($goal_out > $goal_home) {
            $mg = 1;
            $mn = 0;
            $mp = 0;
            $points = 3;
        } elseif ($goal_out == $goal_home) {
            $mg = 0;
            $mn = 1;
            $mp = 0;
            $points = 1;
        } else {
            $mg = 0;
            $mn = 0;
            $mp = 1;
            $points = 0;
        }

        $requete = "INSERT INTO stats (mj, mg, mn, mp, bp, bc, dp, points, id_club, id_match) VALUES (:mj, :mg, :mn, :mp, :bp, :bc, :dp, :points, :id_club, :id_match);";
        $stmt = $pdo->prepare($requete);
        $addstats = $stmt->execute([
        ':mj'          => $mj,
        ':mg'          => $mg,
        ':mn'          => $mn,
        ':mp'          => $mp,
        ':bp'          => $bp,
        ':bc'          => $bc,
        ':dp'          => $dp,
        ':points'      => $points,
        ':id_club'     => $clubid_out,
        ':id_match'    => $match_id
        ]);
    }
    if(!$addstats){
        throw new Exception("Les stats du match extérieur n'ont pas été ajouté , vérifier la requete SQL");
    }

    return $addmatch;
}

function actionLogin($pdo, $email, $pass) {
    
    if (!empty($email) && !empty($pass)) {

        // Get user information fromm db
        $rqs = "SELECT email, mdp, nom_user, prenom_user FROM user WHERE email = '$email' ";
        $stmt = $pdo->prepare($rqs);
        $stmt->execute();
        $user = $stmt->fetch();
    
        if(($user) && password_verify($pass, $user["mdp"])) {
    
            // Password confirmed, create the user session
            $_SESSION["nom"] = $user["nom_user"];
            $_SESSION["prenom"] = $user["prenom_user"];
            $_SESSION["email"] = $user["email"];
    
            header("Location:./index.php");
    
        } else {
            header("Location:./index.php?return=error");
        }
    
    }else{
        header("Location:./index.php");
    } 
}

function getMatch($pdo) {

    #Create SQL request to db to get all matchas
    $requete = "SELECT * FROM matchs ORDER BY id_match ASC;";
    $stmt = $pdo->prepare($requete);
    $stmt->execute();
    $matchs = $stmt->fetchAll();

    return $matchs;
}

function detailsMatch($pdo, $idclub, $idmatch) {

    $requete = "SELECT * FROM club C JOIN stats S ON C.id_club = S.id_club WHERE S.id_club = :id_club AND S.id_match = :id_match;";
    $stmt = $pdo->prepare($requete);
    $stmt->execute([':id_club' => $idclub, ':id_match' => $idmatch]);
    $detailsMatch = $stmt->fetch();
    
    return $detailsMatch;  
}

function actionLogout() {
    
    session_destroy();
    header('Location: ./index.php');
}

?>