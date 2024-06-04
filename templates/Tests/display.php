

<h1>Display all Data</h1>
<table>

    <?= $this->Form->create(null,['type'=>'get']);?>
    <?= $this->Form->control('key',['label'=>'Search Data','value'=>$this->request->getQuery('key')]);?>
    <?=  $this->Form->submit('search');?>
    <?=  $this->Form->end();?>
     
   
   
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th>Email </th>
            <th><?= $this->Paginator->sort('first_name') ?></th>
            <th>Action</th>
   
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tests as $test): ?>
        <tr>
            <td><?= $test->id ?></td>
            <td><?= $test->email ?></td>
            <td><?= $test->first_name ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['controller' => 'Tests', 'action' => 'edit', $test->id]) ?>
            </td>
          
        </tr>
        <?php endforeach; ?>

        <center><?= $this->Html->link(('Add a new data'), ['controller' => 'Tests', 'action' => 'add']) ?></center>
        <?= $this ->Flash->render() ?> 
        <!-- Display the flash message  -->
       
    </tbody>
</table>
<?php
// echo $this->Paginator->prev('<< Previous');
// echo $this->Paginator->numbers();
// echo $this->Paginator->next('Next >>');

?>
<!-- Add Use paginator helper  for pagination. -->
<div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<<  First') ?>
            <?= $this->Paginator->prev('< Previous') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('Next >') ?>
            <?= $this->Paginator->last('Last >>') ?>
        </ul>

    </div>