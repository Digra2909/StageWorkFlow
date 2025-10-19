<?php
session_start();
    
    if(!isset($_SESSION['name'])){
        header('location:../pages/connexion.php');
    }
    include('../config.php');
    config::autoload();
    $listeStage = [];
    if (isset($_POST['recherche'])) {
        $listeStage = etudiants::rechercherOffre(array($_POST['rech']));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Rechercher un Stage</title>
</head>
<body class="bg-light">
    
    <div class="d-flex min-vh-100"> 
        
        <?php include 'header.php'; ?>

        <main class="flex-grow-1 p-4">

            <div class='bg-white p-4 shadow-sm rounded mb-5 border'>
                <h4 class="text-dark fw-bold mb-3">
                    <i class="bi bi-search me-2"></i> Postuler pour un stage
                </h4>
                
                <hr class="text-secondary">
                
                <form action="#" method='POST' class='d-flex align-items-center'>
                    <input class='form-control text-dark me-2' type="text" name='rech' placeholder='Entrez une compétence (ex: PHP, SEO, Design)' required>
                    <button type="submit" name='recherche' class='btn btn-dark fw-bold flex-shrink-0'>
                        Rechercher
                    </button>
                </form>
            </div>

            <div class='p-4'>
                <h4 class="text-dark fw-bold mb-3 border-bottom pb-2">
                    LISTE DES STAGES DISPONIBLES
                </h4>
                
                <p class="text-secondary mb-4">
                    Les stages suivants apparaissent selon les compétences recherchées.
                </p>

                <?php
                    if(isset($_GET['msg'])){
                        echo' <div class="alert alert-warning text-center" role="alert">'.$_GET['msg'].'</div>';
                    }
                ?>
                
                <div class='row g-4'>
                    <form action="../pages/root.php" method='POST' class='col-12'>
                        <?php
                            if (count($listeStage) > 0) {
                                foreach($listeStage as $stage) {
                        ?>
                        <div class="card mb-3 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-dark fw-bold"><?=$stage['titre'] ?></h5>
                                
                                <p class="card-text text-secondary mt-3">
                                    <span class="fw-semibold text-dark">Description :</span><br>
                                    <?=$stage['descriptions'] ?>
                                </p>
                                
                                <p class="card-text mt-3">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i> Publié le <?=$stage['date_publication'] ?>
                                    </small>
                                </p>

                                <hr class="text-secondary">
                                
                                <input type="hidden" name='id_offre' value='<?=$stage['id'] ?>'>
                                <input type="hidden" name='id_etud' value='<?=$_SESSION['id_etud'] ?? "0" ?>'> 

                                <button type="submit" name='postuler' class='btn btn-dark fw-bold'>
                                    <i class="bi bi-briefcase-fill me-2"></i> Postuler
                                </button>
                            </div>
                        </div>
                        <?php
                            }
                        } else if (isset($_POST['recherche'])) {
                            // Message si la recherche n'a rien donné
                            echo '<div class="alert alert-info text-center" role="alert">';
                            echo 'Aucun stage trouvé pour cette compétence.';
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