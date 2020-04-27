<?php include('header.php');
if(empty($_GET['carid']))
    header("Location: cars.php");
else
    $carid = $_GET['carid'];
/*******************************************************/
$today = strtotime(date("d-m-Y"));
/*******************************************************/
$alreadyBooked = dbQuery("SELECT * FROM appointments WHERE carid = '$carid' ORDER BY id DESC");
$alreadyBooked->execute();
$rowCount = $alreadyBooked->rowCount();

if($rowCount) {
    $rowApp = $alreadyBooked->fetch();
    $data_pred_hash = strtotime(str_replace("/","-", $rowApp['data_predare']));
    $data_primire_hash = strtotime(str_replace("/","-", $rowApp['data']));
    $data_pred = $rowApp['data_predare'];
    $data_primire =$rowApp['data'];
}
/*******************************************************/
$result = dbQuery("SELECT ct.*, cat.name as categoryName 
                        FROM cars as ct 
                        JOIN cars_category as cat 
                        ON cat.id=ct.category 
                        WHERE ct.id = '$carid'");
$result->execute();
$row = $result->fetch();
//----------------------------//
$name = $row['name'];
$category = $row['category'];
$combustible = $row['combustible'];
$seats = $row['seats'];
$consumption = $row['consumption'];
$capacity = $row['engine_capacity'];
$facilities = $row['facilities'];
$image = $row['image'];
$transmission = $row['transmission'];
$price = $row['price'];
$power = $row['power'];
$category_name = $row['categoryName'];
/*******************************************************/
$result2 = dbQuery("SELECT * FROM locations");
$result2->execute();
/*******************************************************/
?>
<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
        <?php 
            if(isset($_POST['sendbtn']))
            {
                if(empty($_POST['nume']) || empty($_POST['telefon']) || empty($_POST['data']) || empty($_POST['data-predare']))
                    header("Location: cars.php");
                else {
                    $nume = $_SESSION['name'];
                    $car = $_GET['carid'];
                    $data_hash = strtotime(str_replace("/", "-", $_POST['data']));
                    $data = $_POST['data'];
                    $phone = $_POST['telefon'];
                    $data_predare_hash = strtotime(str_replace("/", "-", $_POST['data-predare']));
                    $data_predare = $_POST['data-predare'];
                    $additions = $_POST['additions'];
                    $location = $_POST['locations'];

                    if($rowCount) {
                        if($data_hash <= $data_primire_hash && 
                            ($data_predare_hash >= $data_primire_hash && $data_predare_hash <= $data_pred_hash) ||
                            $data_hash >= $data_primire_hash && $data_predare_hash <= $data_pred_hash ||
                            $data_hash >= $data_primire_hash && $data_hash <= $data_pred_hash) { ?>
                            <div class='alert alert-danger'>Acest vehicul este deja rezervat in intervalul <b>$data_primire</b> - <b>$data_pred</b>!<br>
                            <a href="" onclick="goBack()">Mergi inapoi.</a></div> <?php
                            exit();
                        }
                    }
                    vQuery("INSERT INTO appointments (name, carid, data, data_predare, location, additions, phone) VALUES ('$nume', '$car', '$data', '$data_predare', '$location', '$additions', '$phone')");
                    ?><div class="alert alert-success">Felicitari! Ai rezervat aceasta masina incepand de la data de <b>'.$data.'</b> pana pe <b>'.$data_predare.'</b><br>
                        Insa, cererea ta va trebui sa mai treaca printr-un singur pas, si anume, aprobarea agentului! Acesta te va suna in cel mai scurt timp!</div> <?php
                }
            } ?>
            <h1><?=$name?></h1><hr>
            <div class='row'>
            <div class='col-sm'><img class='car-image' src='<?php echo ''.URL.'images/'.$image.''; ?>'></img></div>
                <div class='col-sm'>
                <h3 style='color:#B21515;'>Despre masina:</h3><br>
                <b><i class='fa fa-check' style='color:green'></i> Categorie:</b> <?= $category_name ?><br>
                <b><i class='fa fa-check' style='color:green'></i> Combustibil:</b> <?= $combustible ?><br>
                <b><i class='fa fa-check' style='color:green'></i> Numar locuri:</b> <?= $seats ?><br>
                <b><i class='fa fa-check' style='color:green'></i> Capacitate cilindrica:</b> <?= $capacity ?><br>
                <b><i class='fa fa-check' style='color:green'></i> Transmisie:</b> <?= $transmission ?><br>
                <b><i class='fa fa-check' style='color:green'></i> Putere:</b> <?= $power ?> CP<hr>
                <h3 style='color:#B21515;'>Alte facilitati:</h3>
                <b><?= $facilities ?></b>
                </div>
                </div>
            <hr> 
     <?php  if(!isset($_SESSION['auth']))
                echo "<div class='alert alert-danger'>Trebuie sa fii autentificat pentru a putea rezerva aceasta masina!</div>";
                else
                {
                   ?> <div class="centerText"><h2>Rezerva aceasta masina!</h2></div><br> <?php
                    if($rowCount) {
                        if($today < $data_primire_hash) {
                            ?> <div class="alert alert-danger">Acest vehicul poate fi inchiriat incepand de <b>AZI</b> pana pe data de <b><?=$data_primire?></b>, respectiv dupa data de <b><?=$data_pred?></b>!</div> <?php
                        }
                        else if($today >= $data_primire_hash && $today <= $data_pred_hash) {
                            ?> <div class="alert alert-danger">Acest vehicul este disponibil incapand cu data de <b><?=$data_pred?></b>!</div> <?php
                        }
                    } ?>
                    <div class="alert alert-primary"><b>IMPORTANT!</b> Predarea masinii se va face la ora <b>8:00 AM</b>. Pentru stabilirea altei ore, precizati in sectiunea <b>"alte specificatii"</b></div><hr>
                    
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-sm"><label>Nume Prenume (pentru facturare):</label>
                                <input type="text" name="nume" placeholder="Nume Prenume" class="form-control">
                            </div>

                            <div class="col-sm"><label>Numar de telefon:</label>
                                <input type="text" name="telefon" placeholder="07********" class="form-control">
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-sm"><label>Data ridicarii:</label>
                                <input type="text" name="data" placeholder="ziua/luna/anul" class="form-control">
                            </div>
                            <div class="col-sm"><label>Data predarii:</label>
                                <input type="text" name="data-predare" placeholder="ziua/luna/anul" class="form-control">
                            </div>
                        </div><br>
    
                        <div class="form-group">
                            <label>Locatia ridicarii:</label>
                            <select class="form-control" name="locations"> <?php
                                foreach($result2 as $row2)
                                {
                                    $location = $row2['location'];
                                    $id = $row2['id']; ?>
                                    <option value=$id><?=$location?></option>
                          <?php } ?>
                            </select>
                        </div><br>
    
                        <label>Alte specificatii:</label> <textarea class="form-control" rows="5" name="additions"></textarea><br>
                        <button type="submit" class="btn btn-success btn-block" name="sendbtn">Trimite</button>
                    </form> <?php
                } ?>
    </div>
    </div>

    <div class="body-container"><div class="body-wall">
        <div class="centerText"><h3>Vezi ce spun clientii despre masina</h3></div><br>
            <?php Car_Testimonials($carid); ?>
    </div></div>
    <?php Footer() ?>
</body>