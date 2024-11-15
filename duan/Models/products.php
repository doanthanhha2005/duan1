<?php
class Product {
    private $db;

    public function __construct($db) {
        $this->db = $db->getPDO();
    }

    public function getAllProducts() {
        $query = "SELECT * FROM products";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchProducts($keyword) {
        $query = "SELECT * FROM products WHERE product_name LIKE :keyword OR description LIKE :keyword";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
