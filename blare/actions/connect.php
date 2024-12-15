<?php


class Database
{
private $host = "localhost";
private $username = "root";
private $password = "";
private $db = "blare";

function connect()
{

//connect to handle database this is the connection to pass the 4 arguments
        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        return $connection;
}
    function read($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);

        if(!$result)
        {
            return false;
        }
        else
        {
            $data = false;
            while($row = mysqli_fetch_assoc($result))
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    function save($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);

        if(!$result)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}
