<?php include('header.php'); 
if(!isset($_SESSION['auth']))
    header("Location: index.php");
else
{
    $name = $_SESSION['name'];
    $carid=$_GET['carid'];
    $result = dbQuery("SELECT name, image FROM cars WHERE id='$carid'");
    $result->execute();
    $row=$result->fetch();
    $carName = $row['name'];
    $carImage = $row['image'];
}
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
        <h1>Feedback pentru masina <?php echo $carName ?></h1>
        <div class="centerText"><p><div class='box-container'><img src='images/<?php echo $carImage?>'></img></div></div>
        <hr>
        <form method="POST" action="car_feedback_back.php">
            <label>Nume:</label>
            <input type="text" name="username" class="form-control" value="<?=$name?>" readonly> 
            <br>
            <input name="carid" type="hidden" value="<?php echo $carid ?>">
            <label>Feedback</label>
            <textarea class="form-control" rows="5" name="feedback"></textarea><br>
            <button type="submit" class="btn btn-success btn-block">Trimite</button>
        </form>
    </div></div>

    <?php Footer() ?>

</body>