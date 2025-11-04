<?php
// Optionnel: Détecte la page actuelle pour mettre en évidence le lien actif.
$current_page = basename($_SERVER['PHP_SELF']);
?>

<header class="d-flex flex-column flex-shrink-0 p-3 bg-white border-end vh-100 position-fixed" style="width: 400px; z-index: 1000;">
    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
        <span class="fs-5 fw-bold text-dark">PROJET STAGE</span>
    </div>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="index.php" class="nav-link bg-info text-light" >
                <i class="bi bi-speedometer2 me-2"></i>
                DASHBOARD <span class="fw-normal">ADMINISTRATEUR</span>
            </a>
        </li>
        
        <li class="my-2"></li> 

        <li class="nav-item">
            <a href="index.php" class="nav-link 
                <?php echo ($current_page == 'index.php') ? 'active bg-dark text-white' : 'text-dark'; ?>">
                <i class="bi bi-building me-2"></i>
                Valider entreprise
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="valider_offre.php" class="nav-link 
                <?php echo ($current_page == 'valider_offre.php') ? 'active bg-dark text-white' : 'text-dark'; ?>">
                <i class="bi bi-briefcase me-2"></i>
                Valider offre de stage
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="inscriptionEse.php" class="nav-link 
                <?php echo ($current_page == 'inscriptionEse.php') ? 'active bg-dark text-white' : 'text-dark'; ?>">
                <i class="bi bi-briefcase me-2"></i>
                Inscrire Entreprise
            </a>
        </li>
        <hr>
        <li class="nav-item">
            <a href="valider_candidature.php" class="nav-link 
                <?php echo ($current_page == 'valider_candidature.php') ? 'active bg-dark text-white' : 'text-dark'; ?>">
                <i class="bi bi-person-check me-2"></i>
                Valider Candidature
            </a>
        </li>
    </ul>

    <div class="border-top pt-3 mt-auto">
        <a href="../tuerSession.php" class="btn btn-outline-dark w-100">
            <i class="bi bi-box-arrow-right me-2"></i>
            Quitter
        </a>
    </div>
</header>