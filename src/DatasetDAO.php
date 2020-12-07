<?php
  require_once('AbstractDAO.php');
  require_once('Chart/Dataset.php');
  require_once('Chart/Dataset/Datarow.php');

  class DatasetDAO extends AbstractDAO {
    private static $DB_NAME = "cst8334";
    private static array $DATAROW_CTORS = [];
    private static array $DATASET_CTORS = [];

    function __construct($db_host, $db_username, $db_password) {
      try {
        parent::__construct(
          $db_host, $db_username,
          $db_password, self::$DB_NAME
        );
      } catch (mysqli_sql_exception $e) {
        throw $e;
      }
    }

    public static function register_datarow_type(string $type, $datarow_ctor) {
        Self::$DATAROW_CTORS[$type] = $datarow_ctor;
    }

    private static function get_datarow_ctor(string $type) {
      return Self::$DATAROW_CTORS[$type];
    }

    public static function register_dataset_type(string $type, $dataset_ctor) {
        Self::$DATASET_CTORS[$type] = $dataset_ctor;
    }

    private static function get_dataset_ctor(string $type) {
        return Self::$DATASET_CTORS[$type];
    }

    private function get_datarows(string $dataset_label): Array {
      $result = $this->mysqli->query('SELECT LABEL,DAT,TYPE,BG_COLOR FROM Datarows WHERE DATASET_ID = ' . "'$dataset_label'");
      if (!$result) {
        trigger_error('Invalid query: ' . $this->mysqli->error);
      }
      $datarows = Array();
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          array_push(
            $datarows,
            Self::get_datarow_ctor($row['TYPE'])(
              $row['LABEL'],
              $row['DAT'],
              $row['BG_COLOR']
            )
          );
        }
      }
      $result->free();
      return $datarows;
    }

    private function add_datarow(string $type, string $dataset_label, AbsDatarow $datarow): void {
      if (!$this->mysqli->connect_errno) {
        $stmt = $this->mysqli->prepare(
          'INSERT INTO Datarows (TYPE,LABEL,DATASET_ID,DAT,BG_COLOR) VALUES (?,?,?,?,?)'
        );
        if ($stmt == false) {
          trigger_error('Invalid query: ' . $this->mysqli->error);
        }
        $label    = $datarow->get_property(AbsDatarow::LABEL);
        $data     = $datarow->get_property(AbsDatarow::DATA);
        $bg_color = $datarow->get_property(AbsDatarow::BACKGROUND_COLOR)->to_hex();
        $stmt->bind_param('sssds', $type, $label, $dataset_label, $data, $bg_color);
        if (!$stmt->execute()) {
          echo $stmt->error;
        }
      }
    }

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

    public function get_dataset(string $label): Dataset {
      $result = $this->mysqli->query('SELECT LABEL,TYPE FROM Datasets WHERE LABEL = ' . "'$label'");
      if (!$result) {
        trigger_error('Invalid query: ' . $this->mysqli->error);
      }
      if ($result->num_rows <= 0) {
        $result->free();
        return null;
      }
      $dataset = null;
      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $result->free();
        $dataset = Self::get_dataset_ctor($row['TYPE'])();
        $dataset->set_label($row['LABEL']);
        foreach ($this->get_datarows($row['LABEL']) as &$datarow) {
          $dataset->add_row($datarow);
        }
      }
      return $dataset;
    }

    public function add_dataset(string $type, Dataset $dataset) {
      if (!$this->mysqli->connect_errno) {
        $stmt = $this->mysqli->prepare(
          'INSERT INTO Datasets (TYPE,LABEL) VALUES (?,?)'
        );
        if ($stmt == false) {
          trigger_error('Invalid query: ' . $this->mysqli->error);
        }
        $label = $dataset->get_label();
        $stmt->bind_param('ss', $type, $label);
        $stmt->execute();
        foreach ($dataset->get_rows() as &$datarow) {
          $this->add_datarow($type, $dataset->get_label(), $datarow);
        }
      }
      else {
        trigger_error('Connection error: ' . $this->mysqli->error);
      }
    }
  }
?>
