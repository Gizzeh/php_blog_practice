<?php

class Registration {

    private $user_data = [];
    private $error_message = [];
    private $response = [];
    private $pdo;

    public function __construct( $POST, DataBase $pdo )
    {
        $this->user_data['login'] = $POST['login'];
        $this->user_data['email'] = $POST['email'];
        $this->user_data['password'] = $POST['password'];
        $this->user_data['confirm_password'] = $POST['confirm_password'];
        $this->pdo = $pdo;
    }

    private function checkLoginInDataBase( string $login ) {
        $result = $this->pdo->query('SELECT COUNT(*) FROM users WHERE nickname = ?', array( $login ));
        if ($result[0]['COUNT(*)'] > 0) {
            $this->error_message = [
                'msg' => "Данный логин уже занят",
                'type' => 'login'
            ];
        }
    }

    private function checkEmailInDataBase( string $email ) {
        $result = $this->pdo->query('SELECT COUNT(*) FROM users WHERE email = ?', array( $email ));
        if ($result[0]['COUNT(*)'] > 0) {
            $this->error_message = [
                'msg' => "Пользователь с данной почтой уже существует",
                'type' => 'email'
            ];
        }
    }

    private function checkPassword() {
        if ($this->user_data['password'] !== $this->user_data['confirm_password']) {
            $this->error_message = [
                'msg' => "Пароли не совпадают",
                'type' => 'password'
            ];
        }
    }

    private function checkEmail() {
        $result = filter_var($this->user_data['email'], FILTER_VALIDATE_EMAIL);
        if ($result === false) {
            $this->error_message = [
                'msg' => "Почта введена неверно",
                'type' => 'email'
            ];
        }
    }

    private function validateAllFields() {
        if ($this->user_data['login'] === '' || $this->user_data['email'] === ''
            || $this->user_data['password'] === '' || $this->user_data['confirm_password'] === '') {

            $this->error_message = [
                'msg' => "Заполните все поля",
                'type' => 'all'
            ];

            return $this->response = [
                'status' => false,
                'fields' => $this->error_message
            ];
        }
        $this->checkLoginInDataBase($this->user_data['login']);
        $this->checkEmailInDataBase($this->user_data['email']);
        $this->checkPassword();
        $this->checkEmail();
    }

    private function createResponse() {
        $this->validateAllFields();
        if ( count($this->error_message) > 0 ) {
            $this->response = [
                'status' => false,
                'fields' => $this->error_message
            ];
        }
        else {
            $this->response = [
                'status' => true,
                'msg' => "Регистрация прошла успешно!"
            ];
        }
    }

    private function InsertUserToDataBase($login, $email, $password) {
        $this->pdo->execute('INSERT users(nickname, email, password) VALUES (?, ?, ?)', array($login, $email, $password));
    }

    private function hashPassword( $password ) {
        $result = password_hash($password, PASSWORD_DEFAULT);
        if ($result !== false) return $result;
        else die("Ошибка шифрования пароля");
    }

    public function registration() {
        $this->createResponse();
        if ($this->response['status']) {
            $password = $this->hashPassword($this->user_data['password']);
            $this->InsertUserToDataBase($this->user_data['login'], $this->user_data['email'], $password);
            return $this->response;
        }
        else {
            return $this->response;
        }
    }

}


