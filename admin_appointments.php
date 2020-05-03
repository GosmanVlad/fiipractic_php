<?php include('header.php'); 
if(!isset($_SESSION['name']) || $_SESSION['admin'] == 0)
    header("Location: index.php");
else
{
    $name = $_SESSION['name'];

    $records = dbQuery("SELECT * FROM appointments ORDER BY id AND approved");
    $records->execute();
}
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall">
    <br>
        <h1>Salut, <?php echo $name ?> !</h1>
        <div class="centerText"><p>De aici poti vedea programarile!</div>
        <hr>
    
        <div class="row">
            <div class="body-wall-profile col-9">
            <div class="centerText"><h3>Programari masini</h3></div><br>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nume</th>
                    <th scope="col">Masina</th>
                    <th scope="col">Data primirii</th>
                    <th scope="col">Data predarii</th>
                    <th scope="col">Locatie primire</th>
                    <th scope="col">Numar de telefon</th>
                    <th scope="col">Alte detalii</th>
                    <th scope="col">Status</th>
                    <th scope="col">Admin</th>
                    </tr>
                </thead>
                <tbody><?php
                foreach($records as $row)
                {
                    $id = $row['id'];
                    $name = $row['name'];
                    $carid = $row['carid'];
                    $data_primire = $row['data'];
                    $data_predare = $row['data_predare'];
                    $location = $row['location'];
                    $additions = $row['additions'];
                    $phone = $row['phone'];
                    $approved = $row['approved']; 
                    $approved == 1 ? $status = '<span class="badge badge-success">Aprobat</span>' : $status='<span class="badge badge-danger">Neaprobat</span>';?>
                    <tr>
                        <th scope="row"><?=$id?></th>
                        <td><?=$name?></td>
                        <td><?php echo getCarName($carid) ?></td>
                        <td><?=$data_primire?></td>
                        <td><?=$data_predare?></td>
                        <td><?php echo getLocationName($location)?></td>
                        <td><?=$phone?></td>
                        <td><?=$additions?></td>
                        <td><?=$status?></td>
                        <td>
                            <a href="admin_appointments_back.php?page=delete&id=<?=$id?>" class="btn btn-danger btn-sm">Sterge</a>
                            <?php if($approved == 0) { ?>
                                <a href="admin_appointments_back.php?page=approve&id=<?=$id?>" class="btn btn-info btn-sm">Aproba</a>
                            <?php } else { ?>
                                <a href="admin_appointments_back.php?page=disapprove&id=<?=$id?>" class="btn btn-warning btn-sm">Dezaproba</a>
                            <?php } ?>
                        </td>
                    </tr><?php
                }?>
                </tbody>
            </table>
            </div>

            <?php Admin_Sidebar(); ?>
        </div>

    </div>
    </div>

    <?php Footer() ?>

</body>