<?php

    require_once "../Model/DataBase.php";
    require_once "../Model/registration_model.php";


    $pdo = new DataBase($config['db']);

    $registration = new Registration($_POST, $pdo);
    $result = $registration->registration();
    echo json_encode($result);

