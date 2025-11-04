<?php
    session_start();
    if(!isset($_SESSION['idEnseignant'] ) ){
        if (!isset($_GET['ideval'])) {
                    header('location:../pages/connexion.php');
        }
    }

    include('../config.php');
    config::autoload(); 
    $stg = $_GET['ideval'] ;
    $stage =  enseignant::voir_details($stg);
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="favicon.png" href="../assets/images/logo.PNG">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Détails stage></title>
</head>
<body class="bg-light">
    
    <div class="d-flex min-vh-100"> 
        
        <!-- <?php  include 'header.php'; ?> -->
        
        <main class="flex-grow-1 p-4">
            
            <section class='container py-4'> 
                <div class="card shadow-lg p-5 bg-white border-0">
                    
                    <h2 class="text-dark fw-bold mb-3">
                        <i class="bi bi-file-text me-2"></i> Fiche d'Évaluation Complète 
                    </h2> 
                    
                    <hr class="text-secondary">
                    
                    <p class="text-secondary mb-4">
                        Détails du stage et résultats de l'évaluation pour **<?php echo $stage['nom'] ?>**.
                    </p>
                    
                    
                    <h4 class="text-dark fw-bold mb-3">
                        <i class="bi bi-person-fill me-2"></i> Informations Étudiant
                    </h4>

                    <div class="row mb-4 small">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-dark">Nom Complet</label>
                            <input type="text" value="<?php echo $stage['nom'] ?>" class="form-control bg-light" readonly>
                        </div>
                        
                    </div>
                    
                    <h4 class="text-dark fw-bold mb-3">
                        <i class="bi bi-graph-up-arrow me-2"></i> Résultats de l'Évaluation
                    </h4>
                    

                        <div class="alert alert-dark text-center fw-bold py-3 mb-4">
                            MOYENNE GLOBALE : <span class="text-primary fs-4"><?php echo $stage['moy'] ?></span> / 20
                        </div>

                        <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold text-dark w-75">Connaissances professionelles</span>
                                    <span class="badge bg-secondary fs-6 p-2"><?php echo number_format($stage['conProf'], 1) ?> / 20</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold text-dark w-75">Rendement </span>
                                    <span class="badge bg-secondary fs-6 p-2"><?php echo number_format($stage['rendement'], 1) ?> / 20</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold text-dark w-75">Esprit d'initiative </span>
                                    <span class="badge bg-secondary fs-6 p-2"><?php echo number_format($stage['esprit'], 1) ?> / 20</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold text-dark w-75">ponctualite ordre et discipline </span>
                                    <span class="badge bg-secondary fs-6 p-2"><?php echo number_format($stage['ponct'], 1) ?> / 20</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold text-dark w-75">Collaboration et travail d'équipe</span>
                                    <span class="badge bg-secondary fs-6 p-2"><?php echo number_format($stage['collab'], 1) ?> / 20</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold text-dark w-75">Conscience professionnelles</span>
                                    <span class="badge bg-secondary fs-6 p-2"><?php echo number_format($stage['consc'], 1) ?> / 20</span>
                                </li>
                        </ul>
                    
                    
                    <hr class="text-secondary my-4">

                    <a href="suivi.php" class="btn btn-dark w-100 fw-bold">
                        <i class="bi bi-arrow-left me-2"></i> Retour à la Liste des Stages
                    </a>
                    
                </div>
            </section>
        </main>
    </div>
</body>
</html>