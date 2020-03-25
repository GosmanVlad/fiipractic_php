<?php include('header.php'); 
$page = 0;
$category = vQuery_Select("SELECT * FROM cars_category");
$category->execute();
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
        <h1>Toate masinile</h1><hr>
        <?php if(!isset($_GET['category'])) { 
            category_Menu(0);
        ?>
        <?php
        $result = vQuery_Select("SELECT * FROM `cars`");
        $result->execute();
        if($result->rowCount() > 0) {
           foreach($result as $row)
           {
                $result2 = vQuery_Select("SELECT * FROM `cars_category` WHERE `id` = ".$row["category"]."");
                $result2->execute();
                echo "<div class='box-container'>";
                echo "<img class='box-image' src ='".URL."images/".$row["image"]."'></img><hr>";
                if($result2->rowCount()) {
                    $row2 = $result2->fetch();
                    $combustible = $row['combustible'];
                    $transmission = $row['transmission'];
                    $capacity = $row['engine_capacity'];
                    $price = $row['price'];
                    $car_id = $row['id'];
                    echo "<p><b>".$row["name"]." (Categorie: ".$row2['name'].")</b></p>";
                }
                echo "<p style='font-size:13px;'><i class='fa fa-check'></i> $transmission<br>";
                echo "<i class='fa fa-check'></i> $combustible<br>";
                echo "<i class='fa fa-check'></i> <b>Capacitate motor:</b> $capacity<p>";
                echo "<center><b style='color:green'>$price <i class='fa fa-euro'></i> / day</b></center>";
                echo "<p><center><a href='".URL."aboutcar.php?carid=$car_id' class='btn btn-primary'>Afla mai multe detalii</a></center></p></div>";
           }
        }
    }
    else {
$category = vQuery_Select("SELECT * FROM cars_category");
$category->execute();
foreach($category as $row)
{
    if(isset($_GET['category']) && $_GET['category'] == $row['id'])
    {
        $page = $row['id'];
        category_Menu($page);
        $categoryID = $row['id'];
        $categoryName = $row['name'];
        $result2 = vQuery_Select("SELECT * FROM cars WHERE category = '$categoryID'");
        $result2->execute();
        foreach($result2 as $row2)
        {
            $combustible = $row2['combustible'];
            $transmission = $row2['transmission'];
            $capacity = $row2['engine_capacity'];
            $price = $row2['price'];
            $car_id = $row2['id'];
            echo "<div class='box-container'>";
                echo "<img class='box-image' src ='".URL."images/".$row2["image"]."'></img><hr>";
                if($result2->rowCount()) {
                    $row2 = $result2->fetch();
                    echo "<p><b>".$row["name"]." (Categorie: ".$row['name'].")</b></p>";
                }
                echo "<p style='font-size:13px;'><i class='fa fa-check'></i> $transmission<br>";
                echo "<i class='fa fa-check'></i> $combustible<br>";
                echo "<i class='fa fa-check'></i> <b>Capacitate motor:</b> $capacity<p>";
                echo "<center><b style='color:green'>$price <i class='fa fa-euro'></i> / day</b></center>";
                echo "<p><center><a href='".URL."aboutcar.php?carid=$car_id' class='btn btn-primary'>Afla mai multe detalii</a></center></p></div>";
        }
    }
}
}?>
    </div></div>

    <?php Footer() ?>

</body>