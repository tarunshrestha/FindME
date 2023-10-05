<?php
$con = mysqli_connect('localhost', 'root', '', 'findme');
//check connection
if (mysqli_connect_error()) {
    echo "1 = Connection fail"; //error code 1 = connection failed
    exit();
}

$username = $_POST["name"];
$score = $_POST["score"];

//user name check
$namecheckquery = "SELECT username FROM players WHERE username = '" . $username . "';";

$namecheck = mysqli_query($con, $namecheckquery) or die("2 = Name check query fail"); // error code 2 = name query fail

if (mysqli_num_rows($namecheck) != 1) {
    echo "5 = User doesn't exists..."; // error code 3 = name already exists
    exit();
}

//add user table

$updatequery = "UPDATE players SET score = '" . $score . "' WHERE username = '" . $username . "';";
$insertuserquery = "INSERT INTO players(username , hash , salt) VALUES('" . $username . "','" . $hash . "','" . $salt . "')";

//$updatequery = "UPDATE players SET score= " . $score . "WHERE username = '" . $username . "';";
mysqli_query($con, $updatequery) or die("7:Save query failed"); //error code #7 - Update querry fail
echo "0";
