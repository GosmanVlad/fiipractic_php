<?php include('header.php'); 
if(!isset($_SESSION['name']) || $_SESSION['admin'] == 0)
    header("Location: index.php");
else
{
    $name = $_SESSION['name'];

    $car_category = dbQuery("SELECT * FROM cars_category ORDER BY id DESC");
    $car_category->execute();
}
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall">
    <br>
        <h1>Salut, <?php echo $name ?> !</h1>
        <div class="centerText"><p>Adauga o noua masina de inchiriat!</div>
        <hr>
        <?php
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
        //  + PARTEA DE BACK -> DUPA CE SE APASA BUTONUL 'ADAUGA MASINA'           //
        //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
        if(isset($_POST['addcar']))
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


            $result = vQuery("INSERT INTO cars (id, name, category, combustible, seats, consumption, engine_capacity, facilities, image, 
                                                transmission, price, power) 
                            VALUES (NULL, '$carName', '$carCategory', '$carCombustible', '$carSeats', '$carConsumption', '$carCapacity', 
                                    '$carFacilities', '$carImage', '$carTransmission', '$carPrice', '$carPower')");
                    
            echo '<div class="alert alert-success" role="alert">
                    Masina a fost adaugata cu succes!
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
                            <input type="text" name="carName" class="form-control" placeholder="Ex: Opel Astra">
                        </div>
                        <div class="col-sm">
                            <label>Combustibil</label>
                            <input type="text" name="carCombustible" class="form-control" placeholder="Ex: Benzina">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label>Numar locuri</label>
                            <input type="text" name="carSeats" class="form-control" placeholder="Ex: 5">
                        </div>
                        <div class="col-sm">
                            <label>Consum ( % )</label>
                            <input type="text" name="carConsumption" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label>Capacitate motor</label>
                            <input type="text" name="carCapacity" class="form-control">
                        </div>
                        <div class="col-sm">
                            <label>Transmisie</label>
                            <input type="text" name="carTransmission" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label>Cai putere</label>
                            <input type="text" name="carPower" class="form-control">
                        </div>
                        <div class="col-sm">
                            <label>Pret</label>
                            <input type="text" name="carPrice" class="form-control">
                        </div>
                    </div>
                    <br>
                    <label>Categorie</label>
                    <select class="form-control" name="carCategory"> <?php
                        foreach($car_category as $row)
                        {
                            $name = $row['name'];
                            $id = $row['id']; ?>
                            <option value='<?=$id?>'><?=$name?></option>
                        <?php } ?>
                    </select><br>

                    <label>Image</label>
                    <input type="text" name="carImage" class="form-control"><br>

                    <label>Alte facilitati (Permise taguri HTML precum br)</label>
                    <textarea rows="5" type="text" name="carFacilities" class="form-control"></textarea>
    
                </div>
                <hr>
                <div class="centerText"><button type="submit" class="btn btn-danger" name="addcar">Adauga masina</button></div>
            </form>
            </div>

            <?php Admin_Sidebar(); ?>
        </div>

    </div>
    </div>

    <?php Footer() ?>

</body>