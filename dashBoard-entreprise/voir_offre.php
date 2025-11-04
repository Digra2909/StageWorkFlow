<?php
    session_start();

    if(!isset($_SESSION['entreprise_id'])){
        header('location:../pages/connexion.php');
    }
    include('../config.php');
    config::autoload();
    $listeOffre = entreprise::voir_offre($_SESSION['entreprise_id']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="favicon.png" href="../assets/images/logo.PNG">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Mes Offres</title>
</head>
<body class="bg-light"> 

    <div class="d-flex min-vh-100"> 
        
        <?php include 'header.php'; ?>
        
        <main class="flex-grow-1 p-4">
            
            <h2 class="mb-4 text-dark fw-bold border-bottom pb-2">
                <i class="bi bi-briefcase-fill me-2"></i> Mes Offres de Stage Publiées
            </h2> 

            
            <div class="row g-4">
                
                <?php
                    // Vérifier si la liste n'est pas vide
                    if (empty($listeOffre)) {
                        echo '<div class="col-12"><div class="alert alert-secondary text-center" role="alert">';
                        echo '<i class="bi bi-x-octagon me-2"></i> Vous n\'avez publié aucune offre pour le moment.';
                        echo '</div></div>';
                    }

                    foreach ($listeOffre as $valeur) {
                        // Détermine la classe du badge Bootstrap en fonction du statut
                        $statut_classe = match ($valeur['statut']) {
                            'validé' => 'bg-success',
                            'en attente' => 'bg-warning text-dark',
                            'refusé' => 'bg-danger',
                            default => 'bg-secondary',
                        };
                        
                        // tronquer la valeur de la description
                        $description_courte = strlen($valeur['descriptions']) > 100 ? substr($valeur['descriptions'], 0, 100) . '...' : $valeur['descriptions'];
                ?>
                        <div class="col-md-6 col-lg-4"> <div class="card shadow-sm h-100 bg-white border-0">
                                
                                <div class="card-header border-bottom bg-white d-flex justify-content-between align-items-start">
                                    <h5 class="mb-0 text-dark fw-bold me-2">
                                        <?=$valeur['titre'] ?>
                                    </h5>
                                    <span class="badge <?=$statut_classe?> rounded-pill">
                                        <?=$valeur['statut'] ?>
                                    </span>
                                </div>
                                
                                <div class="card-body d-flex flex-column">
                                    
                                    <p class="mb-2">
                                        <small class="text-secondary">
                                            <i class="bi bi-calendar me-1"></i> Publiée le **<?=$valeur['date_publication'] ?>**
                                        </small>
                                    </p>
                                    
                                    <ul class="list-group list-group-flush mb-3 flex-grow-1">
                                        <li class="list-group-item px-0">
                                            <p class="mb-0 fw-semibold text-dark">
                                                <i class="bi bi-card-list me-1"></i> Description :
                                            </p>
                                            <p class="small text-secondary mt-1">
                                                <?=$valeur['descriptions'] ?>
                                            </p>
                                        </li>
                                    </ul>
                                    
                                    <div class="mt-auto pt-3 border-top">

                                    </div>
                                    
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