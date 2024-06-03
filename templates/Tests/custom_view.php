<h1>Hey there .......</h1>
<p>Custom view</p>

<!--  redirect to another action  -->
<p><a href="<?php echo $this->Url->build(['action' => 'redirectToAnotherAction']); ?>">Redirect to Another Action</a></p>

<!-- redirect to action to different controller -->
<p><a href="<?php echo $this->Url->build([ 'action' => 'redirectToAnotherControllerAction']); ?>">Redirect to Another Controller Action</a></p>

<!-- Link to redirect to current action -->
<p><a href="<?php echo $this->Url->build(['action' => 'redirectCurrentAction']); ?>">Redirect to Current Action</a></p>

