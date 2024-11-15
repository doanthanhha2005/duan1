<?php
require_once 'config.php';

class ConnectDB {
    public $PDO;
    public $SQL;
    public $Sta;

    public function __construct() {     
        try {
            $this->PDO = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USERNAME, DB_PASSWORD
            );
            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    public function getPDO() {
        return $this->PDO;
    }

    public function setQuery($sql) {
        $this->SQL = $sql;
    }

    public function execute($options = array()) {
        try {
            $this->Sta = $this->PDO->prepare($this->SQL);

            if ($options) {
                for ($i = 0; $i < count($options); $i++) {
                    $this->Sta->bindParam($i + 1, $options[$i]);
                }
            }

            $this->Sta->execute();
            return $this->Sta;
        } catch (PDOException $e) {
            echo "Error executing query: " . $e->getMessage();
        }
    }

    public function loadData($options = array(), $getAllData = true) {
        try {
            if (!$options) {
                if (!$result = $this->execute()) return false;
            } else {
                if (!$result = $this->execute($options)) return false;
            }

            if ($getAllData) {
                return $result->fetchAll(PDO::FETCH_OBJ);
            } else {
                return $result->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            echo "Query error: " . $e->getMessage();
        }
    }
}
?>
