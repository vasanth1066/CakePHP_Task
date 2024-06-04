
<div id="container">
    <!-- dynamically load data -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $.ajax({
        url: '<?php echo $this->Url->build(['controller' => 'Tests', 'action' => 'fetchdata']); ?>',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
               
                response.data.forEach(function(record) {
                    $('#container').append('<div>' + record.id + ' - ' + record.first_name + ' - ' + record.email + '</div>');
                });
            } else {
                $('#container').html('Error fetching records.');
            }
        }
        
    });
});
</script>
