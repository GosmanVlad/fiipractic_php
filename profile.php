<?php include('header.php'); 
if(!isset($_SESSION['name']))
    header("Location: index.php");
else
{
    $name = $_SESSION['name'];
    $result = vQuery_Select("SELECT appt.data_predare, appt.data, appt.carid, ct.name 
                            FROM appointments as appt 
                            JOIN cars as ct 
                            ON appt.carid=ct.id 
                            WHERE appt.name='$name'
                            ORDER BY appt.id DESC");
    $result->execute();
    $today = strtotime(date("d-m-Y"));
}
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall">
    <br>
        <h1>Salut, <?php echo $name ?> !</h1>
        <center><p>Ti-am atasat aici cateva detalii despre contul tau si demersul acestuia pe website-ul nostru!</center>
        <hr>
    
        <div class="row">
            <div class="body-wall-profile col-9">
                <center><h3>Masinile inchiriate de-a lungul timpului</h3></center><br>
                <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nume masina</th>
                    <th scope="col">Status</th>
                    <th scope="col">Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach($result as $row):
                        $carName = $row['name'];
                        $data_primire = strtotime(str_replace("/", "-", $row['data']));
                        $data_predare = strtotime(str_replace("/", "-", $row['data_predare']));
                        $carid = $row['carid'];
                        ?>

                        <tr>
                        <th scope="row"><?php echo $count ?></th>
                        <td><?php echo "<a href='aboutcar.php?carid=$carid'>$carName</a>"; ?></td>
                        <?php if($today >= $data_primire && $today <= $data_predare): 
                                echo'<td><span class="badge badge-success">Activ</span></td>';
                        elseif($today < $data_primire):
                                echo '<td><span class="badge badge-warning">In asteptare</span></td>';
                         else: 
                                echo '<td><span class="badge badge-danger">Expirat</span></td>';
                         endif; 
                         ?>
                            <td><a href='leave_car_feedback.php?carid=<?php echo $carid ?>' class='btn btn-primary btn-sm'>Leave a feedback</a></td>
                        </tr>
                    <?php
                        $count++;
                    endforeach;
                    ?>
                    
                </tbody>
                </table>
            </div>

            <?php Profile_Sidebar(); ?>
        </div>

    </div>
    </div>

    <?php Footer() ?>

</body>