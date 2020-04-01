<?php include('header.php'); ?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
        <h1>Autentificare cont</h1>
        <center><p>Daca inca nu ai un cont, iti poti inregistra unul <a href='<?php ". URL ." ?>register.php'>aici</a>!</center>
        <hr>
        <?php
            if(empty($_POST['username']) || empty($_POST['password']))
                header("Location: login.php");
            else
            {
                $username = $_POST['username'];
                $password = md5($_POST['password']);

                $result = vQuery_Select("SELECT * FROM users WHERE name = '$username'");
                $result->execute();
                $row = $result->fetch();

                if($result->rowCount())
                {
                    if($password == $row['password'])
                    {
                        echo '<div class="alert alert-success" role="alert">
                        Salut, <b>'.$username.'</b>! Te-ai autentificat cu succes!
                        </div>';
                        $_SESSION['auth'] = 1;
                        $_SESSION['admin'] = $row['admin'];
                        $_SESSION['userid'] = $row['id'];
                        $_SESSION['name'] = $row['name'];

                        header( "refresh:1;url=index.php" );
                    }
                    else
                    {
                        echo '<div class="alert alert-danger" role="alert">
                        Parola sau username gresit! Mergi inapoi la <a href="'.URL.'login.php">autentificare</a>!
                        </div>';
                    }
                }
            }
        ?>
    </div></div>

    <?php Footer() ?>

</body>