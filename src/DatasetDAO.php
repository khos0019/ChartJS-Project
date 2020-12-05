<?php
require_once('AbstractDAO.php');
require_once('Chart/Dataset.php');
require_once('Chart/Dataset/Datarow.php');


class DatasetDAO {
    
    // database name
    private static $DB_NAME = "cst8334";
    private static array $DATAROW_CTORS = [];
    private static array $DATASET_CTORS = [];
    
    /**
     *
     * @param $db_host, $db_password, $db_username
     */
    public function __construct($db_host, $db_username, $db_password) {
        
        try {
            parent::__construct(
                $db_host, $db_username,
                $db_password, self::$DB_NAME
                );
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
        
    }
    
    /**
     *
     * @param string $type $datarow_ctor
     */
    public static function register_datarow_type(string $type, $datarow_ctor) {
        Self::$DATAROW_CTORS[$type] = $datarow_ctor;
    }
    
    /**
     *
     * @param string $type
     * @return mixed
     */
    private static function get_datarow_ctor(string $type) {
        return Self::$DATAROW_CTORS[$type];
    }
    
    /**
     *
     * @param string $type, $dataset_ctor
     */
    public static function register_dataset_type(string $type, $dataset_ctor) {
        Self::$DATASET_CTORS[$type] = $dataset_ctor;
    }
    
    /**
     *
     * @param string $type
     * @return mixed
     */
    private static function get_dataset_ctor(string $type) {
        return Self::$DATASET_CTORS[$type];
    }
    
    /**
     * 
     * 
     * @return array
     */
    public function get_dataset_table(): Array {
        $result = $this->mysqli->query('SELECT LABEL,TYPE FROM Datasets');
        if (!result) {
            trigger_error('Invalid query: ' . $this->mysqli->error);
        }
        if ($result->num_rows <= 0) {
            $result->free();
            return null;
        }
        $datasets = Array();
        while ($row = $result->fetch_assoc()) {
            $dataset = Self::get_dataset_ctor($row['TYPE'])();
            foreach ($this->get_datarows($row['LABEL']) as &$datarow) {
                $dataset->add_row($datarow);
            }
            array_push($datasets, $dataset);
        }
        $result->free();
        return $datasets;
    }
    
    
}

?>