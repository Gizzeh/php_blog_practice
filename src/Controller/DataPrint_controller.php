<?php

require_once "../Model/DataBase.php";
require_once "../Model/DataPrint_model.php";

    $pdo = new DataBase( $config['db'] );
    $data_print = new DataPrint( $pdo );

    $categories = $data_print->getCategories();

    $last_comment = $data_print->getLastComment();
    $last_comment['text'] = mb_strimwidth($last_comment['text'], 0, 100, "...");
    $last_comment['article'] = $data_print->getArticleById($last_comment['article_id']);
    $last_comment['user'] = $data_print->getUserById($last_comment['user_id']);

    $new_user = $data_print->getLastUser();
