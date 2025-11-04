<?php
    session_start();
    
    if(!isset($_SESSION['name'])){
        header('location:../pages/connexion.php');
    }
    include('../config.php');
    config::autoload();
    $listeCandidatures = [];
    $listeCandidatures = etudiants::voir_etat_candidatures(array($_SESSION['id_etud']));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="favicon.png" href="../assets/images/logo.PNG">   
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Rechercher un Stage</title>
</head>
<body class="bg-light">
    
    <div class="d-flex min-vh-100"> 
        
        <?php include 'header.php'; ?>

        <main class="flex-grow-1 p-4">

            <div class='p-4'>
                <h4 class="text-dark fw-bold mb-3 border-bottom pb-2">
                    ETATS DE MES CANDIDTURES
                </h4>
                
                <p class="text-secondary mb-4">
                    voici un tableau qui reprend toutes vos candidatures dans la plateforme ainsi que leurs états
                </p>
                
                <div class='row g-4'>
                    <form action="../pages/root.php" method='POST' class='col-12'>
                        <?php

                            if(isset($_GET['msg'])) {
                                echo '<div class="alert alert-danger text-center" role="alert">';
                                echo $_GET['msg'];
                                echo '</div>';
                            }

                            if (count($listeCandidatures) > 0) {
                                foreach($listeCandidatures as $candidature) {
                        ?>
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-dark fw-bold"><?=$candidature['titre_offre'] ?></h5>
                                
                                <p class="card-text text-secondary mt-3">
                                    <span class="fw-semibold text-dark">Statut :</span><br>
                                    <?=$candidature['candStat'] ?>
                                </p>
                                
                                <p class="card-text mt-3">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>Candidature Numéro <?=$candidature['idCand'] ?>
                                    </small>
                                </p>
                                <form action="../pages/root.php" method='POST'>
                                     <div class="col-md-4">
                                        <input type="text" class='d-none' name='candidature' value='<?php echo $candidature['idCand']  ?>'>
                                        <button class="btn btn-danger w-100 fw-bold" name="annuler_candidature" type="submit">
                                            <i class="bi bi-x-circle me-2"></i> Annuler la candidature
                                        </button>
                                    </div>
                                </form>

                                <hr class="text-secondary">
                                
                            </div>
                        </div>
                        <?php
                            }
                        } else  {
                            // Message si la recherche n'a rien donné
                            echo '<div class="alert alert-dark text-center" role="alert">';
                            echo 'Aucune candidature trouvée';
                            echo '</div>';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>