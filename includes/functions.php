<?php
session_start();
define("URL", "http://localhost/rent/");
require("mysql.php");

function category_Menu($page, $type)
{
    $category2 = dbQuery("SELECT * FROM cars_category");
    $category2->execute();
    $type == 1 ? $url = 'cars.php' : $url = 'promotions.php';
    /*******************************************************/
    echo '<center>';
    if($page==0)
        echo"<a href='".URL."$url' style='margin-left:5px;' class='btn btn-danger'>Toate masinile</a>";
    else
        echo"<a href='".URL."$url' style='margin-left:5px;' class='btn btn-primary'>Toate masinile</a>";
    
    foreach($category2 as $row)
    {
        $id = $row['id']; 
        $name = $row['name'];
        if($page == $id)
            echo"<a href='".URL."$url?category='$id style='margin-left:5px;'class='btn btn-danger'>$name</a>";
        else
            echo"<a href='".URL."$url?category=$id' style='margin-left:5px;' class='btn btn-primary'>$name</a>";
    }
    echo '</center><hr>';
}

function vQuery($query)
{
    require("mysql.php");
    $conn->exec($query);
}

function dbQuery($query)
{
    require("mysql.php");
    $statement = $conn->prepare($query);
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $statement->fetchAll();
    return $statement;
}

function Profile_Sidebar()
{ ?>
    <div class="body-wall-profile-side col-3">
    <i class="fa fa-car"></i> <a href="profile.php">Masini inchiriate</a><hr>
    <i class="fa fa-user"></i> <a href="settings.php">Setari cont</a><hr>
    <i class="fa fa-sign-out"></i> <a href="logout.php">Deconectare</a><hr>
    </div> <?php
}

function Admin_Sidebar()
{ ?>
    <div class="body-wall-profile-side col-3">
    <i class="fa fa-car"></i> <a href="<?php echo ''.URL.'';?>admin/admin_addcar.php">Adauga o masina</a><hr>
    <i class="fa fa-star"></i> <a href="<?php echo ''.URL.'';?>admin/admin_addpromo.php">Adauga o promotie</a><hr>
    <i class="fa fa-users"></i> <a href="<?php echo ''.URL.'';?>admin/admin_users.php">Utilizatori</a><hr>
    <i class="fa fa-calendar"></i> <a href="<?php echo ''.URL.'';?>admin/admin_appointments.php">Programari</a><hr>
    </div> <?php
}

function Menu()
{ ?>
    <div class="centerText"><img src="<?php echo ''.URL.'';?>images/logo.png" style="width:350; height:150;"></img></div>
    <div class='menu-container'><ul class='menu'>
    <li class='menu-item'><a href='<?php echo ''.URL.'';?>index.php'>Acasa</a></li>
    <li class='menu-item'><a href='<?php echo ''.URL.'';?>about.php'>Despre noi</a></li>
    <li class='menu-item'><a href='<?php echo ''.URL.'';?>cars.php'>Masini</a></li>
    <li class='menu-item'><a href='<?php echo ''.URL.'';?>promotions.php'>Promotii</a></li> <?php

    $name = isset($_SESSION['name']) ? $_SESSION['name'] : null;
    $isAdmin = isset($_SESSION['admin']) ? $_SESSION['admin'] : null;
    if($isAdmin) 
        $AdminCP = " / <a href='".URL."admin'><i class='fa fa-briefcase' style='color:white'></i> Admin Panel</a>";
    else
        $AdminCP = '';
    if($name)
    { 
        echo "<div style='float:right;><i class='fa fa-user' style='color:white'></i> <li class='menu-item'><a href='".URL."profile.php'><i class='fa fa-user' style='color:white'></i> Salut, $name!</a>$AdminCP / <i class='fa fa-times' style='color:white;'></i><a href='".URL."logout.php'>Log Out</a></li>";
    }
    else
        echo "<div style='float:right;'><li class='menu-item'><a href='".URL."register.php'><i class='fa fa-user-plus' style='color:white'></i> Inregistrare</a> / <a href='".URL."login.php'> <i class='fa fa-address-card' style='color:white'></i> Autentificare</a></li></div>";
    ?> </ul></div> <?php
}

function Footer()
{ ?>
    <div class='footer'>
            Copyright @ 2020 - Car Rental
            <div style='float:right;margin-right:5px;'><a href='index.php'>Pagina principala</a></div>
        </div><br> <?php
}

function Testimonials()
{ ?>
    <h1>Testimoniale</h1>
    <div class="centerText"><p style="font-size:17px;font-style:italic;">Iata cateva dintre parerile clientilor nostrii:</p></div> <?php

    $result = dbQuery("SELECT * FROM testimonials ORDER BY id DESC LIMIT 3");
    $result->execute(); ?>

    <div class="row"> <?php
    foreach($result as $row)
    {
        $name = $row['name'];
        $feedback = $row['feedback'];
        echo '<div class="col-sm">';
        echo '<div class="testimonials">';
        echo "<h3>$name</h3>";
        echo "$feedback";
        echo '</div>';
        echo '</div>';
    } ?>
    </div> <?php
}

function Car_Testimonials($carid)
{
    $result = dbQuery("SELECT * FROM car_feedback WHERE carid = '$carid' ORDER BY id DESC LIMIT 6");
    $result->execute();

    if($result->rowCount())
    {?>
        <div class="body-container"><div class="body-wall">
            <div class="centerText"><h3>Vezi ce spun clientii despre masina</h3></div><br>
            <div class="row"><?php
                foreach($result as $row)
                {
                    $name = $row['name'];
                    $feedback = $row['feedback'];?>
                    <div class="col-sm">
                        <div class="testimonials">
                            <h3><?=$name?></h3>
                            <?=$feedback?>
                        </div>
                    </div><?php
                }?>
            </div>
        </div></div><?php
    }
}

function getNewPrice($carid)
{
    $car = dbQuery("SELECT oldPrice, newPrice, until FROM promotions WHERE car_id='$carid'");
    $car->execute();
    
    if($car->rowCount())
        return $car->fetch();
    else
        return NULL;
}

function getCarPrice($carid)
{
    $car = dbQuery("SELECT price FROM cars WHERE id='$carid'");
    $car->execute();
    $row = $car->fetch();
    return $row['price'];
}

function getCarName($carid)
{
    $car = dbQuery("SELECT name FROM cars WHERE id='$carid'");
    $car->execute();
    $row = $car->fetch();
    return $row['name'];
}

function getLocationName($locationid)
{
    $location = dbQuery("SELECT location FROM locations WHERE id='$locationid'");
    $location->execute();
    $row = $location->fetch();
    return $row['location'];
}

function deleteCar($carid)
{
    vQuery("DELETE FROM cars WHERE id='$carid'");
    vQuery("DELETE FROM promotions WHERE car_id='$carid'");
    vQuery("DELETE FROM car_feedback WHERE carid='$carid'");
    vQuery("DELETE FROM appointments WHERE carid='$carid'");
}

function getCategoryName($categoryID)
{
    $category = dbQuery("SELECT name FROM cars_category WHERE id='$categoryID'");
    $category->execute();
    $row = $category->fetch();
    return $row['name'];
}