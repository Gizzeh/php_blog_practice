<?php
session_start();

    require_once "../Model/DataBase.php";
    require_once "../Model/comments_model.php";

    $pdo = new DataBase( $config['db'] );

    $comment = new Comments($_POST['article_id'], $_SESSION['user']['id'], $_POST['comment'], $pdo);
    $response = $comment->createResponse();

    echo json_encode($response);