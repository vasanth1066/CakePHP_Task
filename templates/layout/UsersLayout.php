
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>

    <?= $this->Html->css("dashboard") ?>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md">
                <?= $this->fetch('content') ?> 
            </div>
        </div>
    </div>
</body>
</html>
