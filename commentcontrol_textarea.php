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
<div class="field info textarea <?php echo $id; ?><?php if( $required ): ?> required<?php endif; ?><?php if( $help ): ?> helped<?php endif; ?><?php if($error): ?> error<?php endif; ?>">
	<div class="label">
		<label for="<?php echo $field; ?>"><?php echo $caption; ?></label>
		<?php if( $error ): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>
		<?php if( $help ): ?><p class="help"><em><?php echo $help; ?></em></p><?php endif; ?>
	</div>
	<div class="value">
		<textarea name="<?php echo $field; ?>" id="<?php echo $field; ?>" cols="100" rows="10" tabindex="<?php echo $tabindex; ?>"><?php echo $value; ?></textarea>
	</div>
</div>