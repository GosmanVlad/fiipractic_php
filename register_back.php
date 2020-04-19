<?php include('header.php'); ?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
        <h1>Inregistrare cont</h1>
        <div class="centerText"><p>Inregistreaza-ti un cont pentru a beneficia in intregime de ofertele personalizate facute de noi.</div>
        <hr>
        <?php
            if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']))
                header("Location: register.php");
            else
            {
                $username = $_POST['username'];
                $password = md5($_POST['password']);
                $email = $_POST['email'];


                $result = vQuery("INSERT INTO users (id, name, password, email) VALUES (NULL, '$username', '$password', '$email')");
                
                echo '<div class="alert alert-success" role="alert">
                    Contul <b>'.$username.'</b> cu email-ul <b>'.$email.'</b> a fost inregistrat cu succes!
                  </div>';
                header( "refresh:1;url=index.php" );
            }

        ?>
    </div></div>

    <?php Footer() ?>

</body>