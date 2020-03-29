<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Login user
    public function login(string $email = null, string $password = null)
    {
        try {
            $this->db->query('SELECT * from users WHERE email = :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single();

            $hashed_password = $row->password;
        } catch (\Throwable $th) {
            throw $th;
        }

        if (password_verify($password, $hashed_password)) {
            return $row;
        }

        return false;
    }

    // Register user
    public function register(array $data = [])
    {
        try {
            $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':password', $data['password']);
            $this->db->execute();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function findUserByEmail($email = null)
    {
        if (!empty($email)) {
            $this->db->query('SELECT * from users WHERE email= :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single();
        }
        if ($this->db->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getUserById(int $id = null)
    {
        try {
            $this->db->query('SELECT * FROM users WHERE id = :id');
            $this->db->bind(':id', $id);

            return $this->db->single();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
