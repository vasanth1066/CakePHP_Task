
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake',"styles"]) ?>

</head>
<body>
    <div class="container">
        <div class="row">
            
            <div class="col-md-8">
                <?= $this->fetch('content') ?> 
            </div>
        </div>
    </div>
</body>
</html>
