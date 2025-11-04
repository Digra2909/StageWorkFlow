<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="favicon.png" href="../assets/images/logo.PNG">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Choix d'Inscription</title>
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    
    <section class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-12 col-lg-8">
                
                <h2 class="text-center mb-5 text-dark fw-bold">CHOIX D'INSCRIPTION</h2>
                
                <div class="row g-4">
                    
                    
                    <div class="col-sm-6">
                        <div class="card shadow-sm p-4 text-center h-100">
                            <i class="bi bi-mortarboard-fill display-3 text-dark mb-3"></i>
                            <h3 class="card-title text-dark">ÉTUDIANT</h3>
                            <p class="card-text text-secondary">
                                Inscrivez-vous pour postuler aux offres de stage.
                            </p>
                            <a href="../dashboard-etudiant/inscription.php?type=etd" class="btn btn-dark mt-auto">
                                S'inscrire en tant qu'Étudiant
                            </a>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card shadow-sm p-4 text-center h-100">
                            <i class="bi bi-person-badge display-3 text-dark mb-3"></i>
                            <h3 class="card-title text-dark">ENSEIGNANT</h3>
                            <p class="card-text text-secondary">
                                Inscrivez-vous pour postuler aux offres de stage.
                            </p>
                            <a href="../tableau_de_bord_enseignant/inscription.php?" class="btn btn-dark mt-auto">
                                S'inscrire en tant qu'Énseignant
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="connexion.php" class="text-dark text-decoration-none">
                        <i class="bi bi-arrow-left me-2"></i>
                        Retour à la connexion
                    </a>
                </div>

            </div>
        </div>
    </section>
</body>
</html>