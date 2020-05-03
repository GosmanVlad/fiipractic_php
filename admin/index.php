<?php include('../header.php');
if(!isset($_SESSION['name']) || $_SESSION['admin'] == 0)
    header("Location: ../index.php");
else
{
    $name = $_SESSION['name'];

    $records = dbQuery("SELECT (SELECT COUNT(*) FROM  cars) AS total_cars,
                               (SELECT COUNT(*) FROM  users) AS total_users,
                               ((SELECT COUNT(*) FROM testimonials) + (SELECT COUNT(*) FROM car_feedback)) AS total_feedbacks,
                               (SELECT COUNT(*) FROM promotions) AS total_promotions,
                               (SELECT COUNT(*) FROM appointments) AS total_appointments
                        FROM  dual");
    $records->execute();
    $row = $records->fetch();
    $total_cars = $row['total_cars'];
    $total_users = $row['total_users'];
    $total_feedbacks = $row['total_feedbacks'];
    $total_promotions = $row['total_promotions'];
    $total_appointments = $row['total_appointments'];
}
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall">
    <br>
        <h1>Salut, <?php echo $name ?> !</h1>
        <div class="centerText"><p>De aici poti controla intregul website!</div>
        <hr>
    
        <div class="row">
            <div class="body-wall-profile col-9">
            <div class="centerText"><h3>Statistici website</h3></div><br>
                <div class="card">
                    <div class="card-header bg-info"><div class="textAdminCP"><i class="fa fa-car"></i> Total masini: <?=$total_cars?> | Total promotii: <?=$total_promotions?> | Total programari: <?=$total_appointments?></div></div>
                    <div class="card-header bg-info"><div class="textAdminCP"><i class="fa fa-users"></i> Total useri: <?=$total_users?> | Total testimoniale: <?=$total_feedbacks?></div></div>
            </div>
            </div>

            <?php Admin_Sidebar(); ?>
        </div>

    </div>
    </div>

    <?php Footer() ?>

</body>