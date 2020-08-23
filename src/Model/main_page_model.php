<?php

    class ArticlesOutput {

        public static function getArticlesCount( DataBase $pdo ) {
            $result = $pdo->query('SELECT COUNT(*) AS count FROM articles');
            return $result[0]['count'];
        }

        public static function getNewArticles ( DataBase $pdo, int $page ) {
            $result = $pdo->query('SELECT * FROM articles ORDER BY pubdate DESC LIMIT '.$page.', 10');
            return $result;
        }

        public static function getArticlesByViews ( DataBase $pdo, int $page ) {
            $result = $pdo->query('SELECT * FROM articles ORDER BY views DESC LIMIT '.$page.', 10');
            return $result;
        }

        public static function getArticlesByComments ( DataBase $pdo, int $page ) {
            $result = $pdo->query('SELECT * FROM articles ORDER BY comments_count DESC LIMIT '.$page.', 10');
            return $result;
        }

        public static function getArticlesByCategories( DataBase $pdo, $id, int $page ) {
            $result = $pdo->query('SELECT * FROM articles WHERE categories_id = ? ORDER BY pubdate DESC LIMIT '.$page.', 10', array( $id ));
            return $result;
        }

        public static function getArticlesByCategoriesCount( DataBase $pdo, $id) {
            $result = $pdo->query('SELECT COUNT(*) AS count FROM articles WHERE categories_id = ?', array( $id ));
            return $result[0]['count'];
        }

        public static function getArticlesByTitle ( DataBase $pdo, $title ) {
            $all_articles = $pdo->query('SELECT id, title FROM articles ORDER BY pubdate DESC');
            $wanted_articles = [];
            $result_articles = [];
            $articles_count = 0;
            $result = [];
            foreach ( $all_articles as $article ) {
                if ( stristr( $article['title'], $title ) !== false) {
                    $wanted_articles[] = $article['id'];
                }
            }
            foreach ( $wanted_articles as $article ) {
                $result_articles[] = $pdo->query('SELECT * FROM articles WHERE id = ?', array( $article ))[0];
            }
            $articles_count = count($result_articles);
            return $result = [
                'articles' => $result_articles,
                'count' => $articles_count
            ];
        }

        public static function getArticlesByUserId( DataBase $pdo, $id ) {
            $articles = $pdo->query('SELECT * FROM articles WHERE user_id = ?', array( $id ));
            $articles_count = count($articles);
            return $result = [
                'articles' => $articles,
                'count' => $articles_count
            ];
        }

    }
