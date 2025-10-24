<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Inscription Entreprise</title>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    
    <section class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-7 col-lg-5">
                
                <div class="card shadow-lg p-5 bg-white border-0">
                    
                    <h3 class="text-center mb-4 text-dark fw-bold">
                        INSCRIPTION <span class="text-secondary">ENTREPRISE</span>
                    </h3>
                    
                    <hr class="text-secondary">
                    
                    <p class="text-center text-secondary mb-4 small">
                        Renseignez les champs ci-après pour enregistrer votre entreprise sur Stageworkflow.
                    </p>
                    
                    <?php
                        if(isset($_GET['msg'])){
                            // Utilisation d'une alerte Danger pour les erreurs
                            echo '<div class="alert alert-danger text-center" role="alert">'.$_GET['msg'].'</div>';
                        }
                    ?>
                    
                    <form action="../pages/root.php" method="POST" class="needs-validation" novalidate>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-building"></i></span>
                                <input class="form-control" type="text" name="rs" placeholder="Raison sociale" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-diagram-3"></i></span>
                                <input class="form-control" type="text" name="sec" placeholder="Secteur d'activité" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-geo-alt"></i></span>
                                <input class="form-control" type="text" name="adr" placeholder="Adresse complète" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-envelope"></i></span>
                                <input class="form-control" type="email" name="email" placeholder="Adresse email" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-lock"></i></span>
                                <input class="form-control" type="password" name="mdpa" placeholder="Mot de passe" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light text-dark"><i class="bi bi-key"></i></span>
                                <input class="form-control" type="password" name="mdpb" placeholder="Confirmer le mot de passe" required>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button class="btn btn-dark fw-bold py-2" type="submit" name="envoi2">
                                <i class="bi bi-person-plus-fill me-2"></i> S'inscrire
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="../pages/choix.php" class="text-dark text-decoration-none small fw-semibold">
                                <i class="bi bi-arrow-left me-1"></i> Retour au choix d'inscription
                            </a>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </section>
</body>
</html>