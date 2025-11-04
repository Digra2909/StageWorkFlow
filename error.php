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
    <link rel="shortcut icon" type="favicon.png" href="assets/images/logo.PNG">
    <link href="assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Accueil du Dashboard</title>
</head>
<body class="bg-white" style="">
    

    <main class="container-fluid py-5 d-flex align-items-center justify-content-center" style="min-height: 90vh;">
        
        <div class="text-center">
            <h1 class="display-1 fw-bolder text-light  mb-3 bg-dark p-5">
               404
            </h1>
            
            <small class="lead text-secondary">
                page non trouvé !
            </small>
        </div>
    </main>
</body>
</html>