<?php
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Cotation Étudiant</title>
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100 p-4">
    
    <section class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-8 col-lg-6">
                
                <div class="card shadow-lg p-5 bg-white border-0">
                    
                    <h3 class="text-center mb-4 text-dark fw-bold">
                        <i class="bi bi-patch-check-fill me-2"></i> ÉVALUATION <span class="text-secondary">STAGIAIRE</span>
                    </h3>
                    
                    <hr class="text-secondary">
                    
                    <p class="text-center text-secondary mb-4 small">
                        Veuillez renseigner les notes de 0 à 10 pour chaque critère d'évaluation ci-dessous.
                    </p>
                    
                    <?php
                        if(isset($_GET['msg'])){
                            // Alerte pour les messages d'erreur ou de succès
                            echo '<div class="alert alert-danger text-center mb-3" role="alert">'.$_GET['msg'].'</div>';
                        }
                    ?>
                    
                    <form action="root.php" method="POST" class="needs-validation" novalidate>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-book"></i></span>
                                <input class="form-control" type="number" name="connaissance_professionelles" placeholder="1. Connaissances Professionnelles (0-20)" min="0" max="20" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-speedometer"></i></span>
                                <input class="form-control" type="number" name="rendement" placeholder="2. Rendement (0-20)" min="0" max="20" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-lightbulb"></i></span>
                                <input class="form-control" type="number" name="esprit_initiative" placeholder="3. Esprit d'Initiative (0-20)" min="0" max="20" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-clock-history"></i></span>
                                <input class="form-control" type="number" name="ponctualite_ordre_discioline" placeholder="4. Ponctualité, Ordre et Discipline (0-20)" min="0" max="20" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-people"></i></span>
                                <input class="form-control" type="number" name="collaboration_travail_equipe" placeholder="5. Collaboration et Travail d'Équipe (0-20)" min="0" max="20" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-patch-check"></i></span>
                                <input class="form-control" type="number" name="conscience_prof" placeholder="6. Conscience Professionnelle (0-20)" min="0" max="20" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-person-hearts"></i></span>
                                <input class="form-control" type="number" name="comportement_generale" placeholder="7. Comportement Général (0-20)" min="0" max="20" required>
                            </div>
                        </div>
                        
                        <p class="small text-secondary text-end mb-2">Informations de soumission :</p>
                        <div class="d-flex justify-content-between mb-4">
                            <input type="hidden" name="id_etudiant" value='<?php echo $_POST['id_etudiant'] ?? '' ?>'>
                            <input type="hidden" name="id_stage" value='<?php echo $_POST['id_stage'] ?? '' ?>'>
                            <input type="hidden" name="idTuteur" value='<?php echo $_POST['idTuteur'] ?? '' ?>'>
                            <span class="badge bg-secondary">Étu. : <?php echo $_POST['nom_stagiaire'] ?? 'N/A' ?></span>
                            <span class="badge bg-secondary">Stage ID: <?php echo $_POST['id_stage'] ?? 'N/A' ?></span>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-dark fw-bold py-2" type="submit" name="enregEva">
                                <i class="bi bi-send-fill me-2"></i> Enregistrer l'Évaluation
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>
</body>
</html>