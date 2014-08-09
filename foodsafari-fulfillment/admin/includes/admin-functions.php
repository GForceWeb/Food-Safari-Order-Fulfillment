<?php


add_action( 'post_submitbox_misc_actions', 'my_post_submitbox_misc_actions' );

function my_post_submitbox_misc_actions(){
?>
<div class="misc-pub-section my-options">
	<label for="my_custom_post_action">My Option</label><br />
	<select id="my_custom_post_action" name="my_custom_post_action">
		<option value="1">First Option goes here</option>
		<option value="2">Second Option goes here</option>
	</select>
</div>
<?php
}



?>