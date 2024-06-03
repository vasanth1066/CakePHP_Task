<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publisher</title>
    <?= $this->Html->meta('icon') ?>


    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake',"styles"]) ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div>
        <div class="Header">
        <?php
                $heading = 'Publisher';
                $this->set('heading', $heading);
                echo $this->element('header', ['heading' => $heading]);
            ?>
        </div>
        <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
        
    </div>
</body>
</html>

