<?php
require_once("classes/conn.php");
require_once("classes/manager.php");
require_once("classes/teacher.php");
require_once("classes/parent.php");
session_start();
if(isset($_SESSION['user'])){
    header('Location: index.php');
}
elseif (isset($_POST['submit'])) {
    $sql = "INSERT INTO users(email,passwd,fname,lname,type) VALUES('".$_POST['email']."','".$_POST['passwd']."','".$_POST['fname']."','".$_POST['lname']."',".$_POST['type'].");";
    if(mysqli_query($conn,$sql)){
        header('Location: login.php?signup=sucess');
    }else{
        header('Location: login.php?signup=error');
    }  
}
?>
<html>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DynaPuff&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Index.css">
    <body>
        <div class="hzh">
            <h1 data-text="PUZZLE">PUZZLE</h1>
            <form action="login.php" method="get" >
                <input type="submit" value="Login" id="button1">
            </form>
        </div>
        <div class="forma">
            <form action="" method="post">
                <h1>Register Form</h1>
                First Name<input type="text" name="fname"><br>
                Last Name<input type="text" name="lname"><br>
                Email<input type="email" name="email"><br>
                Password<input type="password" name="passwd"><br>
                Type: <br>
                Manager
                <input id="r1" type="radio" name="type" value="0"> <br>
                Parent
                <input id="r2" type="radio" name="type" value="1"> <br>
                Teacher
                <input id="r3" type="radio" name="type" value="2"> <br>
                <input type="submit" name="submit"> 
            </form>
        </div>
    </body>
</html>