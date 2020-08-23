<?php
    require_once "../Model/DataBase.php";
    require_once "../Model/main_page_model.php";

    $pdo = new DataBase( $config['db'] );

    $articles = [];

    if (!isset($_GET['page'])) {
        header("Location: ../View/main_page.php?new&page=0");
    }

    $page = filter_var($_GET['page'] , FILTER_VALIDATE_INT, array('options' => array('default' => 0)));
    $page *= 10;

    if (isset($_GET['new'])) {
        $articles = ArticlesOutput::getNewArticles( $pdo, $page );
        $articles_count = ArticlesOutput::getArticlesCount( $pdo );
    }
    elseif (isset($_GET['views'])) {
        $articles = ArticlesOutput::getArticlesByViews( $pdo, $page );
        $articles_count = ArticlesOutput::getArticlesCount( $pdo );
    }
    elseif (isset($_GET['comments'])) {
        $articles = ArticlesOutput::getArticlesByComments( $pdo, $page );
        $articles_count = ArticlesOutput::getArticlesCount( $pdo );
    }
    elseif (isset($_GET['category-id'])) {
        $articles = ArticlesOutput::getArticlesByCategories( $pdo, $_GET['category-id'], $page );
        $articles_count = ArticlesOutput::getArticlesByCategoriesCount( $pdo, $_GET['category-id'] );
    }
    elseif (isset($_GET['search'])) {
        $result = ArticlesOutput::getArticlesByTitle( $pdo, $_GET['search'] );
        $articles = $result['articles'];
        $articles_count = $result['count'];
    }
    elseif ( isset($_GET['user'])) {
        $result = ArticlesOutput::getArticlesByUserId( $pdo, $_GET['user'] );
        $articles = $result['articles'];
        $articles_count = $result['count'];
    }
    else {
        header("Location: ../View/main_page.php?new&page=0");
    }

    $pagination_block_count = ceil($articles_count / 10 ) - 1;

    switch ($_GET['page']) {
        case 0:
            if ($pagination_block_count >= 1) {
                $pagination_element = [0, 1];
            }
            else {
                $pagination_element = [0];
            }
            break;
        case $pagination_block_count:
            $pagination_element = [$pagination_block_count - 1, $pagination_block_count];
            break;
        default:
            $pagination_element = [$_GET['page'] - 1, $_GET['page'], $_GET['page'] + 1];
    }






