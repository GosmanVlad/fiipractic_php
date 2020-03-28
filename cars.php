<?php include('header.php'); 
if(!isset($_GET['category']))
    $_GET['category'] = 0;
$pagid = $_GET['category'];
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
        <h1>Toate masinile</h1><hr>
        <?php

            if($pagid == 0)
                $category = vQuery_Select("SELECT cat.id as categoryID, cat.name as categoryName, ct.combustible, ct.transmission, ct.engine_capacity, ct.price, ct.id as car_id, ct.name, ct.image 
                                            FROM cars_category as cat 
                                            JOIN cars as ct ON cat.id=ct.category");
            else
                $category = vQuery_Select("SELECT cat.id as categoryID, cat.name as categoryName, ct.combustible, ct.transmission, ct.engine_capacity, ct.price, ct.id as car_id, ct.name, ct.image 
                                            FROM cars_category as cat 
                                            JOIN cars as ct ON cat.id=ct.category WHERE cat.id='$pagid'");
            $category->execute();

            category_Menu($pagid);
            foreach($category as $row2)
            {

                $combustible = $row2['combustible'];
                $transmission = $row2['transmission'];
                $capacity = $row2['engine_capacity'];
                $price = $row2['price'];
                $car_id = $row2['car_id'];

                echo "<div class='box-container'>";
                echo "<img class='box-image' src ='".URL."images/".$row2["image"]."'></img><hr>";
                echo "<p><b>".$row2["name"]." (Categorie: ".$row2['categoryName'].")</b></p>";
                echo "<p style='font-size:13px;'><i class='fa fa-check'></i> $transmission<br>";
                echo "<i class='fa fa-check'></i> $combustible<br>";
                echo "<i class='fa fa-check'></i> <b>Capacitate motor:</b> $capacity<p>";
                echo "<center><b style='color:green'>$price <i class='fa fa-euro'></i> / day</b></center>";
                echo "<p><center><a href='".URL."aboutcar.php?carid=$car_id' class='btn btn-primary'>Afla mai multe detalii</a></center></p></div>";
            }?>
    </div></div>

    <?php Footer() ?>

</body>