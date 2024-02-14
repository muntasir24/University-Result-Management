<?php
class Functions extends Database{
    private $msg;
    private $result;

    public function checkUsername($username)
    {
        //run
        $sql = "SELECT * FROM admin WHERE username = :username";
        $this->query($sql);
        //bind value
        $this->bind(":username", $username);
        //fetch data
        $this->result = $this->fetchSingle();
        //check if data was returned
        if($this->result){
            return true;
        }else{
            return false;
        }

    }

    //password encryption
    public function Password_Encryption($password){
        //hashing technique
        $blowfish_hash_format = "$2y$12$00ok";
        $salt_length = 22;
        $salt = $this->generate_salt($salt_length);
        $formatting_blowfish_with_salt = $blowfish_hash_format.$salt;
        $hash = crypt($password, $formatting_blowfish_with_salt);
        return $hash;
    }

    //generate salt function
    public function generate_salt($length){
        $unique_random_string = md5(uniqid(mt_rand(), true));
        $base64_string = base64_encode($unique_random_string);
        $modified_base64_string = str_replace('+', '_', $base64_string);
        $salt = substr($modified_base64_string, 0, $length);
        return $salt;
    }

    //password password check
    public function password_check($password, $existing_hash){
        $hash = crypt($password, $existing_hash);
        if($hash === $existing_hash){
            return true;
        }else{
            return false;
        }
    }

    //login check

    public function loginCheck($username, $password){
        global $username;
        $sql = "SELECT * FROM admin WHERE username =:username";
        $this->query($sql);
        $this->bind(":username", $username);
        $username = $this->fetchSingle();

        if($username){
            global $existing_hash;
            $existing_hash = $username->password; //password already in database
            //check for password associated with same username
            if($this->password_check($password, $existing_hash)){
                return true;
            }else{
                return null;
            }
        }
    }

    //base url

    public function base_url()
    {
        $sql = "SELECT main_url FROM general_settings";
        $this->query($sql);
        $new_url = $this->fetchColumn()."/admin/";
        return $new_url;
    }

    public function main_url()
    {
        $sql = "SELECT main_url FROM general_settings";
        $this->query($sql);
        $new_url = $this->fetchColumn();
        return $new_url;
    }

    public function student_url()
    {
        $sql = "SELECT main_url FROM general_settings";
        $this->query($sql);
        $new_url = $this->fetchColumn()."/student/";
        return $new_url;
    }



    //Students

    public function studentLoginCheck($reg_no, $password){
        global $reg_no;
        $sql = "SELECT * FROM student WHERE reg_no =:r";
        $this->query($sql);
        $this->bind(":r", $reg_no);
        $username = $this->fetchSingle();

        if($username){
            global $existing_hash;
            $existing_hash = $username->password; //password already in database
            //check for password associated with same username
            if($this->password_check($password, $existing_hash)){
                return true;
            }else{
                return null;
            }
        }
    }

  
 




 


    //Teacher Specific Functions

    public function teacherLoginCheck($username, $password){
        global $username;
        $sql = "SELECT * FROM teachers WHERE username =:username";
        $this->query($sql);
        $this->bind(":username", $username);
        $username = $this->fetchSingle();

        if($username){
            global $existing_hash;
            $existing_hash = $username->password; //password already in database
            //check for password associated with same username
            if($this->password_check($password, $existing_hash)){
                return true;
            }else{
                return null;
            }
        }
    }






}

