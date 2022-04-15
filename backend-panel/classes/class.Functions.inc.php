<?php

/**
 * Design & Developed By Gaurav Sharma ( Fantasy Info )
 * Hire me online : https://www.freelancer.in/u/fantasyinfo
 * Checkout my website: https://fantasyinfo.in/
 * Checkout my youtube channel: https://www.youtube.com/c/FantasyInfo/
 */



/**
 * including database class
 */
require_once('class.Database.inc.php');

/**
 * creating functions class for all CRUD system
 */
class Functions extends Database
{
    private $tableName  = '';
    private $student_id = '';
    private $messageArr = array();

    /**
     * insert function
     *
     * @param string $tableName enter table name
     * @param array $params paramertsers in array with key value pairs
     * @return void return the true or false
     */
    public function insert($tableName = "", $params = array())
    {
        if (!empty($tableName) && !empty($params)) {


            $this->tableName = $tableName;

            $keys   = array_keys($params);
            $values = array_values($params);

            // $data = array();

            $keys   =  implode(', ', $keys);
            $values =  implode("','", $values);

            $sql    = 'INSERT INTO ' . $this->tableName . ' (' . $keys . ') VALUES (' . "'$values'" . ') ';

            if ($this->conn->exec($sql)) {
                return true;
            } else {
                return false;
            }
        }
    }


    /**
     * udpate student function
     *
     * @param string $tableName
     * @param array $params
     * @param string $student_id
     * @return void
     */
    public function update($tableName = "", $params = array(), $student_id = "")
    {
        if (!empty($tableName) && !empty($params) && !empty($student_id)) {


            $this->tableName    = $tableName;
            $this->student_id   = $student_id;

            $keys               = array_keys($params);
            $values             = array_values($params);


            $combine = "";
            for ($i = 0; $i < count($params); $i++) {
                $combine .= "$keys[$i] = " . "'$values[$i]'" . " , ";
            }
            $combine = rtrim($combine, ' , ');


            $sql = 'UPDATE ' . $this->tableName . ' SET ' . $combine . ' WHERE id = ' . $this->student_id . ' ';

            if ($this->conn->exec($sql)) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function showAllData($tableName = "")
    {
        if (!empty($tableName)) {

            $this->tableName = $tableName;

            $sql             = 'SELECT * FROM ' . $this->tableName . '';
            $stmt            = $this->conn->query($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $totalResults    =  $stmt->rowCount();
            $row = array();
            if ($totalResults > 0) {
                $row     = $stmt->fetchAll();
            }
            return $row;
        }
    }

    public function sqlData($sql)
    {
        if (!empty($sql)) {
            $sql             = $sql;
            $stmt            = $this->conn->query($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $totalResults    =  $stmt->rowCount();
            $row = array();
            if ($totalResults > 0) {
                $row     = $stmt->fetchAll();
            }
            return $row;
        }
    }


    public function showSingleData($tableName = "", $student_id = "")
    {
        if (!empty($tableName)) {

            $this->tableName    = $tableName;
            $this->student_id   = $this->sanitizeInput($student_id);
            $sql    = 'SELECT * FROM ' . $this->tableName . ' WHERE id = ' . $this->student_id . '';
            $stmt   = $this->conn->query($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $totalResults =  $stmt->rowCount();
            $newArr = array();
            if ($totalResults > 0) {
                $row     = $stmt->fetch();
                return $row;
            }
        }
    }


    public function deleteData($tableName = "", $student_id = "")
    {
        if (!empty($tableName)) {
            $this->tableName    = $tableName;
            $this->student_id   = $this->sanitizeInput($student_id);
            $sql    = 'DELETE FROM ' . $this->tableName . ' WHERE id = ' . $this->student_id . '';
            $stmt   = $this->conn->query($sql);
            $stmt->execute();
            return true;
        }
    }


    public function paginationResult($tableName = "", $limit = null)
    {
        $page = 1;
        $offset = 0;
        $this->tableName = $tableName;

        $totalSTMT = $this->conn->prepare("SELECT * FROM $this->tableName");
        $totalSTMT->execute();
        $totalRecord = $totalSTMT->rowCount();
        $totalPages = ceil($totalRecord / $limit);


        if (isset($_GET['page'])) {
            if ($_GET['page'] <= 1) {
                $_GET['page'] = 1;
            }

            if ($_GET['page'] > $totalPages) {
                $_GET['page'] = $totalPages;
            }
            $page = $this->sanitizeInput($_GET['page']);
        }

        $offset = ($page - 1) * $limit;

        $sql = "SELECT * FROM $this->tableName ";

        if ($limit != null) {
            $sql .= " LIMIT $offset, $limit";
        }


        $stmt =  $this->conn->prepare($sql);
        if ($stmt->execute()) {
            $data =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            array_push($this->messageArr, $this->pushArr(200, 'Data Found', $data));
        } else {
            array_push($this->messageArr, $this->pushArr(404, 'Data Not Found!! Error'));
        }
    }



    public function showPagination($tableName = "", $limit = null)
    {
        // $this->tableName = $tableName;
        // $totalSTMT = $this->conn->prepare("SELECT * FROM $this->tableName");
        // $totalSTMT->execute();
        // $totalRecord = $totalSTMT->rowCount();

        // for($i = 1; $i < $totalRecord; $i++)
        // {

        // }
    }


    public function validateLogin($tableName = "", $email_id = "", $pass_word = "")
    {
        $this->tableName = $tableName;

        $email_sql = "SELECT pass_word FROM " . $this->tableName . " WHERE email_id =  '$email_id'";

        $stmt_email = $this->conn->prepare($email_sql);
        if ($stmt_email->execute()) {
            if ($stmt_email->rowCount() == 1) {

                $data = $stmt_email->fetch(PDO::FETCH_ASSOC);
                $pass_hash = $data['pass_word'];
            } else {
                // password not email not match
                return false;
            }
        }
        password_verify($pass_word, $pass_hash);
        $sql = "SELECT * FROM " . $this->tableName . " WHERE email_id = '" . $email_id . "' AND pass_word = '" . $pass_hash . "'";


        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            $userdata = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($userdata)) {
                $this->setSession('email_id', $email_id);
                return true;
            }
        } else {
            return false;
        }
    }





    /**
     * showMessage function return the json object with message, 
     *
     * @return void
     */
    public function showMessage()
    {
        echo json_encode($this->messageArr);
    }

    /**
     * sanitizing the cooming data from user function
     *
     * @param string / integer $input
     * @return void
     */
    public function sanitizeInput($input)
    {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    /**
     * pushing the error or success msg with data and status code function
     *
     * @param string $code
     * @param string $msg
     * @param array $data (optional)
     * @return void
     */
    public function pushArr($code = "", $msg = "", $data = array())
    {

        $pushArr =  array('status' => $code, 'message' => $msg);

        if (!empty($data)) {
            $pushArr['data'] = $data;
        }
        return $pushArr;
    }

    public function setSession($session_name, $session_value)
    {
        if (!empty($session_name) && !empty($session_value)) {

            $_SESSION[$session_name] = $session_value;
        }
    }

    public function unsetSession($session_name)
    {
        if (!empty($session_name)) {

            unset($_SESSION[$session_name]);
        }
    }
}