<?php

    class DataPrint {

        private $pdo;

        public function __construct( DataBase $pdo ) {
            $this->pdo = $pdo;
        }

        public function getCategories() {
            $result = $this->pdo->query('SELECT * FROM categories');
            return $result;
        }

        public function getLastComment() {
            $result = $this->pdo->query('SELECT * FROM comments ORDER BY pubdate DESC LIMIT 1');
            return $result[0];
        }

        public function getLastUser() {
            $result = $this->pdo->query('SELECT * FROM users ORDER BY registration_date DESC LIMIT 1');
            return $result[0];
        }

        public function getArticleById( $id ) {
            $result = $this->pdo->query('SELECT * FROM articles WHERE id = ?', array( $id ));
            return $result[0];
        }

        public function getUserById( $id ) {
            $result = $this->pdo->query('SELECT * FROM users WHERE id = ?', array( $id ));
            return $result[0];
        }

        public function getCommentsByArticleId( $id ) {
            $result = $this->pdo->query('SELECT * FROM comments WHERE article_id = ? ORDER BY comments.pubdate DESC', array( $id ));
            return $result;
        }

    }
