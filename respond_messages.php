<?php
require_once("../classes/conn.php");
require_once("../classes/teacher.php");
session_start();
if(!isset($_SESSION['user'])){
    header('Location: ../index.php');
}else if($_SESSION['type']!='2'){
    header('Location: ../index.php');
}
$tea = unserialize($_SESSION['user']);
$tea->conn = $conn;
if(isset($_POST['submit'])){
    // print_r($_POST);
    if($tea->send_message($_POST['to'],$_POST['text'])){
        header('Location: respond_messages.php?success');
    }else{
        header('Location: respond_messages.php?error');
        // echo "error";
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
            <form action="index.php" method="get" >
                <input type="submit" value="Home" id="button1">
            </form>
            <div class=forma>
                <h2>Show Feedbacks!</h2>
            <table border="2px">
                <tr>
                    <th>parent id</th>
                    <th>fname</th>
                    <th>lname</th>
                    <th>Message</th>
                    <th>Time sent</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM messages WHERE to_user=".$tea->id." ORDER BY time DESC;";
                    $res = mysqli_query($conn,$sql);
                    if(!empty($res) && $res->num_rows > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $sql2 = "SELECT fname,lname FROM users WHERE id=".$row['from_user']." ;";
                            $res2 = mysqli_query($conn,$sql2);
                            if(!empty($res) && $res->num_rows > 0){
                                while($row2 = mysqli_fetch_assoc($res2)){
                                    echo "<tr><td>".$row['from_user']."</td><td>".$row2['fname']."</td><td>".$row2['lname']."</td><td>".$row['text']."</td><td>".$row['time']."</td></tr>"; 
                                }
                            }
                        }
                    }else{
                        echo "<tr><td>No Feedbacks</td></tr>";
                    }
                ?>
            </table>
            <form action="" method="POST">
                <br><br><br>
                To Parent ID<input type="text" name="to"><br>
                Text <input type="text" name="text"><br>
                <input type="submit" name="submit">
            </form>
            </div>
        </div>
    </body>
</html>