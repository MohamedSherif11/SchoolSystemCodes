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
    if($tea->write_comment($_POST['c_id'],$_POST['comment'])){
        header('Location: comment.php?success');
    }else{
        header('Location: comment.php?error');
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
        </div>
        <div class="forma">
            <table>
                <tr>
                    <th>ID</th>
                    <th>fname</th>
                    <th>lname</th>
                    <th>pic</th>
                </tr>
                <?php
                $sql = "SELECT * FROM child;";
                $res = mysqli_query($conn,$sql);
                if(!empty($res) && $res->num_rows > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<tr> <td>".$row['id']."</td><td>".$row['fname']."</td><td>".$row['lname']."</td><td><img width=\"50px\" src=\"../uploads/".$row['pic']."\" /></td></tr>";
                    }
                }else{
                    echo "<tr><td>No Students</td></tr>";
                }
                ?>
            </table>
            <h1>Add Student Comment</h1>
            <br>
            <form action="" method="post">
                Student ID<input type="text" name="c_id" required><br>
                Comment<input type="text" name="comment" required><br>
                <input type="submit" name="submit" id="button">
            </form>
        </div>
    </body>
</html>