<?php
/**
 * Class todo
 */
require_once 'Database.php';
/**
 * Class TodoList
 */
class TodoList
{
    private $pdo;
    
    /**
     * Database connection
     */
    public function __construct()
    {
        $database = new Database();
        $dbConnection = $database->dbConnection();
        $this->pdo = $dbConnection;
    }
    /**
     * Will insert data into database
     *
     * @param string $table
     * @param array $fields
     *
     * @return void
     */
    public function insert($table, $fields)
    {
        try {
            $this->pdo->beginTransaction();
            if (!empty($fields) && is_array($fields)) {
                $keys = '';
                $values = '';
                $keys = implode(',', array_keys($fields));
                $values = ':'. implode(', :', array_keys($fields));
                $sql = 'INSERT INTO ' . $table . '('. $keys . ')  VALUES (' . $values . ')';
                $query = $this->pdo->prepare($sql);
                foreach ($fields as $key => $value) {
                    $query->bindValue(":$key", $value);
                }
                $insertedStatus = $query->execute();
                if ($insertedStatus) {
                    $lastId = $this->pdo->lastInsertId();
                    $this->pdo->commit();
                    return $lastId ? true : false;
                }
            }
        } catch (PDOException $exception) {
            $this->pdo->rollBack();
            echo  $exception->getMessage();
        }
    }

    /**
     * Will select data from database
     *
     * @param string $table
     * @param array  $data
     *
     * @return void
     */
    public function select($table, $data = [])
    {
        try {
            $this->pdo->beginTransaction();
            $sql = 'SELECT ';
            $sql .= array_key_exists('select', $data) ? $data['select'] : '*';
            $sql .= ' FROM ' . $table;
            if (array_key_exists('where', $data)) {
                $sql .= ' WHERE ';
                $initiator = 0;
                foreach ($data['where'] as $key => $value) {
                    $add = ($initiator > 0) ? ' AND ' : '';
                    $sql .= "$add" . "$key=:$key";
                    ++$initiator;
                }
            }

            if (array_key_exists('order_by', $data)) {
                $sql .= ' ORDER BY ' . $data['order_by'];
            }

            if (array_key_exists('start', $data) && array_key_exists('limit', $data)) {
                $sql .= ' LIMIT ' . $data['start'] . ',' . $data['limit'];
            } elseif (array_key_exists('start', $data) && array_key_exists('limit', $data)) {
                $sql .= ' LIMIT ' . $data['limit'];
            } elseif (array_key_exists('limit', $data)) {
                $sql .= ' LIMIT ' . $data['limit'];
            }
            $query = $this->pdo->prepare($sql);
            if (array_key_exists('where', $data)) {
                foreach ($data['where'] as $key => $value) {
                    $query->bindValue(":$key", $value);
                }
            }
            $query->execute();
            if (array_key_exists('return_type', $data)) {
                switch ($data['return_type']) {
                case 'count':
                    $value = $query->rowCount();
                    break;
                case 'single':
                    $value = $query->fetch(PDO::FETCH_OBJ);
                    break;
                default:
                    $value = '';
                    break;
                }
            } else {
                if ($query->rowCount() > 0) {
                    $value = $query->fetchAll(PDO::FETCH_OBJ);
                }
            }
            $this->pdo->commit();
            return !empty($value) ? $value : false;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo 'ERROR !!! ' . $e->getMessage();
        }
    }

    /**
    * Will update data in database
    *
    * @param string $table
    * @param array  $data
    * @param array  $cond
    *
    * @return void
    */
    public function updateWithoutPhoto($table, $data, $cond)
    {
        try {
            $this->pdo->beginTransaction();
            if (!empty($data) && is_array($data)) {
                $keyValue = '';
                $whereCond = '';
                $initiator = 0;
                foreach ($data as $key => $value) {
                    $add = ($initiator > 0) ? ' , ' : '';
                    $keyValue .= "$add" . "$key=:$key";
                    ++$initiator;
                }
                if (!empty($cond) && is_array($cond)) {
                    $whereCond .= ' WHERE ';
                    $initiator = 0;
                    foreach ($cond as $key => $value) {
                        $add = ($initiator > 0) ? ' AND ' : '';
                        $whereCond .= "$add" . "$key=:$key";
                        ++$initiator;
                    }
                }
                $sql = 'UPDATE ' . $table . ' SET ' . $keyValue . $whereCond;
                $query = $this->pdo->prepare($sql);
                foreach ($data as $key => $value) {
                    $query->bindValue(":$key", $value);
                }
                foreach ($cond as $key => $value) {
                    $query->bindValue(":$key", $value);
                }
                $update = $query->execute();
                $this->pdo->commit();
                return $update ? $query->rowCount() : false;
            }
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo $e->getMessage();
        }
    }

    /**
    * Will delete data from database
    *
    * @param table $table commented
    * @param data  $data  commented
    *
    * @return void
    */
    public function delete($table, $data)
    {
        try {
            $this->pdo->beginTransaction();
            if (!empty($data) && is_array($data)) {
                $whereCond .= ' WHERE ';
                $initiator = 0;
                foreach ($data as $key => $value) {
                    $add = ($initiator > 0) ? ' AND ' : '';
                    $whereCond .= "$add" . "$key=:$key";
                    ++$initiator;
                }
            }
            $sql = 'DELETE FROM ' . $table . $whereCond;
            $query = $this->pdo->prepare($sql);
            foreach ($data as $key => $value) {
                $query->bindValue(":$key", $value);
            }
            $delete = $query->execute();
            $this->pdo->commit();
            return $delete ? true : false;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo $e->getMessage();
        }
    }
    /**
     * Will validate data
     *
     * @param string $data
     *
     * @return void
     */
    public function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
