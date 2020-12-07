<?php
  class AbstractDAO {
    protected $mysqli;

    function __construct($db_host, $db_username, $db_password, $db_database) {
      try {
        $this->mysqli = new mysqli(
          $db_host, $db_username, 
          $db_password, $db_database
        );
      } catch (mysqli_sql_exception $e) {
        throw $e;
      }
    }

    public function getMysqli() {
      return $this->mysqli;
    }
  }
?>
