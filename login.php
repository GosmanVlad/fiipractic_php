<?php include('header.php'); 
if(isset($_SESSION['auth']))
    header("Location: index.php");
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
        <h1>Autentificare cont</h1>
        <div class="centerText"><p>Daca inca nu ai un cont, iti poti inregistra unul <a href='<?php ". URL ." ?>register.php'>aici</a>!</div>
        <hr>
        <form method="POST" action="login_back.php">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Nume de utilizator">
                    </div>
                    <div class="col-sm">
                        <label>Parola</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
            </div><hr>
            <div class="centerText"><button type="submit" class="btn btn-primary">Autentificare</button></div>
        </form>
    </div></div>

    <?php Footer() ?>

</body>