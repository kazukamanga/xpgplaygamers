<?php
class LoggedinUser{
    private $email;
    private $username;
    private $password;
    public $wrong;
    public $incorrect;
    private $xpg_database = "XPG-Userstorage.json";
    private $user_storage;

    public function __construct($email, $username, $password)
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->user_storage = json_decode(file_get_contents($this->xpg_database), true);
        $this->userLogin();
    }

    private function userLogin(){
        foreach($this->user_storage as $user){
            if($user['Email'] == $this->email){
                if($user['Username'] == $this->username){
                    if(password_verify($this->password, $user['Password'])){
                        session_start();
                        $_SESSION['user'] = $this->username;
                        header("location: index.php"); exit();
                    }
                }
            }
            
        }
        return $this->wrong = "Wrong Username or Password";
    }
}