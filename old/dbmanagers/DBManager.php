<?php
header('Content-Type: text/html; charset=UTF-8'); 


error_reporting(0);

class DBManager {

    var $dbName;
    var $server;
    var $user;
    var $password;
    var $port;
    var $databaseLink;
    // Base variables
    var $lastError;     // Holds the last error
    var $lastQuery;     // Holds the last query
    var $result;      // Holds the MySQL query result
    var $records;      // Holds the total number of records returned
    var $affected;     // Holds the total number of records affected
    var $rawResults;    // Holds raw 'arrayed' results
    var $arrayedResult;   // Holds an array of the result

//parametros de conexion

    public function DBManager() {
        $this->dbName = "grupolog_app";
        $this->server = "localhost";
        $this->user = "grupolog_app";
        $this->password = "poiu0987";
        $this->port = "";
        $this->connect();
    }

//conexion a la bd
    protected function connect($persistant = false) {
        $this->closeConnection();

        if ($persistant) {
            $this->databaseLink = mysql_pconnect($this->server, $this->user, $this->password);
        } else {
            $this->databaseLink = mysql_connect($this->server, $this->user, $this->password);
        }

        if (!$this->databaseLink) {
            $this->lastError = 'No se puede conectar con el servidor: ' . mysql_error($this->databaseLink);
            echo 'e ' . mysql_error($this->databaseLink);
            return false;
        }

        if (!$this->setDB()) {
            $this->lastError = 'No se puede conectar con la db: ' . mysql_error($this->databaseLink);
            echo 'e ' . mysql_error($this->databaseLink);
            return false;
        }

        return true;
    }

// Selecciona la base de datos que va a utilizar
    private function setDB() {
        if (!mysql_select_db($this->dbName, $this->databaseLink)) {
            $this->lastError = 'No se puede usar la db: ' . mysql_error($this->databaseLink);
            return false;
        } else {
            return true;
        }
    }

    private function SecureData($data) {
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                if (!is_array($data[$key])) {
                    $data[$key] = mysql_real_escape_string($data[$key], $this->databaseLink);
                }
            }
        } else {
            $data = mysql_real_escape_string($data, $this->databaseLink);
        }
        return $data;
    }

//ejecucion de consulta
    public function executeQuery($query = "") {
	
        $this->lastQuery = $query;
        if ($this->result = mysql_query($query, $this->databaseLink)) {
            $this->records = @mysql_num_rows($this->result);
            $this->affected = @mysql_affected_rows($this->databaseLink);

            if ($this->records > 0) {
                $this->ArrayResults();
                return $this->arrayedResult;
            } else {
                return true;
            }
        } else {
            $this->lastError = mysql_error($this->databaseLink);
           echo $this->lastError ;
            return false;
        }
    }

    // Adds a record to the database based on the array key names
    function Insert($vars, $table, $exclude = '') {

        // Catch Exclusions
        if ($exclude == '') {
            $exclude = array();
        }

        array_push($exclude, 'MAX_FILE_SIZE'); // Automatically exclude this one
        // Prepare Variables
        $vars = $this->SecureData($vars);

        $query = "INSERT INTO `{$table}` SET ";
        foreach ($vars as $key => $value) {
            if (in_array($key, $exclude)) {
                continue;
            }
            //$query .= '`' . $key . '` = "' . $value . '", ';
            $query .= "`{$key}` = '{$value}', ";
        }

        $query = substr($query, 0, -2);
       
        return $this->executeQuery($query);
    }

    // Deletes a record from the database
    function Delete($table, $where = '', $limit = '', $like = false) {
        $query = "DELETE FROM `{$table}` WHERE ";
        if (is_array($where) && $where != '') {
            // Prepare Variables
            $where = $this->SecureData($where);

            foreach ($where as $key => $value) {
                if ($like) {
                    //$query .= '`' . $key . '` LIKE "%' . $value . '%" AND ';
                    $query .= "`{$key}` LIKE '%{$value}%' AND ";
                } else {
                    //$query .= '`' . $key . '` = "' . $value . '" AND ';
                    $query .= "`{$key}` = '{$value}' AND ";
                }
            }

            $query = substr($query, 0, -5);
        }

        if ($limit != '') {
            $query .= ' LIMIT ' . $limit;
        }
       
        return $this->executeQuery($query);
    }

    // Gets a single row from $from where $where is true
    function Select($from, $where = '', $orderBy = '', $limit = '', $like = false, $operand = 'AND', $cols = '*') {
        // Catch Exceptions
        if (trim($from) == '') {
            return false;
        }

        $query = "SELECT {$cols} FROM `{$from}` WHERE ";

        if (is_array($where) && $where != '') {
            // Prepare Variables
            $where = $this->SecureData($where);

            foreach ($where as $key => $value) {
                if ($like) {
                    //$query .= '`' . $key . '` LIKE "%' . $value . '%" ' . $operand . ' ';
                    $query .= "`{$key}` LIKE '%{$value}%' {$operand} ";
                } else {
                    //$query .= '`' . $key . '` = "' . $value . '" ' . $operand . ' ';
                    $query .= "`{$key}` = '{$value}' {$operand} ";
                }
            }

            $query = substr($query, 0, -(strlen($operand) + 2));
        } else {
            $query = substr($query, 0, -6);
        }

        if ($orderBy != '') {
            $query .= ' ORDER BY ' . $orderBy;
        }

        if ($limit != '') {
            $query .= ' LIMIT ' . $limit;
        }

        return $this->executeQuery($query);
    }

    // Updates a record in the database based on WHERE
    function Update($table, $set, $where, $exclude = '') {
        // Catch Exceptions
        if (trim($table) == '' || !is_array($set) || !is_array($where)) {
            return false;
        }
        if ($exclude == '') {
            $exclude = array();
        }

        array_push($exclude, 'MAX_FILE_SIZE'); // Automatically exclude this one

        $set = $this->SecureData($set);
        $where = $this->SecureData($where);

        // SET

        $query = "UPDATE `{$table}` SET ";
      
        foreach ($set as $key => $value) {
            if (in_array($key, $exclude)) {
                continue;
            }
            $query .= "`{$key}` = '{$value}', ";
        }

        $query = substr($query, 0, -2);

        // WHERE

        $query .= ' WHERE ';

        foreach ($where as $key => $value) {
            $query .= "`{$key}` = '{$value}' AND ";
        }

        $query = substr($query, 0, -5);

        return $this->executeQuery($query);
    }

    // 'Arrays' a single result
    function ArrayResult() {
        $this->arrayedResult = mysql_fetch_assoc($this->result) or die(mysql_error($this->databaseLink));
        return $this->arrayedResult;
    }

    // 'Arrays' multiple result
    function ArrayResults() {
        /*
          if ($this->records == 1) {
          return $this->ArrayResult();
          } */

        $this->arrayedResult = array();
        while ($data = mysql_fetch_assoc($this->result)) {
            $this->arrayedResult[] = array_map('utf8_encode', $data);;
        }
        
        return $this->arrayedResult;
    }

    // 'Arrays' multiple results with a key
    function ArrayResultsWithKey($key = 'id') {
        if (isset($this->arrayedResult)) {
            unset($this->arrayedResult);
        }
        $this->arrayedResult = array();
        while ($row = mysql_fetch_assoc($this->result)) {
            foreach ($row as $theKey => $theValue) {
                $this->arrayedResult[$row[$key]][$theKey] = $theValue;
            }
        }
        return $this->arrayedResult;
    }

    // Returns last insert ID
    function LastInsertID() {
        return mysql_insert_id();
    }

    // Return number of rows
    function CountRows($from, $where = '') {
        $result = $this->Select($from, $where, '', '', false, 'AND', 'count(*)');
        return $result["count(*)"];
    }

    // Closes the connections
    function closeConnection() {
        if ($this->databaseLink) {
            mysql_close($this->databaseLink);
        }
    }

}

?>