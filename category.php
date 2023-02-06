<?php

require_once 'database.php';

if (isset($_GET['delete'])) {
    $stm=$db->prepare("DELETE FROM employees WHERE id=?");
    $stm->execute([$_GET['delete']]);
}


$stm=$db->prepare("SELECT * FROM employees WHERE positions_id=?");
$stm->execute([$_GET['id']]);
$posdata=$stm->fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <?php include_once 'category_picker.php'?>
        <div class="col-md-12 mt-5">
            <div class="card mb-5 border-danger">
                <div class="card-header text-center fw-bold bg-danger-subtle">Pareigos</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">Vardas</th>
                            <th class="text-center">Pavardė</th>
                            <th class="text-center">Lytis</th>
                            <th class="text-center">Tel. nr.</th>
                            <th class="text-center">Gim. data</th>
                            <th class="text-center">Išsilavinimas</th>
                            <th class="text-center">Atlyginimas (EUR,€)</th>
                        </tr>
                        </thead>
                        <?php foreach ($posdata as $position){ ?>
                            <tr>
                                <td class="text-center"><?=$position['name']?></td>
                                <td class="text-center"><?=$position['surname']?></td>
                                <td class="text-center"><?=$position['gender']?></td>
                                <td class="text-center"><?=$position['phone']?></td>
                                <td class="text-center"><?=$position['birthday']?></td>
                                <td class="text-center"><?=$position['education']?></td>
                                <td class="text-center"><?=$position['salary']/100?></td>

                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>