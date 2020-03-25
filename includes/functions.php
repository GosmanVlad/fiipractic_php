<?php
session_start();
define("URL", "http://localhost:8080/rental/");
require("mysql.php");

function category_Menu($page)
{
    echo '<center>';
    if($page==0)
        echo"<a href='".URL."cars.php' style='margin-left:5px;' class='btn btn-danger'>Toate masinile</a>";
    else
        echo"<a href='".URL."cars.php' style='margin-left:5px;' class='btn btn-primary'>Toate masinile</a>";
    $category2 = vQuery_Select("SELECT * FROM cars_category");
    $category2->execute();
    foreach($category2 as $row)
    {
        $id = $row['id']; 
        $name = $row['name'];
        if($page == $id)
            echo"<a href='".URL."cars.php?category=$id' style='margin-left:5px;'class='btn btn-danger'>$name</a>";
        else
            echo"<a href='".URL."cars.php?category=$id' style='margin-left:5px;' class='btn btn-primary'>$name</a>";
    }
    echo '</center><hr>';
}
function vQuery($query)
{
    require("mysql.php");
    $conn->exec($query);
}

function vQuery_Select($query)
{
    require("mysql.php");
    $statement = $conn->prepare($query);
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $statement->fetchAll();
    return $statement;
}

function Menu()
{
    echo '<center><img src="images/logo.png" style="width:350; height:150;"></img></center>';
    echo "<div class='menu-container'><ul class='menu'>";
    echo "<li class='menu-item'><a href='index.php'>Acasa</a></li>";
    echo "<li class='menu-item'><a href='about.php'>Despre noi</a></li>";
    echo "<li class='menu-item'><a href='cars.php'>Masini</a></li>";
    echo "<li class='menu-item'><a href='index.php'>Cere o oferta</a></li>";
    if(isset($_SESSION['auth']))
    {
        $name = $_SESSION['name'];
        echo "<div style='float:right;><i class='fa fa-user' style='color:white'></i> <li class='menu-item'><a href='logout.php'><i class='fa fa-user' style='color:white'></i> Salut, $name!</a> / <i class='fa fa-times' style='color:white;'></i><a href='logout.php'>Log Out</a></li>";
    }
    else
        echo "<div style='float:right;'><li class='menu-item'><a href='register.php'><i class='fa fa-user-plus' style='color:white'></i> Inregistrare</a> / <a href='login.php'> <i class='fa fa-address-card' style='color:white'></i> Autentificare</a></li></div>";
    echo "</ul></div>";
}

function Footer()
{
    echo 
        "<div class='footer'>
            Copyright @ 2020 - Car Rental
            <div style='float:right;margin-right:5px;'><a href='index.php'>Pagina principala</a></div>
        </div><br>";
}

function Testimonials()
{
    echo '<h1>Testimoniale</h1>
    <center><p style="font-size:17px;font-style:italic;">Iata cateva dintre parerile clientilor nostrii:</p></center>';

    $result = vQuery_Select("SELECT * FROM testimonials ORDER BY id DESC LIMIT 3");
    $result->execute();

    echo '<div class="row">';
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
    }
    echo '</div>';
}