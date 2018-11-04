<?php

class Model {
    protected $_dbHandle;
    protected $_table;

    //Koneksi ke database
    public function connect() {
        $this->_dbHandle = new PDO(DB_XX, DB_USER, DB_PASSWORD);
        
        try {
            new PDO(DB_XX, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            echo "Koneksi ke database gagal: " .$e->getMessage();
        }
    }

    public function query($query) {
        return $this->_dbHandle->query($query);
    }

    public function getResult($pdoQuery) {
        $data = array();
        foreach ($pdoQuery as $row) {
            array_push($data, $row);
        }

        return $data;
    }

    public function getRows($pdoQuery) {
        $res = $this->_dbHandle->prepare($pdoQuery);
        $res->execute();
        $numRows = $res->fetchColumn();

        return $numRows;
    }

    public function selectAll($orderyBy = '', $order='ASC', $limit = '') {
        $query = "SELECT * FROM ".$this->_table;
        if ($orderyBy != '') $query .= " ORDER BY $orderyBy $order";
        if ($limit != '') $query .= " LIMIT $limit";
        return $this->query($query);
    }

    public function selectWhere($condition = '', $orderBy = '', $order = 'ASC', $limit = '') {
        $query = "SELECT * FROM ".$this->_table;
        if (is_array($condition)) {
            $query .= " WHERE";
            foreach ($condition as $key => $val) {
                $query .= " $key='$val' AND";
            }
            $query = substr($query, 0, -3);
        }

        if ($orderBy != '') $query .= " ORDER BY $orderBy $order";
        if ($limit != '') $query .= " LIMIT $limit";

        return $this->query($query);
    }

    public function selectLike($conditions = '', $orderBy = '', $order = 'ASC', $limit = '') {
        $query = "SELECT * FROM ".$this->_table;
        if (is_array($conditions)) {
            $query .= " WHERE";
            foreach ($conditions as $key => $val) {
                $query .= " $key LIKE '$val' OR";
            }
            $query = substr($query, 0, -2);
        }

        if ($orderyBy != '') $query .= " ORDER BY $orderyBy $order";
        if ($limit != '') $query .= " LIMIT $limit";

        return $this->query($query);
    }

    public function selectJoin($tables, $join = "JOIN", $params, $condition = '', $orderBy='', $order="ASC", $limit = '') {
        $query = "SELECT * FROM ".$this->_table;
        if (is_array($tables)) {
            foreach ($tables as $table) {
                $query .= " $join $table";
            }
        }else $query .= " $join $tables";

        foreach ($params as $key => $val) {
            $query .= " ON $key = $val";
        }

        if (is_array($conditions)) {
            $query .= " WHERE";
            foreach ($conditions as $key => $val) {
                $query .= " $key='$val' AND";
            }
            $query = substr($query, 0, -3);
        }

        if ($orderyBy != '') $query .= " ORDER BY $orderyBy $order";
        if ($limit != '') $query .= " LIMIT $limit";

        return $this->query($query);
    }

    public function delete($conditions = '') {
        $query = "DELETE FROM ".$this->_table;

        if (is_array($conditions)) {
            $query .= " WHERE";
            foreach ($conditions as $key => $val) {
                $query .= " $key='$val' AND";
            }
            $query = substr($query, 0, -3);
        }

        return $this->query($query);
    }

    public function insert($data) {
        $query = "INSERT INTO ".$this->_table." SET";
        foreach ($data as $key => $val) {
            $query .= " $key = '$val',";
        }
        $query = substr($query, 0, -1);
        echo $query;
        return $this->query($query);
    }

    public function update($data, $conditions = '') {
        $query = "UPDATE ".$this->_table." SET";
        foreach ($data as $key => $val) {
            $query .= " $key = '$val',";
        }
        $query = substr($query, 0, -1);
        
        if (is_array($conditions)) {
            $query .= " WHERE";
            foreach ($conditions as $key => $val) {
                $query .= " $key = '$val' AND";
            }
            $query = substr($query, 0, -3);
        }

        

        return $this->query($query);
    }
}

?>