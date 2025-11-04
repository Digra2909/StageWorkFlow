<?php
    session_start();
    if(!isset($_SESSION['idTuteur'])){
        header('location:../pages/connexion.php');
    }
    include('../config.php');
    config::autoload();
    $listeStagiaire = entreprise::recupereStage($_SESSION['idTuteur']);
    // var_dump($listeStagiaire);exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="favicon.png" href="../assets/images/logo.PNG">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Évaluation Stagiaire</title>
</head>
<body class="bg-light"> 
    
    <div class="d-flex align-items-center justify-content-center min-vh-100 p-4">
    
        <section class="container">
            <div class="row justify-content-center">
                
                <div class="col-md-10 col-lg-8">
                    
                    <h2 class="text-center mb-5 text-dark fw-bold border-bottom pb-2">
                        <i class="bi bi-ui-checks-grid me-2"></i> ÉVALUATION DES STAGIAIRES
                    </h2>
                    
                    <p class="text-center text-secondary mb-4">
                        Bienvenue Tuteur. Veuillez sélectionner un stagiaire ci-dessous pour démarrer son évaluation.
                    </p>
                    
                    <div class="row g-4 justify-content-center">
                        
                        <?php
                            if (empty($listeStagiaire)) {
                                echo '<div class="col-12"><div class="alert alert-info text-center shadow-sm" role="alert">';
                                echo '<i class="bi bi-info-circle me-2"></i> Aucun stagiaire ne vous est assigné pour le moment.';
                                echo '</div></div>';
                            }
                            
                            foreach ($listeStagiaire as $val) {
                                // Détermine la classe du badge du statut
                                $statut_classe = match ($val['statut_stg'] ?? '') {
                                    'en cours' => 'bg-info text-dark',
                                    'terminé' => 'bg-success',
                                    'évalué' => 'bg-success', // Statut évalué
                                    'en attente' => 'bg-warning text-dark',
                                    default => 'bg-secondary',
                                };

                                // Détermine la classe de la bordure de la carte
                                $card_border_classe = ($val['statut_stg'] === 'évalué') ? 'border border-3 border-success' : 'border-0';
                        ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <form action="cotation.php" method="POST" class="h-100">
                                <div class="card shadow-lg p-4 text-center bg-white h-100 d-flex flex-column <?php echo $card_border_classe ?>">
                                    
                                    <div class="mb-3">
                                        
                                        <div class="mb-2">
                                            <span class="badge <?php echo $statut_classe ?> rounded-pill fw-semibold">
                                                <?php echo $val['statut_stg'] ?>
                                            </span>
                                        </div>
                                        
                                        <i class="bi bi-person-circle display-4 text-dark mb-2"></i>
                                        <h4 class="card-title text-dark fw-bold"><?=$val[0]?></h4>
                                    </div>
                                    
                                    <p class="card-text text-secondary small flex-grow-1">
                                        Cliquez pour procéder à la notation de ce stagiaire.
                                    </p>
                                    <p><?php echo ($val['statut_stg'] === 'évalué') ? ( $moy = entreprise::afficher_moyenne([$_SESSION['idTuteur'],$val['id_etudiant'],$val['id_stage']])).'/20' : ''; ?></p>
                                    
                                    <input type="hidden" name='id_etudiant' value='<?php echo $val['id_etudiant'] ?>'>
                                    <input type="hidden" name='id_stage' value='<?php echo $val['id_stage'] ?>'>
                                    <input type="hidden" name='idTuteur' value='<?php echo $_SESSION['idTuteur'] ?>'>
                                    <input type="hidden" name='nom_stagiaire' value='<?php echo $val['nom_stagiaire'] ?>'>
                                    
                                    <button type="submit" name='envoyer' class='btn btn-dark mt-3 fw-bold' 
                                            <?php echo ($val['statut_stg'] === 'évalué') ? 'disabled' : ''; ?>>
                                        <i class="bi bi-pencil-square me-1"></i> 
                                        <?php echo ($val['statut_stg'] === 'évalué') ? 'ÉVALUATION TERMINÉE' : 'ÉVALUER'; ?>
                                    </button>                      
                                </div>
                            </form>
                        </div>
                        <?php
                            }
                        ?>
                    </div>  
                </div>
                
                <div class="col-12 text-center mt-5">
                    <a href="../tuerSession.php" class="text-dark text-decoration-none fw-semibold">
                        <i class="bi bi-arrow-left me-2"></i>
                        Quitter la session
                    </a>
                </div>

            </div>
        </section>
        
    </div>
</body>
</html>