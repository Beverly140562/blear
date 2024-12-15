<?php



class Login{

    private $error = "";

        public function evaluate($data)
    {
        $username = addslashes($data['username']);
        $password = addslashes($data['password']);

        $query = "select * from users where username = '$username' limit 1";

        
       $DB = new Database();
       $result = $DB->read($query);

       if ($result) 
       {

        $row = $result[0];

        if ($password == $row['password'])
        {
            //create session data
            $_SESSION['blare_userid'] = $row['userid'];

        }else{
            $this->error .= "wrong username or password<br>";
        }
       }else{
        
            $this->error .= "wrong username or password<br>";
       }

        return $this->error;
       
    }

    public function check_login($id)
    {

        //we put the id if its not numeric then moadto sya sa log in
        if(is_numeric($id)) 
        {
            //we read the users table
            $query = "select * from users where userid = '$id' limit 1";

            //using tha Database class in connect.php   
            $DB = new Database();
            $result = $DB->read($query);

            //if the result is good
            if ($result) 
            {
                //we direct to this row
                    $user_data = $result[0];
                    return $user_data;
            }else
            {

                //if not we direct in login page
                header("Location: login.php");
                die;
            }

            
        }else
        {
            header("Location: login.php");
            die;
        }

    }
}
