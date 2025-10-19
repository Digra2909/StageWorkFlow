<?php
// Optionnel: DÃ©tecte la page actuelle pour mettre en Ã©vidence le lien actif.
$current_page = basename($_SERVER['PHP_SELF']);
?>

<header class="d-flex flex-column flex-shrink-0 p-3 bg-white border-end vh-100" style="width: 400px; z-index: 1000;">
    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
        <span class="fs-5 fw-bold text-dark">PROJET STAGE</span>
    </div>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="index.php" class="nav-link bg-info text-light" >
                <i class="bi bi-speedometer2 me-2"></i>
                DASHBOARD <span class="fw-normal">ENTREPRISE</span>
            </a>
        </li>
        
        <li class="my-2"></li> 

        <li class="nav-item">
            <a href="index.php" class="nav-link 
                <?php echo ($current_page == 'index.php') ? 'active bg-dark text-white' : 'text-dark link-dark'; ?>">
                <i class="bi bi-building me-2"></i>
                Publier une offre de stage
            </a>
        </li>
        <li class="nav-item">
            <a href="voir_candidature.php" class="nav-link 
                <?php echo ($current_page == 'voir_candidature.php') ? 'active bg-dark text-white' : 'text-dark link-dark'; ?>">
                <i class="bi bi-briefcase me-2"></i>
                Gerer les candidatures
            </a>
        </li>
        <li class="nav-item">
            <a href="voir_offre.php" class="nav-link 
                <?php echo ($current_page == 'voir_offre.php') ? 'active bg-dark text-white' : 'text-dark link-dark'; ?>">
                <i class="bi bi-briefcase me-2"></i>
                Mes offres
            </a>
        </li>
        <li class="nav-item">
            <a href="enregistrer_tuteur.php" class="nav-link 
                <?php echo ($current_page == 'enregistrer_tuteur.php') ? 'active bg-dark text-white' : 'text-dark link-dark'; ?>">
                <i class="bi bi-briefcase me-2"></i>
                Enregistrer tuteur
            </a>
        </li>
        <li class="nav-item">
            <a href="assignation_tuteur.php" class="nav-link 
                <?php echo ($current_page == 'assignation_tuteur.php') ? 'active bg-dark text-white' : 'text-dark link-dark'; ?>">
                <i class="bi bi-briefcase me-2"></i>
                Assignation tuteur
            </a>
        </li>
        <hr class="text-secondary">
    </ul>

    <div class="border-top pt-3 mt-auto">
        <a href="../tuerSession.php" class="btn btn-outline-dark w-100">
            <i class="bi bi-box-arrow-right me-2"></i>
            Quitter
        </a>
    </div>
</header>