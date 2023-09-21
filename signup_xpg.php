<?php 
class RegisterUser{
    //Class properties
    private $firstname;
    private $lastname;
    private $birth;
    private $aging;
    private $country;
    private $gender;
    private $email;
    private $username;
    private $password;
    private $password_encrypt;
    private $xpg_database = "XPG-Userstorage.json";
    private $user_storage;
    public $error;
    public $invalid;
    public $confirmed;
    private $new_comer;
    
    public function __construct($firstname, $lastname, $birth, $aging, $country, $gender, $email, $username, $password){
        //Sanitize and vailidate user input
        $this->firstname = trim($this->firstname);
        $this->firstname = filter_var($firstname, FILTER_SANITIZE_STRING);

        $this->lastname = trim($this->lastname);
        $this->lastname = filter_var($lastname, FILTER_SANITIZE_STRING);

        $this->birth = trim($this->birth);
        $this->birth = filter_var($birth, FILTER_SANITIZE_STRING);

        $this->aging = trim($this->aging);
        $this->aging = filter_var($aging, FILTER_SANITIZE_STRING);

        $this->country = trim($this->country);
        $this->country = filter_var($country, FILTER_SANITIZE_STRING);

        $this->gender = trim($this->gender);
        $this->gender = filter_var($gender);

        $this->email = trim($this->email);
        $this->email = filter_var($email, FILTER_SANITIZE_STRING);

        $this->username = trim($this->username);
        $this->username = filter_var($username, FILTER_SANITIZE_STRING);

        $this->password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        $this->password_encrypt = password_hash($this->password, PASSWORD_DEFAULT);

        $this->user_storage = json_decode(file_get_contents($this->xpg_database), true);//converts json array to php string

        $this->new_comer = [
            "Firstname" => $this->firstname,
            "Lastname" => $this->lastname,
            "Birthday" => $this->birth,
            "Age" => $this->aging,
            "Birth Country" => $this->country,
            "Gender" => $this->gender,
            "Email" => $this->email,
            "Username" => $this->username,
            "Password" => $this->password_encrypt,
        ];

        if($this->checkingFieldInsert()){
            $this->UserInsertion();
        }
    }


    private function checkingFieldInsert(){
        if (empty($this->username) || empty($this->password)){
            $this->error = "Both Username and Password are required.";
            return false;
        }else{
            return true;
        }
    }

    private function userExistence(){
        foreach($this->user_storage as $user){
            if($this->username == $user['Username']){
                $this->invalid = "We remember this username, please use one unique to you.";
                return true;
            }
        }
        return false;
    }

    private function UserInsertion(){
        if($this->userExistence() == false){
            array_push($this->user_storage, $this->new_comer);
            if(file_put_contents($this->xpg_database, json_encode($this->user_storage, JSON_PRETTY_PRINT))){ 
                //converts data to json string and write to file
                return $this->confirmed = "Registration Success!";   
            }else{
                return $this->error = "Something went wrong, please try again";
            }
        }
    }
    
}


