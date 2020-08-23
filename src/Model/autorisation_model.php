<?php


    class Autorisation {

        private $login;
        private $password;
        private $pdo;
        private $error_message;
        private $response = [];

        public function __construct($POST, DataBase $pdo)
        {
            $this->login = $POST['login'];
            $this->password = $POST['password'];
            $this->pdo = $pdo;
        }

        private function checkUserInDataBase( string $login ) {
            $result = $this->pdo->query('SELECT COUNT(*) FROM users WHERE nickname = ?', array( $login ));
            if ($result[0]['COUNT(*)'] === 0) {
                $this->error_message = 'Неверный логин или пароль';
                return false;
            }
            return true;
        }

        private function verifyPassword( string $login ) {
            $hash = $this->pdo->query('SELECT password FROM users WHERE nickname = ?', array( $login ));
            $result = password_verify($this->password, $hash[0]['password']);
            if ($result === false) {
                $this->error_message = 'Неверный логин или пароль';
            }
        }

        private function checkFields() {
            if ($this->login === '' || $this->password === '') {
                $this->error_message = 'Заполните все поля';
            }
        }

        private function createResponse() {
            if ( $this->checkUserInDataBase( $this->login ) ) {
                $this->verifyPassword( $this->login );
            }
            $this->checkFields();
            if ( count($this->error_message) > 0 ) {
                $this->response = [
                    'status' => false,
                    'msg' => $this->error_message
                ];
            }
            else {
                $this->response = [
                    'status' => true,
                    'msg' => "Авторизация прошла успешно!"
                ];
            }

        }

        public function returnUser() {
            $user = $this->pdo->query('SELECT * FROM users WHERE nickname = ?', array( $this->login ));
            return $user[0];
        }

        public function autorisation() {
            $this->createResponse();
            return $this->response;
        }

    }
