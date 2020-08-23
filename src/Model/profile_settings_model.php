<?php

    class UserInfoUpdate {

        private $login;
        private $email;
        private $password;
        private $new_password;
        private $avatar;
        private $about;
        private $pdo;
        private $error = [];
        private $response = [];

        public function __construct($POST, DataBase $pdo, $image = []) {
            $this->login = $POST['login'];
            $this->email = $POST['email'];
            $this->password = $POST['password'];
            $this->new_password = $POST['new_password'];
            $this->avatar = $image;
            $this->about = $POST['about'];
            $this->pdo = $pdo;
        }

        private function checkPasswords( string $password ) {
            if ($password === '') return false;
            $pass_from_db = $this->pdo->query('SELECT password FROM users WHERE id = ?', array( $_SESSION['user']['id'] ));
            $result = password_verify($password, $pass_from_db[0]['password']);
            if ( $result === false ) {
                $this->error['type'] = 'password';
                return false;
            }
            return $result;
        }

        private function changePassword ( string $new_password ) {
            if ($this->checkPasswords($this->password) === false) return;
            $hash = password_hash($new_password, PASSWORD_DEFAULT);
            if ($hash !== false) {
                $this->pdo->execute('UPDATE users SET password = ? WHERE id = ?', array( $hash, $_SESSION['user']['id'] ));
            }
        }

        private function changeEmail ( string $email ) {
            if ( $email === '' ) return false;
            $result = filter_var( $email, FILTER_VALIDATE_EMAIL);
            $invalidEmail = $this->pdo->query('SELECT email, id FROM users WHERE email = ?', array($email));
            if ($result === false || (count($invalidEmail) !== 0 && $invalidEmail[0]['id'] !== $_SESSION['user']['id'])) {
                $this->error['type'] = 'email';
                return;
            }
            $this->pdo->execute('UPDATE users SET email = ? WHERE id = ?', array($email, $_SESSION['user']['id'] ));
            $_SESSION['user']['email'] = $email;
        }

        private function changeAboutInfo( string $about ) {
            $this->pdo->execute('UPDATE users SET about = ? WHERE id = ?', array( $about, $_SESSION['user']['id'] ));
            $_SESSION['user']['about'] = $about;
        }

        private function updateAvatar ( $avatar ) {
            if (is_null($avatar)) return;
            $extension = pathinfo($avatar['name'], PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            if (!($extension === 'png' || $extension === 'jpg' || $extension === 'jpeg')) return;
            $filename = "../img/uploads/".uniqid().".".$extension;
            move_uploaded_file($avatar['tmp_name'], $filename);
            if ($_SESSION['user']['avatar'] !== "../img/avatar.png") {
                $old_avatar = $this->pdo->query('SELECT avatar FROM users WHERE id = ?', array( $_SESSION['user']['id'] ));
                unlink($old_avatar[0]['avatar']);
            }
            $this->pdo->execute('UPDATE users SET avatar = ? WHERE id = ?', array($filename, $_SESSION['user']['id']));
            $_SESSION['user']['avatar'] = $filename;
        }

        private function changeNickname( string $login ) {
            if ($login === '') return;
            $invalidNickname = $this->pdo->query('SELECT nickname, id FROM users WHERE nickname = ?', array( $login ));
            if ( count($invalidNickname) !== 0 && $invalidNickname[0]['id'] !== $_SESSION['user']['id']) {
                $this->error['type'] = "login";
                return;
            }
            $this->pdo->execute('UPDATE users SET nickname = ? WHERE id = ?', array( $login, $_SESSION['user']['id'] ));
            $_SESSION['user']['nickname'] = $login;
        }

        private function createResponse() {
            if (count($this->error) > 0) {
                $this->response = [
                    'status' => false,
                    'error' => $this->error['type']
                ];
            }
            else {
                $this->response = [
                    'status' => true
                ];
            }
        }

        public function saveChanges() {
            $this->changePassword($this->new_password);
            $this->changeEmail($this->email);
            $this->changeAboutInfo($this->about);
            $this->updateAvatar($this->avatar);
            $this->changeNickname($this->login);
            $this->createResponse();
            return $this->response;
        }

    }