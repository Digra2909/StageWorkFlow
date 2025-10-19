
<?php

//codé pr KIDIMBA LUNZI GRADI
//Date début : 08/10/2025
//Dare fin : 08/10/2025
/* 
    cette classe est constitué des différentes fonctions classique
    qui nous permet de configurer l'appli, entre autre la connexion à la base des données,
   ladéfinition des constantes,... 
*/ 



class config{
    
//connexion à la base des donnees
public static function connexion(){
    $conn = new PDO('mysql:host=localhost;dbname=db_stage','root','VOTRE_MOT_DE_PASSE_COMPLEXE');
    return $conn;
}

//définition d'un autoload
public static function autoload(){
        spl_autoload_register(function($className){
        require_once __DIR__."/class/".$className.".php";
    });
}




}
 
?>