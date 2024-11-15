<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $email, $password) {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $this->db->setQuery($sql);
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        return $this->db->execute([$username, $email, $hashedPassword]);
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $this->db->setQuery($sql);
        $user = $this->db->loadData([$username], false);

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
}
?>
