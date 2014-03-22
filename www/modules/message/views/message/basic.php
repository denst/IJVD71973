<div class="alert alert-<?php echo $message->type; ?>">
<?php
    if( is_array( $message->message ) ) {
		foreach( $message->message as $msg ) {
            echo "{$msg}<br/>";
		}
	} else {
        echo $message->message;
    }
?>
</div>