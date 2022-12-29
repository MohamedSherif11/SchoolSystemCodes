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
            <h1>meeting requests</h1>
            <table border="2px">
                <tr>
                    <th>request id</th>
                    <th>from</th>
                    <th>fname</th>
                    <th>lname</th>
                </tr>
                <?php
                $sql = "SELECT id,p_id FROM requests WHERE t_id=".$tea->id.";";
                $res = mysqli_query($conn,$sql);
                if(!empty($res) && $res->num_rows > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        echo "<tr> <td>".$row['id']."</td><td>".$row['p_id']."</td>";
                        $sql2 = "SELECT fname,lname FROM users WHERE id=".$row['p_id'].";";
                        $res2 = mysqli_query($conn,$sql2);
                        if(!empty($res2) && $res2->num_rows > 0){
                            while($row2 = mysqli_fetch_assoc($res2)){
                                echo "<td>".$row2['fname']."</td><td>".$row2['lname']."</td></tr>";
                            }
                        }
                    }
                }else{
                    echo "<tr><td>No Requests</td></tr>";
                }
                ?>
            </table>
            <br>
        </div>
    </body>
</html>