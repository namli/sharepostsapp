<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
        $this->db->query('SELECT * ,
                        users.id as userId,
                        posts.id as postId,
                        posts.created_ad as postCreated,
                        users.created_ad as userCreated
                        FROM posts
                        INNER JOIN users
                        ON posts.user_id = users.id
                        ORDER BY posts.created_ad DESC
                        ');

        return $this->db->resultSet();
    }

    public function addPost(array $data = null)
    {
        try {
            $this->db->query('INSERT INTO posts (title, body, user_id) VALUES (:title, :body, :user_id)');
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editPost(array $data = null)
    {
        try {
            $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getPostById(int $id = null)
    {
        try {
            $this->db->query('SELECT * FROM posts WHERE id = :id');
            $this->db->bind(':id', $id);

            return $this->db->single();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deletePost(int $id = null)
    {
        try {
            $this->db->query('DELETE FROM posts WHERE id = :id');
            $this->db->bind(':id', $id);

            $this->db->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
