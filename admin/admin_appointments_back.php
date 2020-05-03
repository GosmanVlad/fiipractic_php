<?php include('../header.php'); 
if(!isset($_SESSION['name']) || $_SESSION['admin'] == 0)
    header("Location: ../index.php");
else
{
    $name = $_SESSION['name'];

    if(isset($_GET['page']))
    {
        $page = $_GET['page'];

        if(!isset($_GET['id']))
            header("Location: admin_appointments.php");
    }
    else
        $page = NULL;

}

if($page=='delete')
{
    $id = $_GET['id'];
    vQuery("DELETE FROM appointments WHERE id='$id'");
    header("Location: admin_appointments.php");
}
else if($page=='approve')
{
    $id = $_GET['id'];
    vQuery("UPDATE appointments SET approved=1 WHERE id='$id'");
    header("Location: admin_appointments.php");
}
else if($page=='disapprove')
{
    $id = $_GET['id'];
    vQuery("UPDATE appointments SET approved=0 WHERE id='$id'");
    header("Location: admin_appointments.php");
}