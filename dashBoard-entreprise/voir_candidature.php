<?php
    session_start();
    if(!isset($_SESSION['entreprise_id'])){
        header('location:../pages/connexion.php');
    }
    include('../config.php');
    config::autoload();
    $listeCandidature = entreprise::toutCandidatureValide();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="favicon.png" href="../assets/images/logo.PNG">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Gérer Candidatures</title>
</head>
<body class="bg-light"> 

    <div class="d-flex min-vh-100"> 
        
        <?php include 'header.php'; ?>
        
        <main class="flex-grow-1 p-4">
            
            <h2 class="mb-4 text-dark fw-bold border-bottom pb-2">
                <i class="bi bi-file-earmark-person me-2"></i> Gérer les candidatures
            </h2> 

            <?php
                if(isset($_GET['msg'])){
                    echo' <div class="alert alert-info text-center" role="alert">'.$_GET['msg'].'</div>';
                }
            ?>
            
            <div class="row g-4">
                
                <?php
                    // Vérifier si la liste n'est pas vide
                    if (empty($listeCandidature)) {
                        echo '<div class="col-12"><div class="alert alert-secondary text-center" role="alert">';
                        echo '<i class="bi bi-x-octagon me-2"></i> Aucune candidature validée à gérer pour le moment.';
                        echo '</div></div>';
                    }

                    foreach ($listeCandidature as $valeur) {
                ?>
                        <div class="col-md-12">
                            <div class="card shadow-sm p-3 bg-white border-0">
                                
                                <div class="card-header bg-light border-bottom mb-3">
                                    <h5 class="mb-0 text-dark">
                                        <i class="bi bi-person-badge me-2"></i> Candidature de **<?=$valeur['nom_etud'] ?>**
                                    </h5>
                                    <small class="text-secondary">Soumise le <?=$valeur['dte'] ?></small>
                                </div>
                                
                                <div class="card-body pt-0">
                                    
                                    <h6 class="text-dark mt-2 mb-3">Détails de l'Offre</h6>
                                    
                                    <ul class="list-group list-group-flush mb-4">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <p class="mb-0 fw-semibold text-dark w-50">Numéro de stage :</p>
                                            <span class="text-end text-dark"><?=$valeur['id'] ?></span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <p class="mb-0 fw-semibold text-dark w-50">Objet de l'offre :</p>
                                            <span class="text-end text-dark"><?=$valeur['objet'] ?></span>
                                        </li>
                                        <li class="list-group-item">
                                            <p class="mb-0 fw-semibold text-dark">Description :</p>
                                            <p class="small text-secondary"><?=$valeur['descriptions'] ?></p>
                                        </li>
                                    </ul>

                                    <h6 class="text-dark mt-4 mb-3">Compétences</h6>

                                    <ul class="list-group list-group-flush mb-4">
                                        <li class="list-group-item">
                                            <p class="mb-0 fw-semibold text-dark">Compétences requises :</p>
                                            <p class="small text-secondary"><?=$valeur['competences_offres'] ?></p>
                                        </li>
                                        <li class="list-group-item">
                                            <p class="mb-0 fw-semibold text-dark">Compétences de l'étudiant :</p>
                                            <p class="small text-dark"><?=$valeur['competence_etudiant'] ?></p>
                                        </li>
                                    </ul>
                                    
                                    <div class="mb-4">
                                        <a href="<?=$valeur['cv_path'] ?>" target="_blank" class="btn btn-outline-dark btn-sm">
                                            <i class="bi bi-file-earmark-arrow-down-fill me-2"></i> Télécharger le CV
                                        </a>
                                    </div>
                                    
                                    <hr class="my-4">

                                    <form action="../pages/root.php" method='POST'>
                                        <input type="text" name="idCand" value='<?=$valeur['id'] ?>' id="" class='d-none'>
                                        <div class="row g-2 mb-2">
                                            <div class="col-md-6">
                                                <button class="btn btn-success w-100 fw-bold" name="accept_candidature" value="<?= $valeur['id'] ?>" type="submit">
                                                    <i class="bi bi-check-circle me-2"></i> Accepter
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-danger w-100 fw-bold" name="refuse_candidature" value="<?= $valeur['id'] ?>" type="submit">
                                                    <i class="bi bi-x-circle me-2"></i> Refuser
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <button class="btn btn-dark w-100 fw-bold mt-2" name="schedule_entretien" value="<?= $valeur['id'] ?>" type="submit">
                                            <i class="bi bi-calendar-event me-2"></i> Assigner un encadreur
                                        </button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>
            </div>
        </main>
    </div>
</body>
</html>