<?php include('header.php');

$result = vQuery_Select("SELECT ct.*, cat.name as categoryName 
                        FROM `cars` as ct 
                        JOIN `cars_category` as cat 
                        ON cat.id=ct.category 
                        ORDER BY ct.id 
                        DESC LIMIT 5");
$result->execute();
?>
<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall"><br>
        <h1>Ai nevoie de o masina?</h1>
        <center><p>Ai nimerit locul potrivit! Vezi mai jos ultimele noastre oferte.</center>
        <hr>
        <?php
        if($result->rowCount() > 0) {
           foreach($result as $row) 
           {
                $combustible = $row['combustible'];
                $transmission = $row['transmission'];
                $capacity = $row['engine_capacity'];
                $price = $row['price'];
                echo "<div class='box-container'>";
                echo "<img class='box-image' src ='".URL."images/".$row["image"]."'></img><hr>";
                echo "<p><b>".$row["name"]." (Categorie: ".$row['categoryName'].")</b></p>";
                echo "<p style='font-size:13px;'><i class='fa fa-check'></i> $transmission<br>";
                echo "<i class='fa fa-check'></i> $combustible<br>";
                echo "<i class='fa fa-check'></i> <b>Capacitate motor:</b> $capacity<p>";
                echo "<center><b style='color:green'>$price <i class='fa fa-euro'></i> / day</b></center>";
                echo "<p><center><a href='".URL."aboutcar.php?carid=".$row['id']."' class='btn btn-primary'>Afla mai multe detalii</a></center></p></div>";
           }
        }
        ?>
        <hr><br>
        <center><p style="font-size:17px;font-style:italic;">Daca una din optiunile de mai sus nu te-a atras, atunci viziteaza si pagina cu <a href="cars.php">toate masinile</a> noastre
        <br>sau, poti cere o oferta speciala pe pagina <a href="request.php">"Cere o oferta"</a>!</p></center>
        <hr>
        <?php Testimonials(); ?>
    </div></div>
    
    <div class="body-container"><div class="body-wall">
    <center><h3>Leave a feedback</h3></center><br>
    <form method="POST" action="leave_feedback.php">
        <?php 
            if(isset($_SESSION['auth'])) {
                $name = $_SESSION['name'];
                echo '<label>Nume:</label>';
                echo '<input type="text" name="username" class="form-control" value="'.$name.'" readonly>';
            }
            else {
                echo '<div class="row">
                <div class="col-sm">';
                echo '<label>Nume:</label>';
                echo '<input type="text" name="username" class="form-control" placeholder="Numele tau"></div>';

                echo '<div class="col-sm">';
                echo '<label>Email:</label>';
                echo '<input type="text" name="email" class="form-control" placeholder="Email-ul tau"></div>';
                echo '</div>';
            }
        ?><br>
        <label>Feedback</label>
        <textarea class="form-control" rows="5" name="feedback"></textarea><br>
        <button type="submit" class="btn btn-success btn-block">Trimite</button>
    </form>
    </div></div>


    <?php Footer() ?>

</body>