<?php

class Comments {

    private $comment_info = [];
    private $pdo;
    private $error;

    public function __construct(int $article_id, int $user_id, string $comment, DataBase $pdo) {
        $this->comment_info['article_id'] = $article_id;
        $this->comment_info['user_id'] = $user_id;
        $this->comment_info['text'] = $comment;
        $this->pdo = $pdo;
    }

    private function addCommentIntoDB() {
        if (empty($this->comment_info['text'])) {
            $error['status'] = true;
            return;
        }
        $this->pdo->execute('INSERT comments(text, user_id, article_id) VALUES (?, ?, ?)',
            array($this->comment_info['text'], $this->comment_info['user_id'], $this->comment_info['article_id']));
        $this->pdo->execute('UPDATE articles SET comments_count = comments_count + 1 WHERE id = ?', array( $this->comment_info['article_id'] ));
    }

    public function createResponse() {
        $this->addCommentIntoDB();
        if (empty($this->error)) {
            return $response = [
              'status' => true
            ];
        }
        else {
            return $response = [
              'status' => false
            ];
        }
    }

}
