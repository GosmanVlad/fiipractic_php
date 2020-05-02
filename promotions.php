<?php include('header.php'); 
if(!isset($_GET['category']))
    $_GET['category'] = 0;

$pagid = $_GET['category'];

if($pagid == 0)
    $category = dbQuery("SELECT ct.*, prt.newPrice, prt.oldPrice, prt.until, cat.name as categoryName 
                            FROM promotions as prt 
                            JOIN cars as ct 
                            ON prt.car_id = ct.id 
                            JOIN cars_category as cat 
                            ON ct.category=cat.id
                            ORDER BY prt.id DESC");
else
    $category = dbQuery("SELECT ct.*, prt.newPrice, prt.oldPrice, prt.until, cat.name as categoryName 
                            FROM promotions as prt 
                            JOIN cars as ct 
                            ON prt.car_id = ct.id 
                            JOIN cars_category as cat 
                            ON ct.category=cat.id WHERE cat.id='$pagid'
                            ORDER BY prt.id DESC");
$category->execute();
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
        <h1>Toate masinile</h1><hr>
        <?php
            category_Menu($pagid, 2);
            foreach($category as $row2)
            {

                $combustible = $row2['combustible'];
                $transmission = $row2['transmission'];
                $capacity = $row2['engine_capacity'];
                $oldPrice = $row2['oldPrice'];
                $newPrice = $row2['newPrice'];
                $car_id = $row2['id'];
                $until = $row2['until'];

                echo "<div class='box-container'>";
                echo "<img class='box-image' src ='".URL."images/".$row2["image"]."'></img><hr>";
                echo "<p><b>".$row2["name"]." (Categorie: ".$row2['categoryName'].")</b></p>";
                echo "<p style='font-size:13px;'><i class='fa fa-check'></i> $transmission<br>";
                echo "<i class='fa fa-check'></i> $combustible<br>";
                echo "<i class='fa fa-check'></i> <b>Capacitate motor:</b> $capacity<p>";
                echo " <div class='centerText'><b style='color:red'><strike>$oldPrice <i class='fa fa-euro'></i> / day</strike></b><br><b style='color:green'>$newPrice <i class='fa fa-euro'></i> / day</b><br>
                <span class='badge badge-danger' style='padding:5px;'>PROMOTIE PANA PE $until !</span></div>";
                echo "<p> <div class='centerText'><a href='".URL."aboutcar.php?carid=$car_id' class='btn btn-primary'>Afla mai multe detalii</a></div></p></div>";
            }?>
    </div></div>

    <?php Footer() ?>

</body>