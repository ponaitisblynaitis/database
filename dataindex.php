<?php
require_once 'database.php';

if (isset($_GET['delete'])) {
    $stm=$db->prepare("DELETE FROM employees WHERE id=?");
    $stm->execute([$_GET['delete']]);
}

$result = $db -> query('
SELECT 
    `employees`.*,
    `positions`.`name` as `position_name` 
FROM `employees`
    LEFT JOIN positions ON `employees`.`positions_id` = `positions`.`id`');
$data = $result -> fetchAll(PDO::FETCH_ASSOC);

$info = $db -> query("SELECT * FROM positions");
$posdata = $info -> fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Imones Info</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <?php include_once 'category_picker.php'?>
            <div class="col-md-12 mt-5">
                <div class="card border-danger">
                    <div class="card-header text-center fw-bold bg-danger-subtle">Darbuotojai</div>
                    <div class="card-body">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a class="btn btn-primary " role="button" href="new.php">Add New</a>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">Vardas</th>
                                <th class="text-center">Pavardė</th>
                                <th class="text-center">Atlyginimas (EUR,€)</th>
                                <th class="text-center">Pareigos</th>
                            </tr>
                            </thead>
                            <?php foreach ($data as $datum){ ?>
                                <tr>
                                    <td class="text-center"><?=$datum['name']?></td>
                                    <td class="text-center"><?=$datum['surname']?></td>
                                    <td class="text-center"><?=$datum['salary']/100?></td>
                                    <td class="text-center"><?=$datum['position_name']?></td>
                                    <td><a class="btn btn-dark" href="more.php?id=<?=$datum['id']?>">More</a></td>
                                    <td><a class="btn btn-success" href="update.php?id=<?=$datum['id']?>">Edit</a></td>
                                    <td><a class="btn btn-danger" href="dataindex.php?delete=<?=$datum['id']?>">Delete</a></td>
                                </tr>
                            <?php } ?>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5">
                <div class="card mb-5 border-danger">
                    <div class="card-header text-center fw-bold bg-danger-subtle">Pareigos</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Vardas</th>
                                <th>Atlyginimas (EUR,€)</th>
                            </tr>
                            </thead>
                            <?php foreach ($posdata as $position){ ?>
                                <tr>
                                    <td><?=$position['name']?></td>
                                    <td><?=$position['base_salary']/100?></td>

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