<?php
    session_start();
    if(!isset($_SESSION['name'])){
        header('location:../pages/connexion.php');
    }
    include('../config.php');
    config::autoload();
    $liste = entreprise::toutEse();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="favicon.png" href="../assets/images/images/logo.PNG">
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
    <title>header</title>
</head>
<body id='b-ajE' class='bg-light' >
    
    <?php require('header.php'); ?>
    <section class='bg-light w-50 m-auto p-4'> 
        <h3><b>Validation <span >ENTREPRISE</span></h3>
        <hr>
        <div>
            <p>Sélectionner l'entreprise et cliquer sur valider pour modifier son statut de validation</p>
            
        </div>

        
        <hr>
        
        <form id='formA' class='form-group' action="../pages/root.php" method='POST'>
            <div>
                <select class='form-control w-100' name="ese" id="">
                    <?php foreach($liste as $d) {?>
                        <option  value="<?php echo $d[1] ?>"><?php echo $d[1] ?></option>
                    <?php }    ?>
                </select>
                <input type="submit" name='valider' value="valider" class='form-control btn btn-info mt-3'>
            </div>
            
        </form>

        <h4 class='mt-4 text-light'>LISTE DES ENTREPRISES INSCRITES </h4>
        <table class='table table-striped table-bordered  table-light table-hover ed mt-4'>
            <tfoot></tfoot>
            <thead class='sticky-top'>
                <tr >
                    <th scope='col'>nom</th>
                    <th scope='col'>secteur</th>
                    <th scope='col'>adresse</th>
                    <th scope='col'>email</th>
                    <th scope='col'>statut validation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($liste as $d) { ?>
               
                <tr>
                    <td><?=$d[1] ?></td>
                    <td><?=$d[2] ?></td>
                    <td><?=$d[3] ?></td>
                    <td><?=$d[4] ?></td>
                    <td><?=$d[6] ?></td>
                </tr>

                <?php }    ?>
            </tbody>
        </table>
        
    </section>
</body>
</html>

