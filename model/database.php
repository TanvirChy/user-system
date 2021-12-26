<?php
session_start();


class DatabaseConnection
{
    private static $servername = "localhost";
    private static $dbname = "user_system";
    private static $username = "root";
    private static $password = "";
    private static $con;

    // DatabaseConnection::$con->prepare()

    public  function __construct()
    {
        try {
            self::$con = new PDO(
                'mysql:host=' . self::$servername . ';' . 'dbname=' . self::$dbname,
                self::$username,
                self::$password

            );
            self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection not established " . $e->getMessage();
        }
    }

    public  function connection()
    {
        return self::$con;
    }

    public function query($sql, $data = [])
    {
        $prepareSQL = self::$con->prepare($sql);
        $prepareSQL->execute($data);
        return $prepareSQL;
    }

    public function fetch($tableName, $condition = [])
    {
        $sql = "SELECT * FROM {$tableName}";
        $arraySize = count($condition);
        if ($arraySize >= 2) {
            $whereCondition = " WHERE ";
            $dataArray = [];
            $makeSQL = '';
            foreach ($condition as $key => $value) {

                $dataArray[":{$key}"] = $value;

                $whereCondition .= " {$key} = :{$key} AND";
            }
            $finalSQL = $sql . $whereCondition . $makeSQL;
            $trimedSQL = rtrim($finalSQL, "AND");
            // var_dump($trimedSQL);
            // var_dump($dataArray);

            // $finalSQL = $sql . $whereCondition;
            $singleInfo = $this->query($trimedSQL, $dataArray);

            $results = $singleInfo->fetchAll(PDO::FETCH_ASSOC);
            // var_dump('if',$results);
        } else {
            $all = $this->query($sql);

            $results = $all->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($results);
        }


        return $results;
    }
    // $condition,
    public function fetchSingleItem($tableName,  $name, $email)
    {
        // echo $email;
        // $sql = "SELECT * FROM {$tableName} where {$condition} = :{$personInfo}";
        $condition = [
            'name' => $name,
            'email' => $email
        ];

        return $this->fetch($tableName, $condition);
    }
}
