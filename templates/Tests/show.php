<h1>Hello world</h1>

<?php
    // Access the data passed from the controller
    echo $this->Html->tag('p', $data['value1']);
    echo $this->Html->tag('p', $data['value2']);
?>



<!-- Understanding about layouts, elements and helpers. -->
<?php echo $this->Welcome->welcomeMessage(); ?>
