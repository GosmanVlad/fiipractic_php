<?php include('header.php'); 

$username = $_POST['username'];
$feedback = $_POST['feedback'];

if(empty($_POST['feedback'])) {
    header("Location: index.php");
    exit();
}

if(isset($_SESSION['auth']))
{
    $id = $_SESSION['userid'];

    $result = dbQuery("SELECT `email` FROM users WHERE `id` = '$id'");
    $result->execute();
    $row2 = $result->fetch();

    $email = $row2['email'];
}
else {
    $email = $_POST['email'];
}
$carid = $_POST['carid'];
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
        <div class="centerText"><h3>Leave a feedback</h1></div>
        <hr>
        <?php
            $result = vQuery("INSERT INTO car_feedback (id, name, email, carid, feedback) VALUES (NULL, '$username', '$email', '$carid','$feedback')"); ?>
                
            <div class="alert alert-success" role="alert">
                Feedback-ul a fost trimis catre echipa administrativa!<br>
                <b>Multumim pentru parere!</b>
                </div> 
            <?php header( "refresh:1;url=index.php" ); ?>
    </div></div>

    <?php Footer() ?>

</body>