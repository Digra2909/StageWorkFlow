<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <title>Inscription Étudiant</title>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    
    <section class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-7 col-lg-5">
                
                <div class="card shadow-lg p-4 bg-white border-0">
                    
                    <h3 class="text-center mb-4 text-dark fw-bold">
                        INSCRIPTION <span class="text-secondary">ÉTUDIANT</span>
                    </h3>
                    
                    <hr class="text-secondary">
                    
                    <p class="text-center text-secondary mb-3">
                        Renseignez les champs ci-après pour votre inscription.
                    </p>
                    
                    <hr class="text-secondary">
                    
                    <form action="../pages/root.php" enctype='multipart/form-data' method='POST' class="needs-validation" novalidate>
                        
                        <?php
                            if(isset($_GET['msg'])){
                                echo '<div class="alert alert-danger text-center mb-3" role="alert">'.$_GET['msg'].'</div>';
                            }
                        ?>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-person-fill"></i></span>
                                <input class="form-control" type="text" name="nom" placeholder="Votre nom complet" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-calendar-check-fill"></i></span>
                                <input class="form-control" type="text" name="promo" placeholder="Votre promotion (ex: L3, Master 1)" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="cv-file" class="form-label text-secondary small mb-1">Votre CV (format PDF uniquement)</label>
                            <input class="form-control" type="file" name="cv" id="cv-file" accept=".pdf">
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-tools"></i></span>
                                <input class="form-control" type="text" name="comp" placeholder="Vos compétences (séparées par des virgules)" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-lock-fill"></i></span>
                                <input class="form-control" type="password" name="mdp1" placeholder="Votre mot de passe" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark border-end-0"><i class="bi bi-lock-fill"></i></span>
                                <input class="form-control" type="password" name="mdp2" placeholder="Confirmer votre mot de passe" required>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button class="btn btn-dark fw-bold" type="submit" name="env">
                                <i class="bi bi-person-plus-fill me-2"></i> S'inscrire
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="../pages/choix.php" class="text-dark text-decoration-none small">
                                Retour au choix d'inscription
                            </a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>
</body>
</html>