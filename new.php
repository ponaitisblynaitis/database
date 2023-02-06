<?php
require_once 'database.php';

if (isset($_POST['add'])){
    $stm=$db->prepare("INSERT INTO employees (name, surname, gender, phone, birthday, education, salary, positions_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stm->execute([$_POST['name'], $_POST['surname'], $_POST['gender'], $_POST['phone'], $_POST['birthday'], $_POST['education'], $_POST['salary'], $_POST['positions_id']]);
    header("location: dataindex.php");
    die();
}

$stm=$db->prepare("SELECT id,name FROM positions");
$stm->execute([]);
$positions=$stm->fetchAll(PDO::FETCH_ASSOC);

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
            <div class="card border-danger mb-5">
                <div class="card-header text-center fw-bold bg-danger-subtle">Pridėkite naują Kolegą</div>
                <div class="card-body">
                    <form method="post" action="new.php">
                        <div class="mb-3">
                            <label class="form-label">Vardas:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pavardė:</label>
                            <input type="text" class="form-control" name="surname">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lytis:</label>
                            <input type="text" class="form-control" name="gender">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tel. nr.:</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gim. data:</label>
                            <input type="text" class="form-control" name="birthday">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Išsilavinimas:</label>
                            <input type="text" class="form-control" name="education">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Atlyginimas (EUR,€):</label>
                            <input type="text" class="form-control" name="salary">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pareigos: </label>
                               <select class="form-label" name="positions_id">
                                   <?php foreach ($positions as $position) {?>
                                        <option value="<?=$position['id']?>">
                                            <?=$position['name']?>
                                        </option>
                                   <?php } ?>
                               </select>
                        </div>
                        <div class="mb-3">
                            <button class="mb-3 btn btn-primary" name="add" value="1">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>