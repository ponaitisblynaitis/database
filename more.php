<?php
require_once 'database.php';

$id = (int)$_GET['id'];
$stm=$db->prepare("SELECT * FROM employees WHERE id=?");
$stm->execute([$id]);
$data=$stm->fetch(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Darbuotojų Info</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <button class="btn btn-dark mb-3" onclick="history.go(-1);">Go Back</button>
            <div class="card border-danger">
                <div class="card-header text-center fw-bold bg-danger-subtle">Suvestinė</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID#</th>
                            <th>Vardas</th>
                            <th>Pavardė</th>
                            <th>Lytis</th>
                            <th>Tel. nr.</th>
                            <th>Gim. data</th>
                            <th>Išsilavinimas</th>
                            <th>Atlyginimas (EUR,€)</th>
                        </tr>
                        </thead>
                            <tr>
                                <td><?=$data['id']?></td>
                                <td><?=$data['name']?></td>
                                <td><?=$data['surname']?></td>
                                <td><?=$data['gender']?></td>
                                <td><?=$data['phone']?></td>
                                <td><?=$data['birthday']?></td>
                                <td><?=$data['education']?></td>
                                <td><?=$data['salary']/100?></td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header bg-danger-subtle">
                    <b>Mokesčiai</b>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Pajamų mokestis 20 %</td>
                            <td><?= (($data['salary']/100 - 272)*0.20)." EUR" ?></td>
                        </tr>
                        <tr>
                            <td>Sveikatos Draudimas 6,98 %</td>
                            <td><?= round(($data['salary']/100 - 272)*0.068 ,1)." EUR" ?></td>
                        </tr>
                        <tr>
                            <td>Soc. draudimas 12,52 %</td>
                            <td><?= (($data['salary']/100 - 272)*0.125)." EUR" ?></td>
                        </tr>
                        <tr>
                            <td> Į rankas</td>
                            <td><?= round(($data['salary']/100)-(($data['salary']/100 - 272)*0.125)-(($data['salary']/100 - 272)*0.20)-(($data['salary']/100 - 272)*0.068) ,2)." EUR" ?></td>
                        </tr>
                        <tr>
                            <td>Sodros 1.77%</td>
                            <td>
                                <?= round((($data['salary']/100 - 272)*0.017),2)." EUR" ?>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>