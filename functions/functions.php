<?php

/*Fonction Lecture des tâches*/
function query($user) {
    include ('database.php');
    $conn = new PDO("mysql:host=$servername;dbname=db_zych", $username, $password);
    $sqlQuery = "SELECT * FROM T_todo WHERE visible = 1 AND user = '$user';";
    $query = $conn->query($sqlQuery);
    $result = $query->fetchAll();
    return $result;
}

/*Fonction ajout tâche */
function ajout_tache($ajout) {
    include ('database.php');
    $conn = new PDO("mysql:host=$servername;dbname=db_zych", $username, $password);
    $sqlQuery = "INSERT INTO T_todo (user, date, tache, statut, visible) VALUES (?, ?, ?, ?, ?)";
    $ajouter_tache = $conn->prepare($sqlQuery);
    $ajouter_tache ->execute(array($ajout['user'], $ajout['date'], $ajout['tache'], 'En cours',1));
}

/*Fonction effacer tâche */
function delete_tache($id){
    include ('database.php');
    $conn = new PDO("mysql:host=$servername;dbname=db_zych", $username, $password);
    $sqlQuery = "UPDATE T_todo SET visible = '0' WHERE id = $id;";
    $conn->query($sqlQuery);
}

/*Fonction statut tâche en terminé */
function terminer_tache($id){
    include ('database.php');
    $conn = new PDO("mysql:host=$servername;dbname=db_zych", $username, $password);
    $sqlQuery = "UPDATE T_todo SET statut = 'Terminé' WHERE id = $id;";
    $conn->query($sqlQuery);
}


?>