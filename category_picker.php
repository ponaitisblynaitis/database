<?php
$stm=$db->prepare("SELECT id,name FROM positions");
$stm->execute([]);
$positions=$stm->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="col-md-12 mt-5">
    <div class="card border-danger">
        <div class="card-header text-center fw-bold bg-danger-subtle">Esamos pareigybės</div>
        <div class="card-body">
            <?php foreach ($positions as $position){ ?>
                <a href="category.php?id=<?=$position['id']?>" class="btn btn-outline-success rounded-0"><?=$position['name']?></a>
            <?php } ?>

            <a href="dataindex.php" class="btn btn-outline-danger rounded-0 float-end ">Visi</a>
        </div>
    </div>
</div>