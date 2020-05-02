<?php include('header.php'); 
if(!isset($_GET['category']))
    $_GET['category'] = 0;

$pagid = $_GET['category'];

if($pagid == 0)
    $category = dbQuery("SELECT cat.id as categoryID, cat.name as categoryName, ct.combustible, ct.transmission, ct.engine_capacity, ct.price, ct.id as car_id, ct.name, ct.image 
                                FROM cars_category as cat 
                                JOIN cars as ct ON cat.id=ct.category ORDER BY ct.id DESC");
else
    $category = dbQuery("SELECT cat.id as categoryID, cat.name as categoryName, ct.combustible, ct.transmission, ct.engine_capacity, ct.price, ct.id as car_id, ct.name, ct.image 
                                FROM cars_category as cat 
                                JOIN cars as ct ON cat.id=ct.category WHERE cat.id='$pagid' ORDER BY ct.id DESC");
$category->execute();
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
        <h1>Toate masinile</h1><hr>
        <?php
            category_Menu($pagid, 1);
            foreach($category as $row2)
            {

                $combustible = $row2['combustible'];
                $transmission = $row2['transmission'];
                $capacity = $row2['engine_capacity'];
                $price = $row2['price'];
                $car_id = $row2['car_id']; ?>

                <div class='box-container'>
                <img class='box-image' src ='<?php echo ''.URL.'images/'.$row2["image"].''; ?>'></img><hr>
                <p><b><?=$row2["name"]?> (Categorie: <?=$row2['categoryName']?>)</b></p>
                <p style='font-size:13px;'><i class='fa fa-check'></i><?= $transmission ?><br>
                <i class='fa fa-check'></i><?= $combustible ?><br>
                <i class='fa fa-check'></i> <b>Capacitate motor:</b><?= $capacity ?><p>
                <div class='centerText'><b style='color:green'><?= $price ?> <i class='fa fa-euro'></i> / day</b></div>
                <p><div class='centerText'><a href='<?php echo ''.URL.'aboutcar.php?carid='.$car_id.''; ?>' class='btn btn-primary'>Afla mai multe detalii</a></div></p></div> <?php
            }?>
    </div></div>

    <?php Footer() ?>

</body>