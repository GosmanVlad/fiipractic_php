<?php include('header.php'); ?>

<body>
    <?php Menu() ?>
    <div class="body-container"><br>
        <h1>Ai nevoie de o masina?</h1>
        <center><p>Ai nimerit locul potrivit! Vezi mai jos ultimele noastre oferte.</center>
        <hr>
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
                    echo "<p><b>".$row["name"]." (Categorie: ".$row2['name'].")</b></p>";
                }
                echo "<p>center</p>";
                echo "<p><center><a href=''.URL.'cars.php?carid=".$row['id']."' class='btn btn-primary'>Afla mai multe detalii</a></center></p></div>";
           }
        }
        ?>
        <hr><br>
        <center><p style="font-size:17px;font-style:italic;">Daca una din optiunile de mai sus nu te-a atras, atunci viziteaza si pagina cu <a href="cars.php">toate masinile</a> noastre
        <br>sau, poti cere o oferta speciala pe pagina <a href="request.php">"Cere o oferta"</a>!</p></center>
        <br><hr>
        <?php Testimonials(); ?>
    </div>

    <?php Footer() ?>

</body>