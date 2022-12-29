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
    $sql = "SELECT * FROM users WHERE email='".$_POST['email']."' and passwd='".$_POST['passwd']."';";
    $res = mysqli_query($conn,$sql);
    if($res->num_rows == 1){
        while($row = mysqli_fetch_assoc($res)){
            $_SESSION['type'] = $row['type'];
            if($row['type']=='0'){
                $user = new Manager($conn);
                $user->login($row);
                $_SESSION['user'] = serialize($user);
                header('Location: index.php');
            }else if($row['type']=='1'){
                $user = new _Parent($conn);
                $user->login($row);
                $_SESSION['user'] = serialize($user);
                header('Location: index.php');
            }else if($row['type']=='2'){
                $user = new Teacher($conn);
                $user->login($row);
                $_SESSION['user'] = serialize($user);
                header('Location: index.php');
            }
        }
    }else{
        header('Location: login.php?error=no_user');
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
            <form action="signup.php" method="get" >
                <input type="submit" value="Register" id="button1">
            </form>
            <!-- <form action="LogInParents.html" method="get" >
                <input type="submit" value="Parents-Login" id="button1">
            </form>
            <form action="LoginTeacher.html" method="get" >
                <input type="submit" value="Teacher-Login" id="button1">
            </form> -->
        </div>
        <div class="forma">
            <form action="" method="post" class="forma">
                <h1>Login Form</h1>
                <p>Email</p><input type="email" name="email" id="id"><br>
                <p>Password</p><input type="password" name="passwd" id="pw"><br><br><br>
                <input type="submit" name="submit" id="button"><br>
            </form>
        </div>
    </body>
</html>