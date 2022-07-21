<?php
    class Post {
        private $db;
        public function __construct(){
            $this->db = new Database;
        }
        public function showAllPost() {
            $this->db->query("SELECT * FROM post ORDER BY post_date ASC");

            $result = $this->db->resultSet();
            return $result;
        }
        public function createPost($data) {
            $this->db->query("INSERT INTO post (user_id, post_title, post_body) VALUES(:user_id, :post_title, :post_body)");

            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':post_title', $data['title']);
            $this->db->bind(':post_body', $data['body']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function findPostById($id) {
            $this->db->query("SELECT * FROM post WHERE id = :id");

            $this->db->bind(':id', $id);

            $row = $this->db->single();
            return $row;

        }
        public function updatePost($data) {
            $this->db->query("UPDATE post SET post_title = :title, post_body = :body WHERE id = :id");

            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function deletePost($id) {
            $this->db->query("DELETE FROM post WHERE id = :id");

            $this->db->bind(':id', $id);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }