<?php
session_start();
define("URL", "http://localhost:8080/rental/");
require("mysql.php");

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
    echo "<li class='menu-item'><a href='index.php'>Masini disponibile</a></li>";
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
        </div>";
}

function Testimonials()
{
    echo '<h1>Testimoniale</h1>
    <center><p style="font-size:17px;font-style:italic;">Iata cateva dintre parerile clientilor nostrii:</p></center>
    <div class="testimonials"><h2 style="color:black;margin-left:5px;">Vlad:</h2><p>"Masini curate, foarte bine intretinute, o experienta foarte faina!"</p></div>
    <div class="testimonials"><h2 style="color:black;margin-left:5px;">Andrei:</h2><p>"Servicii de calitate, masini curate, intretinute!"</p></div>';
}