<?php

    class CreateArticle {

        private $required_fields = [];
        private $response = [];
        private $picture = [];
        private $pdo;
        private $errors = [];

        public function __construct($POST, DataBase $pdo, $image = []) {
            $this->required_fields['title'] = $POST['title'];
            $this->required_fields['category'] = $POST['category'];
            $this->required_fields['description'] = $POST['description'];
            $this->required_fields['content'] = $POST['content'];
            $this->picture = $image;
            $this->pdo = $pdo;
        }

        private function isEmpty( array $fields ) {
            foreach ($fields as $key => $value) {
                if (empty($value)) {
                    $this->errors[] = $key;
                }

            }
        }

        private function uploadImage( $image ) {
            if (empty($image)) return;
            $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            if (!($extension === 'png' || $extension === 'jpg' || $extension === 'jpeg')) return;
            $filename = "../img/uploads/".uniqid().".".$extension;
            move_uploaded_file($image['tmp_name'], $filename);
            return $filename;
        }

        private function createResponse() {
            $this->isEmpty( $this->required_fields );
            if (!empty($this->errors)) {
                $this->response = [
                    'status' => false,
                    'fields' => $this->errors
                ];
            }
            else {
                $this->response = [
                    'status' => true
                ];
            }
        }

        public function createArticle() {
            $this->createResponse();
            if ($this->response['status'] === true) {
                $this->pdo->execute('INSERT articles(title, categories_id, description, content, user_id) VALUES (?, ?, ?, ?, ?)',
                    array($this->required_fields['title'], $this->required_fields['category'],
                        $this->required_fields['description'], $this->required_fields['content'], $_SESSION['user']['id']));

                $image_path = $this->uploadImage( $this->picture );
                if (!empty($image_path)) {
                    $article_id = $this->pdo->query('SELECT id FROM articles ORDER BY id DESC LIMIT 1');
                    $this->pdo->execute('UPDATE articles SET  picture = ? WHERE id = ?', array($image_path, $article_id[0]['id']));
                }
            }
            return $this->response;
        }

    }

    class Views {

        private static function checkUserId( $user_id, $article_id, DataBase $pdo ) {
            $result = $pdo->query('SELECT * FROM user_views WHERE user_id = ? AND article_id = ?', array( $user_id, $article_id ));
            if (empty($result)) return true;
            return false;

        }

        public static function addView( $user_id, $article_id, DataBase $pdo ) {
            if (self::checkUserId( $user_id, $article_id, $pdo )) {
                $pdo->execute('UPDATE articles SET views = views + 1 WHERE id = ?', array( $article_id ));
                $pdo->execute('INSERT user_views(article_id, user_id) VALUES (?, ?)', array( $article_id, $user_id ));
            }

        }

    }
