<?php include('header.php');
if(!isset($_GET['carid']))
    header("Location: index.php");
else
{
    $carid = $_GET['carid'];

    $result = dbQuery("SELECT * FROM cars WHERE id='$carid'");
    $result->execute();

    foreach($result as $row)
    {
        $name = $row['name'];
        $combustible = $row['combustible'];
        $seats = $row['seats'];
        $consumption = $row['consumption'];
        $engine_capacity = $row['engine_capacity'];
        $transmission = $row['transmission'];
        $power = $row['power'];
        $price = $row['price'];
        $category_id = $row['category'];
        $image = $row['image'];
        $facilities = $row['facilities'];
    }

    $car_category = dbQuery("SELECT * FROM cars_category ORDER BY id DESC");
    $car_category->execute();
}
if(!isset($_SESSION['name']) || $_SESSION['admin'] == 0)
    header("Location: index.php");
else
{
    $name = $_SESSION['name'];
}
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall">
    <br>
        <h1>Salut, <?php echo $name ?> !</h1>
        <div class="centerText"><p>Editeaza masina <b><?php echo getCarName($carid);?></b></div>
        <hr>
        <?php
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
        //  + PARTEA DE BACK -> DUPA CE SE APASA BUTONUL 'ADAUGA MASINA'           //
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
        if(isset($_POST['editcar']))
        {
            $carName = $_POST['carName'];
            $carCombustible = $_POST['carCombustible'];
            $carSeats = $_POST['carSeats'];
            $carConsumption = $_POST['carConsumption'];
            $carCapacity = $_POST['carCapacity'];
            $carTransmission = $_POST['carTransmission'];
            $carPower = $_POST['carPower'];
            $carPrice = $_POST['carPrice'];
            $carImage = $_POST['carImage'];
            $carFacilities = $_POST['carFacilities'];
            $carCategory = $_POST['carCategory'];


            $result = vQuery("UPDATE cars SET
                            name='$carName', combustible='$carCombustible', seats='$carSeats', consumption='$carConsumption',
                            engine_capacity='$engine_capacity', transmission='$carTransmission', power='$carPower', 
                            price='$carPrice', image='$carImage', facilities='$carFacilities', category='$carCategory'
                            WHERE id='$carid'");
                    
            echo '<div class="alert alert-success" role="alert">
                    Masina a fost editata cu succes!
                </div>';
            header( "refresh:1;url=cars.php" );
        }
        ?>
        <div class="row">
            <div class="body-wall-profile col-9"><br>
                <form method="POST" action="">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <label>Nume vehicul</label>
                            <input type="text" name="carName" class="form-control" value="<?php echo getCarName($carid)?>">
                        </div>
                        <div class="col-sm">
                            <label>Combustibil</label>
                            <input type="text" name="carCombustible" class="form-control" value="<?=$combustible?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label>Numar locuri</label>
                            <input type="text" name="carSeats" class="form-control" value="<?=$seats?>">
                        </div>
                        <div class="col-sm">
                            <label>Consum ( % )</label>
                            <input type="text" name="carConsumption" class="form-control" value="<?=$consumption?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label>Capacitate motor</label>
                            <input type="text" name="carCapacity" class="form-control" value="<?=$engine_capacity?>">
                        </div>
                        <div class="col-sm">
                            <label>Transmisie</label>
                            <input type="text" name="carTransmission" class="form-control" value="<?=$transmission?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label>Cai putere</label>
                            <input type="text" name="carPower" class="form-control" value="<?=$power?>">
                        </div>
                        <div class="col-sm">
                            <label>Pret</label>
                            <input type="text" name="carPrice" class="form-control" value="<?=$price?>">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm">
                            <label>Categorie</label>
                            <select class="form-control" name="carCategory"> <?php
                                foreach($car_category as $row)
                                {
                                    $name = $row['name'];
                                    $id = $row['id']; ?>
                                    <option value='<?=$id?>'><?=$name?></option>
                                <?php } ?>
                            </select><br>
                        </div>

                        <div class="col-sm">
                            <label>Image</label>
                            <input type="text" name="carImage" class="form-control" value="<?=$image?>">
                        </div>
                    </div><br>

                    <label>Alte facilitati (Permise taguri HTML precum br)</label>
                    <textarea rows="5" type="text" name="carFacilities" class="form-control"><?=$facilities?></textarea>
    
                </div>
                <hr>
                <div class="centerText"><button type="submit" class="btn btn-info" name="editcar">Editeaza masina</button></div>
            </form>
            </div>

            <?php Admin_Sidebar(); ?>
        </div>

    </div>
    </div>

    <?php Footer() ?>

</body>