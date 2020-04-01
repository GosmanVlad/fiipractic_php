<?php include('header.php');
if(!isset($_SESSION['auth']))
    header("Location: index.php");
else
    $name = $_SESSION['name'];
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
    <h1>Salut, <?php echo $name ?> !</h1>
        <center><p>Ti-am atasat aici cateva detalii despre contul tau si demersul acestuia pe website-ul nostru!</center>
        <hr>
        <?php
            if(empty($_POST['oldPassword']) || empty($_POST['newPassword']))
                header("Location: settings.php");
            else
            {
                $oldPassword = md5($_POST['oldPassword']);
                $newPassword = md5($_POST['newPassword']);

                $result = vQuery_Select("SELECT * FROM users WHERE name = '$name'");
                $result->execute();
                $row = $result->fetch();

                if($result->rowCount())
                {
                    if($oldPassword == $row['password'])
                    {
                        echo '<div class="alert alert-success" role="alert">
                        Parola contului <b>'.$name.'</b> a fost schimbata cu succes!<br>';
                        echo" <a href=\"javascript:history.go(-1)\">Mergi inapoi pe profil.</a>
                            </div>";

                        vQuery("UPDATE users SET password='$newPassword' WHERE name='$name'");
                    }
                    else
                    {
                        echo '<div class="alert alert-danger" role="alert">
                            Parola veche introdusa nu coincide cu parola contului <b>'.$name.'</b>.<br>';
                        echo "<a href=\"javascript:history.go(-1)\">Mergi inapoi.</a>
                            </div>";
                    }
                }
            }
        ?>
    </div></div>

    <?php Footer() ?>

</body>