<?php
session_start();
    if(isset($_POST['submit'])){
        $userID = $_SESSION['user'];
        $file = $_FILES['profileimg'];        
        $fileName = $_FILES['profileimg']['name'];
        $fileTmpName = $_FILES['profileimg']['tmp_name'];  //tmp (temporary)file location
        $fileSize = $_FILES['profileimg']['size'];
        $fileError = $_FILES['profileimg']['error'];
        $fileType = $_FILES['profileimg']['type'];
        
        $fileExt = explode('.', $fileName);        //create variable
        $fileActualExt = strtolower(end($fileExt)); //string-to-lower case function to remove caps before checking file
        
        $allowed = array('jpeg','jpg','png','pdf'); //statement to set allowed file extensions
        //to check if file extension insde variable: $fileActualExt is true
        if(in_array($fileActualExt, $allowed)){     //tell function what to check for from variable
            if($fileError === 0){                   //to check if there was file uplaod error
                if($fileSize < 5000000){            //condition to set file size below 5 megabytes 
                    $newFileName = "img-profile".mt_rand()."_".$fileActualExt;      //new variable to prevent image overwrite with unique id generated for each file
                    $fileDestinedPath = 'Uploader/'.$newFileName;            //proceed to upload file to folder  
                    //$uploadDir = $fileDestinedPath . basename($_FILES['profileimg']['name']);
                    //if(!is_dir($uploadDir)){
                    //    mkdir($uploadDir, 0777,true);
                    //}
                    if(move_uploaded_file($fileTmpName, $fileDestinedPath)){
                        $conn = new mysqli("localhost", "root", "", "profileuploader");
                        //Check connection
                        if($conn->connect_error){
                            die("Connection failed: " . $conn->connect_error);
                        }
                        //Insert into database table column
                        $query = "UPDATE xpgusers SET user_image = '$newFileName' WHERE `Username` = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("s", $userID);
                        $stmt->execute();
                        $stmt->close();
                        $conn->close();
                        header("Location: Myprofile-xpg_source-code.php?successful!");
                    }else{
                        echo "<script>alert('Failed to upload image');</script>";
                    }
                } else{//ELSE, throw error at user if file exceeds limit...
                    echo "File may be too large. Limit: 5mb";
                }
            } else{//ELSE, throw error at user if upload fails...
                echo "<script>alert('Mhm...there seem to be a problem updating profile, try again.');</script>";
            }
        } else{//ELSE, throw error at user for invalid file type...
            echo "<script>alert('File of this extension is invalid');</script>";
        } 
    }
    
?>
