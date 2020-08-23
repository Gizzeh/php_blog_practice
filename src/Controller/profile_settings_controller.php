<?php
session_start();

    require_once "../Model/DataBase.php";
    require_once "../Model/profile_settings_model.php";


    $pdo = new DataBase( $config['db'] );

    $updateInfo = new UserInfoUpdate($_POST, $pdo, $_FILES['avatar']);
    $result = $updateInfo->saveChanges();

    echo json_encode($result);