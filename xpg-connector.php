<?php 
if(isset($_POST['submit'])){
    $conn = new mysqli("localhost", "root", "", "profileuploader");

    //Check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $json_file = file_get_contents("XPG-Userstorage.json");
    $userinvite = json_decode($json_file, JSON_OBJECT_AS_ARRAY);
    //Prepare and bind the statment
    $stmt = $conn->prepare("INSERT INTO xpginvitees (`Firstname`, `Lastname`, `Birthday`, `Age`, `Birth Country`, `Gender`, `Email`, `Username`, `Password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $row_insert = 0;
    //Iterate through JSON data and insert into database
    foreach ($userinvite as $invite){
        //Check if username already exists to prevent duplication
        $existQuery = "SELECT COUNT(*) FROM xpginvitees WHERE Username = ?";
        $existStmnt = $conn->prepare($existQuery);
        $existStmnt->bind_param("s", $invite['Username']);
        $existStmnt->execute();
        $existStmnt->bind_result($count);
        $existStmnt->fetch();
        $existStmnt->close();
        
        if($count == 0){
            //User does not exisit insert data
            $firstname = $invite['Firstname'];
            $lastname = $invite['Lastname'];
            $birth = $invite['Birthday'];
            $aging = $invite['Age'];
            $country = $invite['Birth Country'];
            $gender = $invite['Gender'];
            $email = $invite['Email'];
            $username = $invite['Username'];
            $password = $invite['Password'];
            //Bind parameterd
            $stmt->bind_param("ssdisssss", $firstname, $lastname, $birth, $aging, $country, $gender, $email, $username, $password);  //"ss" indicates 2 string parameters
            //Execute the statement
            if($stmt->execute() === true){
                $row_insert++;
            }else{
                echo "JSON decode/parse failed: " . $stmt->error;
            }
            //Reset parameter bindings for the next iteration
            $stmt->reset();
        }
    }
    //Close the MySQL connection
    $stmt->close();
    $conn->close();
    }
?>