<?php
session_start();
include('config.php');
config::autoload();

//Définition de quelques constantes
define('PAGES','pages/');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Accueil du Dashboard</title>
</head>
<body class="bg-white" style="">
    

    <main class="container-fluid py-5 d-flex align-items-center justify-content-center" style="min-height: 90vh;">
        
        <div class="text-center">
            
            <h1 class="display-1 fw-bolder text-dark mb-3">
                STAGEWORKFLOW
            </h1>
            
            <p class="lead text-secondary mb-5">
                Bienvenue sur votre plateforme.
            </p>

            <a href="pages/connexion.php" class="btn btn-dark btn-lg px-5">
                <i class="bi bi-arrow-right me-2"></i>
                Continuer
            </a>
            
        </div>
    </main>
</body>
</html>