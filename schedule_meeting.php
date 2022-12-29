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
    $m_id = $tea->make_meeting($_POST['date']);
    // echo $m_id;
    if($m_id != -1){
        $arr = explode(',',$_POST['ids']);
        // print_r($arr);
        $tea->schedule_meeting($m_id,$arr);
    }else{
        header("Location: schedule_meeting.php?error");
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
        </div>
        <div class="forma">
            <table>
                <tr>
                    <th>id</th>
                    <th>fname</th>
                    <th>lname</th>
                </tr>
                <?php
                $sql = "SELECT id,fname,lname FROM users WHERE type=1;";
                $res = mysqli_query($conn,$sql);
                if(!empty($res) && $res->num_rows > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<tr> <td>".$row['id']."</td><td>".$row['fname']."</td><td>".$row['lname']."</td></tr>";
                    }
                }else{
                    echo "<tr><td>No Parents</td></tr>";
                }
                ?>
            </table>
            <h1>Schedule meeting</h1>
            <br>
            <form action="" method="post">
                Meeting's Date<input type="date" name="date" required><br>
                Parent's IDs (comma seperated) <input type="text" name="ids" required><br>
                <input type="submit" name="submit" id="button">
            </form>
        </div>
    </body>
</html>