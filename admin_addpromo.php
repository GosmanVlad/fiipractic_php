<?php include('header.php'); 
if(!isset($_SESSION['name']) || $_SESSION['admin'] == 0)
    header("Location: index.php");
else
{
    $name = $_SESSION['name'];

    $cars = dbQuery("SELECT * FROM cars ORDER BY id DESC");
    $cars->execute();
}
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall">
    <br>
        <h1>Salut, <?php echo $name ?> !</h1>
        <div class="centerText"><p>Adauga o noua promotie de sezon din acest panel.</div>
        <hr>
        <?php
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
        //  + PARTEA DE BACK -> DUPA CE SE APASA BUTONUL 'ADAUGA PROMO'           //
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
        if(isset($_POST['addpromo']))
        {
            $carID = $_POST['carID'];
            $carExpiration = $_POST['carExpiration'];
            $carNewPrice = $_POST['carNewPrice'];
            $carOldPrice = getCarPrice($carID);

            $result = vQuery("INSERT INTO promotions (id, car_id, oldPrice, newPrice, until) 
                            VALUES (NULL, '$carID', '$carOldPrice', '$carNewPrice', '$carExpiration')");
                    
            echo '<div class="alert alert-success" role="alert">
                    Promotia a fost adaugata cu succes!
                </div>';
            header( "refresh:1;url=promotions.php" );
        }
        ?>
        <div class="row">
            <div class="body-wall-profile col-9"><br>
                <form method="POST" action="">
                <div class="container">
                    <label>Alege masina</label>
                    <select class="form-control" name="carID"> <?php
                        foreach($cars as $row)
                        {
                            $name = $row['name'];
                            $id = $row['id']; 
                            $carOldPrice = getCarPrice($id)?>
                            <option value='<?=$id?>'><?=$name?> (Old price: <?=$carOldPrice?>)</option>
                        <?php } ?>
                    </select><br>
                    
                    <div class="row">
                        <div class="col-sm">
                            <label>Data expirarii</label>
                            <input type="text" name="carExpiration" class="form-control" placeholder="D/M/Y"><br>
                        </div>
                        <div class="col-sm">
                            <label>Noul pret</label>
                            <input type="text" name="carNewPrice" class="form-control"><br>
                        </div>
                    </div>
    
                </div>
                <hr>
                <div class="centerText"><button type="submit" class="btn btn-danger" name="addpromo">Adauga promotie</button></div>
            </form>
            </div>

            <?php Admin_Sidebar(); ?>
        </div>

    </div>
    </div>

    <?php Footer() ?>

</body>