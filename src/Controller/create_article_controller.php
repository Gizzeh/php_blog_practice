<?php
session_start();

    require_once "../Model/DataBase.php";
    require_once "../Model/article_model.php";


    $pdo = new DataBase( $config['db'] );
    $create_article = new CreateArticle($_POST, $pdo, $_FILES['picture']);

    $response = $create_article->createArticle();

    echo json_encode($response);