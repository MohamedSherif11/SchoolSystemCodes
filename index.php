<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: ../index.php');
}else if($_SESSION['type']!='2'){
    header('Location: ../index.php');
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
            <form action="../logout.php" method="get" >
                <input type="submit" value="Logout" id="button1">
            </form>
            <form action="respond_messages.php" method="get" >
                <input type="submit" value="Respond-Messages" id="button1">
            </form>
            <form action="comment.php" method="get" >
                <input type="submit" value="Write-Comment" id="button1">
            </form>
            <form action="meeting_requests.php" method="get" >
                <input type="submit" value="Meeting-Requests" id="button1">
            </form>
            <form action="schedule_meeting.php" method="get" >
                <input type="submit" value="Schedule-meeting" id="button1">
            </form>
            <form action="edit_grades.php" method="get" >
                <input type="submit" value="Edit-Grades" id="button1">
            </form>
            <form action="add_grades.php" method="get" >
                <input type="submit" value="Add-Grades" id="button1">
            </form>
        </div>
    </body>
</html>