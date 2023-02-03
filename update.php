<?php
require_once 'database.php';

$id = (int)$_GET['id'];
$stm=$db->prepare("SELECT * FROM employees WHERE id=?");
$stm->execute([$id]);
$data=$stm->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $stm = $db->prepare("UPDATE employees SET name=?, surname=?, gender=?, phone=?, birthday=?, education=?, salary=? WHERE id=?");
    $stm->execute([$_POST['name'], $_POST['surname'], $_POST['gender'], $_POST['phone'], $_POST['birthday'], $_POST['education'], $_POST['salary'], $id]);
    header("location: dataindex.php");
    die();
}
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
                <div class="card-header text-center fw-bold bg-danger-subtle">Koregavimas</div>
                <div class="card-body">
                    <form method="post" action="update.php?id=<?=$data['id']?>">
                        <div class="mb-3">
                            <label class="form-label">Vardas:</label>
                            <input type="text" class="form-control" name="name" value="<?=$data['name']?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pavardė:</label>
                            <input type="text" class="form-control" name="surname" value="<?=$data['surname']?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lytis:</label>
                            <input type="text" class="form-control" name="gender" value="<?=$data['gender']?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tel. nr.:</label>
                            <input type="text" class="form-control" name="phone" value="<?=$data['phone']?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gim. data:</label>
                            <input type="text" class="form-control" name="birthday" value="<?=$data['birthday']?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Išsilavinimas:</label>
                            <input type="text" class="form-control" name="education" value="<?=$data['education']?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Atlyginimas (EUR,€):</label>
                            <input type="text" class="form-control" name="salary" value="<?=$data['salary']?>">
                        </div>
                        <button class="btn btn-primary" name="update" value="1">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>