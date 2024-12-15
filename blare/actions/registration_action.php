<?php

class Signup
{

    private $error = "";
    public function evaluate($data)
    {

        foreach ($data as $key => $value) {

            if(empty($value))
            {
                $this->error = $this->error .  $key . " is empty!<br>";
            }
            if($key == "name")
            {
                if (is_numeric($value)) {

                $this->error = $this->error .  " name cant be a number<br>";
                }
            }
            if($key == "username")
            {
                if (is_numeric($value)) {

                $this->error = $this->error .   " username cant be a number<br>";
                }
            }
        }
        if($this->error == "")
        {

            $this->create_user($data);
        }else
        {
            return $this->error;
        }
    }
    public function create_user($data)
    {
        $name     = ucfirst($data['name']);
        $username = ucfirst($data['username']);
        $password = password_hash($data['password'], PASSWORD_DEFAULT); 

        
        $url_address = strtolower($name) ;
        $userid = $this->create_userid();

        $query = "insert into users 
        (userid,name,username,password,url_address) 
        VALUES 
        ('$userid','$name','$username','$password','$url_address')";

        
       $DB = new Database();
       $DB->save($query);
    }

    private function create_userid()
    {

        $length = rand(4,19);
        $number = "";
        for ($i=0; $i < $length; $i++) {

            $new_rand = rand(0,9);

            $number = $number . $new_rand;
        }

        return $number;
    }

}