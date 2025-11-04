<?php
    session_start();

    if(!isset($_SESSION['id'])){
        header('location:../pages/connexion.php');
    }
    include('../config.php');
    config::autoload();
    $listeStages =  enseignant::suivreStage($_SESSION['idEnseignant']);
    $listeStagesNonEvaluees = enseignant::recupereEtatCand($_SESSION['idEnseignant']);
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="favicon.png" href="../assets/images/logo.PNG">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Vue Enseignant</title>
</head>
<body class="bg-light"> 
    
    <div class="d-flex min-vh-100">
     
    
        <main class="flex-grow-1 p-4">
            <section class="container py-4">
                <div class="row justify-content-center">
                    
                    <div class="col-md-12">
                        
                        <h2 class="mb-4 text-dark fw-bold border-bottom pb-2">
                            <i class="bi bi-person-workspace me-2"></i> SUIVI DES STAGES ENSEIGNANT
                        </h2>
                        
                        <h4 class="mb-3 mt-5 text-dark fw-bold">
                            <i class="bi bi-check-circle-fill me-2 text-success"></i> Stages Évalués
                        </h4>
                        <p class="text-secondary mb-4 small">
                            Vue d'ensemble des stages pour lesquels le tuteur a soumis une évaluation finale.
                        </p>
                        
                        <div class="row g-4">
                            
                            <?php
                                if (empty($listeStages)) {
                                    echo '<div class="col-12"><div class="alert alert-info text-center shadow-sm" role="alert">';
                                    echo '<i class="bi bi-info-circle me-2"></i> Aucun stage évalué sous votre supervision.';
                                    echo '</div></div>';
                                }
                                
                                foreach ($listeStages as $stage) {
                                    // Détermine la couleur de la bordure et du badge
                                    $rapport_existe = enseignant::voirrapport($stage['id_etud']);
                                    $border_class = $rapport_existe ? 'border border-2 border-success' : 'border border-2 border-warning';
                                    $statut_badge_class = ($stage['stateC'] === 'évalué') ? 'bg-success' : 'bg-primary';
                            ?>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <form action="enseignant_details.php" method="GET" class="h-100">
                                    <div class="card shadow-sm p-4 text-center bg-white h-100 d-flex flex-column <?php echo $border_class; ?>">
                                        
                                        <div class="mb-3">
                                            
                                            <div class="mb-2">
                                                <span class="badge <?php echo $statut_badge_class ?> rounded-pill fw-semibold">
                                                    <?php echo strtoupper($stage['stateC']) ?>
                                                </span>
                                            </div>
                                            
                                            <i class="bi bi-mortarboard-fill display-4 text-dark mb-2"></i>
                                            <h4 class="card-title text-dark fw-bold"><?=$stage['nom']?></h4>
                                            
                                            <div class="my-3">
                                                <span class="fs-4 fw-bold text-dark"><?=$stage['moy']?></span>
                                                <span class="text-secondary small">/20 de moyenne</span>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" name='id_eval' value='<?php echo $stage['id_eval'] ?>'>
                                        
                                        <a href="<?php echo $rapport_existe[0] !='' ? $rapport_existe : '#' ?>" 
                                           class="<?php echo $rapport_existe[0] !='' ? 'btn btn-success' : 'btn btn-secondary disabled'; ?> mt-3 fw-bold small">
                                            <i class="bi bi-file-earmark-pdf me-1"></i>
                                            <?php echo $rapport_existe[0] !='' ? 'Voir le Rapport' : 'Rapport non envoyé' ?>
                                        </a>
                                        
                                        <a href='voir_details.php?ideval=<?php echo $stage['id_eval'] ?>' class='btn btn-dark mt-2 fw-bold small'>
                                            <i class="bi bi-eye me-1"></i> Voir Plus
                                        </a>

                                    </div>
                                </form>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        
                        <hr class="my-5">
                        
                        <h4 class="mb-3 text-dark fw-bold">
                            <i class="bi bi-clock-history me-2 text-warning"></i> Candidatures/Stages en Cours
                        </h4>
                        <p class="text-secondary mb-4 small">
                            Liste des stages en attente d'évaluation ou des candidatures non finalisées.
                        </p>
                        
                        <div class="row g-4">
                            
                            <?php
                                if (empty($listeStagesNonEvaluees)) {
                                    echo '<div class="col-12"><div class="alert alert-warning text-center shadow-sm" role="alert">';
                                    echo '<i class="bi bi-info-circle me-2"></i> Aucun étudiant dans cette section.';
                                    echo '</div></div>';
                                }
                                
                                foreach ($listeStagesNonEvaluees as $stage) {
                                    $statut_cand_badge = ($stage[4] === 'Acceptée') ? 'bg-primary' : 'bg-warning text-dark';
                                    $statut_cand_texte = ($stage[4] === 'Acceptée') ? 'Stage en cours' : 'Candidature';
                                    
                            ?>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <form action="enseignant_details.php" method="GET" class="h-100">
                                    <div class="card shadow-sm p-4 text-center bg-white h-100 d-flex flex-column border border-2 border-secondary">
                                        
                                        <div class="mb-3">
                                            
                                            <small class="text-secondary d-block">Statut :</small>
                                            <div class="mb-2">
                                                <span class="badge <?php echo $statut_cand_badge ?> rounded-pill fw-semibold">
                                                    <?php echo strtoupper($stage[4]) ?>
                                                </span>
                                            </div>
                                            
                                            <small class="text-secondary d-block">Entreprise :</small>
                                            <div class="mb-2">
                                                <span class="badge bg-light text-dark border rounded-pill fw-semibold">
                                                    <?=$stage[3] ?>
                                                </span>
                                            </div>
                                            
                                            <i class="bi bi-person-fill display-4 text-dark mb-2"></i>
                                            <h4 class="card-title text-dark fw-bold"><?=$stage['nom']?></h4>
                                            
                                            <p class="small text-dark mb-1 fw-bold mt-2"><?=$stage['titre']?></p>
                                            <small class="text-secondary">Dépôt: <?=$stage['date_cand'] ?></small>
                                            
                                        </div>
                                        
                                        <button type="button" class='btn btn-light border mt-3 fw-bold small text-secondary' disabled>
                                            <i class="bi bi-info-circle me-1"></i> Suivi en cours
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
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Quitter la session
                    </a>
                </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>