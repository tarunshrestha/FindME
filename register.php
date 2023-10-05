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
    $namecheckquery = "SELECT username FROM players WHERE username = '" . $username . "'";

    $namecheck = mysqli_query($con , $namecheckquery ) or die("2 = Name check query fail"); // error code 2 = name query fail

    if(mysqli_num_rows($namecheck) > 0)
    {
        echo "3 = name exist";// error code 3 = name already exists
        exit();
    }

    //add user table
    $salt = "\$5\$rounds=1000\$" . "steamedhams".$username . "\$";
    $hash = crypt($password, $salt);
    $insertuserquery = "INSERT INTO players(username , hash , salt) VALUES('" . $username . "','" . $hash . "','" . $salt . "')";
    mysqli_query($con , $insertuserquery) or die ("4 = Insert player query failed");

    echo ("0");


?>