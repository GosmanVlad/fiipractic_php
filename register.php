<?php include('header.php'); 
if(isset($_SESSION['auth']))
header("Location: index.php");?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
        <h1>Inregistrare cont</h1>
        <center><p>Inregistreaza-ti un cont pentru a beneficia in intregime de ofertele personalizate facute de noi.</center>
        <hr>
        <form method="POST" action="register_back.php">
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
                <br>
                <div class="row">
                    <div class="col-sm">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="ex: test@yahoo.com">
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-danger">Inregistreaza</button>
        </form>
    </div></div>

    <?php Footer() ?>

</body>