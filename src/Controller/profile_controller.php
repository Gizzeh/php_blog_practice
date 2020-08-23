<?php
session_start();

require_once "../Model/DataBase.php";
require_once "../Model/DataPrint_model.php";

$pdo = new DataBase( $config['db'] );
$user = [];


    if (isset($_GET['user'])) {
            $data_print = new DataPrint( $pdo );
            $user = $data_print->getUserById($_GET['user']);
    }
    else {
        $user['id'] = $_SESSION['user']['id'];
        $user['nickname'] = $_SESSION['user']['nickname'];
        $user['email'] = $_SESSION['user']['email'];
        $user['avatar'] = $_SESSION['user']['avatar'];
        $user['about'] = $_SESSION['user']['about'];
        $user['registration_date'] = $_SESSION['user']['registration_date'];
    }

