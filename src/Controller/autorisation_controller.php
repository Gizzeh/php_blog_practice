<?php
    session_start();

    require_once "../Model/DataBase.php";
    require_once "../Model/autorisation_model.php";

    $pdo = new DataBase( $config['db'] );

    $log_in = new Autorisation($_POST, $pdo);
    $result = $log_in->autorisation();
    echo json_encode($result);

    if (!isset($_SESSION['user'])) {
        $user = $log_in->returnUser();
        $_SESSION['user']['id'] = $user['id'];
        $_SESSION['user']['nickname'] = $user['nickname'];
        $_SESSION['user']['email'] = $user['email'];
        $_SESSION['user']['avatar'] = $user['avatar'];
        if (!is_null($user['about'])) {
            $_SESSION['user']['about'] = $user['about'];
        }
        $_SESSION['user']['registration_date'] = $user['registration_date'];
    }