<?php
    $con = mysqli_connect('localhost','root','','findme');
    //check connection
    if(mysqli_connect_error())
    {
        echo "1 = Connection fail";//error code 1 = connection failed
        exit();
    }

    $username = $_POST["name"];
    $password = $_POST["password"];

    //user name check
    $namecheckquery = "SELECT username , salt, hash, score FROM players WHERE username = '" . $username . "'";

    $namecheck = mysqli_query($con , $namecheckquery ) or die("2 = Name check query fail"); // error code 2 = name query fail

    if(mysqli_num_rows($namecheck) != 1)
    {
        echo "5: User doesn't exists. ";// error code 3 = name already exists
        exit();
    }

    // user info
    $existinginfo = mysqli_fetch_assoc($namecheck);
    $salt = $existinginfo["salt"];
    $hash = $existinginfo["hash"];

    $loginhash = crypt($password, $salt);
    if($hash != $loginhash) 
    {
        echo "6= Incorrect password.";
    }

    echo "0\t" . $existinginfo["score"] ;



?>