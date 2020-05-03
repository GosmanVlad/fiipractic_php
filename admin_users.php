<?php include('header.php'); 
if(!isset($_SESSION['name']) || $_SESSION['admin'] == 0)
    header("Location: index.php");
else
{
    $name = $_SESSION['name'];
}
?>

<body>
    <?php Menu() ?>
    <div class="body-container"><div class="body-wall">
    <br>
        <h1>Salut, <?php echo $name ?> !</h1>
        <div class="centerText"><p>Cauta un membru al comunitatii</div>
        <hr>
        <div class="row">
            <div class="body-wall-profile col-9"><br>
                <?php
                //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
                //  + PARTEA DE BACK -> DUPA CE SE APASA BUTONUL 'CAUTA UTILIZATOR'        //
                //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
                if(isset($_POST['edituser']))
                {
                    $name = $_POST['username'];
                    $sqlid = $_POST['sqlid'];
                    $email = $_POST['email'];
                    $admin = $_POST['admin'];
                    $employee = $_POST['employee'];

                    vQuery("UPDATE users SET name='$name', email='$email', admin='$admin', employee='$employee' WHERE id='$sqlid'");
                    
                    ?><div class="alert alert-success" role="alert">
                                Utilizator editat!
                            </div><?php

                }
                else if(isset($_POST['search']))
                {
                    if(isset($_POST['userName']))
                    {
                        $username = $_POST['userName'];

                        $search = dbQuery("SELECT * FROM users WHERE name='$username'");
                        $search->execute();

                        if($search->rowCount() > 0)
                        {
                            $row = $search->fetch();
                        
                            $sqlid = $row['id'];
                            $email = $row['email'];
                            $admin = $row['admin'];
                            $employee = $row['employee'];?>

                            <form method="POST" action="">       
                                <div class="row">
                                    <div class="col-sm">
                                        <label>SQLID:</label>
                                        <input type="text" name="sqlid" class="form-control" value="<?=$sqlid?>" readonly>
                                    </div>
                                    <div class="col-sm">
                                        <label>Nume:</label>
                                        <input type="text" name="username" class="form-control" value="<?=$username?>">
                                    </div>
                                    <div class="col-sm">
                                        <label>Email:</label>
                                        <input type="text" name="email" class="form-control" value="<?=$email?>">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-sm">
                                        <label>Admin:</label>
                                        <input type="text" name="admin" class="form-control" value="<?=$admin?>">
                                    </div>
                                    <div class="col-sm">
                                        <label>Angajat:</label>
                                        <input type="text" name="employee" class="form-control" value="<?=$employee?>">
                                    </div>
                                </div><br>
                                <div class="centerText"><button type="submit" class="btn btn-info" name="edituser">Editeaza utilizator</button></div>
                            </form><?php
                        }
                        else
                        {?>
                            <div class="alert alert-danger" role="alert">
                                Utilizator inexistent!
                            </div><?php
                        }
                    }
                }
                ?>
                <hr>
                <form method="POST" action="">
                <h2 class="centerText">Cauta un utilizator</h2>
                <div class="container">
                    <label>Nume user</label>
                    <input type="text" name="userName" class="form-control"><br>
                </div>
                <hr>
                <div class="centerText"><button type="submit" class="btn btn-success" name="search">Cauta utilizator</button></div>
            </form>
            </div>

            <?php Admin_Sidebar(); ?>
        </div>

    </div>
    </div>

    <?php Footer() ?>

</body>