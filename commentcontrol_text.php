<?php

if( isset( $control->validators['validate_required'] ) ) {
	$required = true;
}
else {
	$required = false;
}

// Utils::debug( $control->errors );

if( count( $control->errors) > 0 ) {
	$error = $control->errors[0];
	// Utils::debug( $control->errors );
}
else {
	$error = false;
}

if( $control->help != NULL && $error == false ) {
	$help = $control->help;
}
else {
	$help = false;
}

?>
<div class="field info text <?php echo $id; ?><?php if( $required ): ?> required<?php endif; ?><?php if( $help ): ?> helped<?php endif; ?><?php if($error): ?> error<?php endif; ?>">
	<div class="label"><label for="<?php echo $field; ?>"><?php echo $caption; ?></label><?php if( $required ): ?> <strong class="required">(Required)</strong><?php endif; ?></div>
	<div class="value"><input type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>" value="<?php echo $value; ?>" size="22" tabindex="<?php echo $tabindex; ?>"></div>
	<?php if( $error ): ?><div class="error"><p><?php echo $error; ?></p></div><?php endif; ?>
	<?php if( $help ): ?><div class="help"><p><em><?php echo $help; ?></em></p></div><?php endif; ?>
</div>