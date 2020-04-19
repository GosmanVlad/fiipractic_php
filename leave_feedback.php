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
else
    $email = $_POST['email'];
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
    <div class="centerText"><h3>Leave a feedback</h1></div>
        <hr>
        <?php
            $result = vQuery("INSERT INTO testimonials (id, name, email, feedback) VALUES (NULL, '$username', '$email', '$feedback')");
                
            echo '<div class="alert alert-success" role="alert">
                Feedback-ul a fost trimis catre echipa administrativa!<br>
                <b>Multumim pentru parere!</b>
                </div>';
            header( "refresh:1;url=index.php" );
        ?>
    </div></div>

    <?php Footer() ?>

</body>