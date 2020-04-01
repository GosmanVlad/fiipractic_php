<?php include('header.php'); 
if(!isset($_SESSION['auth']))
    header("Location: index.php");
else
    $name = $_SESSION['name'];
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall">
    <br>
        <h1>Salut, <?php echo $name ?> !</h1>
        <center><p>Ti-am atasat aici cateva detalii despre contul tau si demersul acestuia pe website-ul nostru!</center>
        <hr>
    
        <div class="row">
            <div class="body-wall-profile col-9">
                <center><h3>Schimba parola contului</h3></center><br>
                <form method="POST" action="settings_back.php">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <label>Parola veche</label>
                            <input type="password" name="oldPassword" class="form-control">
                        </div>
                        <div class="col-sm">
                            <label>Parola noua</label>
                            <input type="password" name="newPassword" class="form-control">
                        </div>
                    </div>
                </div><hr>
                <center><button type="submit" class="btn btn-primary">Schimba parola</button></center>
                </form>
            </div>

            <?php Profile_Sidebar(); ?>
        </div>

    </div>
    </div>

    <?php Footer() ?>

</body>