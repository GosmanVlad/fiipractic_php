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

            </div>

            <?php Profile_Sidebar(); ?>
        </div>

    </div>
    </div>

    <?php Footer() ?>

</body>