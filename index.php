<?php include('header.php');

if(isset($_SESSION['name'])) 
    $name = $_SESSION['name'];

$result = dbQuery("SELECT ct.*, cat.name as categoryName 
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
        <div class="centerText"><p>Ai nimerit locul potrivit! Vezi mai jos ultimele noastre oferte.</div>
        <hr>
        <?php
        if ($result) :
            foreach ($result as $row) : ?>
                <div class='box-container'>
                    <img class='box-image' src ='images/<?= $row["image"] ?>' alt='Imageine' /><hr />
                    <p><b><?= $row["name"] ?>(Categorie: <?= $row['categoryName'] ?>)</b></p>
                    <p style='font-size:13px;'>
                        <i class='fa fa-check'></i><?= $row['transmission'] ?><br>
                        <i class='fa fa-check'></i><?= $row['combustible'] ?><br>
                        <i class='fa fa-check'></i><b>Capacitate motor:</b> <?= $row['engine_capacity'] ?>
                    <p>
                    <p style='color:green; text-align: center;'><b><?= $row['price'] ?> <i class='fa fa-euro'></i> / day</b></p>
                    <p style='text-align: center;'>
                        <a href='aboutcar.php?carid=<?= $row['id'] ?>' class='btn btn-primary'>Afla mai multe detalii</a>
                    </p>
                </div>
            <?php endforeach;
        endif;
        ?>
        <hr><br>
        <div class="centerText"><p class="pInfo">Daca una din optiunile de mai sus nu te-a atras, atunci viziteaza si pagina cu <a href="cars.php">toate masinile</a> noastre
        <br>sau urmareste promotiile saptamanale pe pagina de <a href="promotions.php">"Promotii"</a>!</p></div>
        <hr>
        <?php Testimonials(); ?>
    </div></div>
    
    <div class="body-container"><div class="body-wall">
    <div class="centerText"><h3>Leave a feedback</h3></div><br>

    <form method="POST" action="leave_feedback.php">
        <?php $name = isset($_SESSION['name']) ? $_SESSION['name'] : null; ?>
        <?php if ($name) : ?>
            <input type="text" name="username" class="form-control" placeholder="Numele tau" value="<?= $name ?>" readonly /><br />
        <?php else : ?>
            <div class="row">
                <div class="col-sm">
                    <label>Nume:</label>
                    <input type="text" name="username" class="form-control" placeholder="Numele tau" />
                </div>
                <div class="col-sm">
                    <label>Email:</label>
                    <input type="text" name="email" class="form-control" placeholder="Email-ul tau">
                </div>
            </div>
        <?php endif; ?>
        <label>Feedback</label>
        <textarea class="form-control" rows="5" name="feedback"></textarea><br>
        <button type="submit" class="btn btn-success btn-block">Trimite</button>
    </form>

    </div></div>


    <?php Footer() ?>

</body>