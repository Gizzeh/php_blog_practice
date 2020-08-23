<?php
    require_once "../Model/DataBase.php";
    require_once "../Model/DataPrint_model.php";
    require_once "../Model/article_model.php";

    $pdo = new DataBase( $config['db'] );
    $data_print = new DataPrint( $pdo );
    $article = [];
    $article_id = 0;

    if (isset($_GET['article'])) {
        $article_id = (int)$_GET['article'];
        $article = $data_print->getArticleById($article_id);
        if (empty($article)) {
            header("Location: ../View/404.php");
        }
    }
    else {
        header("Location: ../View/404.php");
    }

    Views::addView($_SESSION['user']['id'], $article_id, $pdo);

    $comments = $data_print->getCommentsByArticleId($article_id);
    foreach ($comments as &$comment) {
        $comment['user_avatar'] = $data_print->getUserById($comment['user_id'])['avatar'];
        $comment['user_nickname'] = $data_print->getUserById($comment['user_id'])['nickname'];
    }
    unset($comment);
