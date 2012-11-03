<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function format_money($amount)
{
	return '$'.number_format($amount/100, 2);
}

function dumpVars($array)
{
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

function flashmsg($string, $flag = 'info') {
	$CI =& get_instance();
	$CI->session->set_userdata('monolog', $string);
	$CI->session->set_userdata('monolog_flag', $flag);
}

function showflashmsg() {
	$CI =& get_instance();
	$monolog = $CI->session->userdata('monolog');
	$monolog_flag = $CI->session->userdata('monolog_flag');
	
	if (empty($monolog)) return;
	
	?>
	<div id="monolog" class="alert alert-<?=$monolog_flag?>">
		<a class="close" data-dismiss="alert" href="#">x</a>
		<?=$monolog?>
	</div>
	<?php
	$monolog = $CI->session->unset_userdata('monolog');
}

function bootstrap_input($name, $label = '', $default = NULL, $extra = 'class="span4"')
{
?>
<div class="control-group <?php if (form_error($name)) echo 'error'; ?>">
	<?php if ( ! empty($label)): ?>
	<label class="control-label" for="<?=$name?>"><?=$label?></label>
	<?php endif; ?>
	<div class="controls">
		<input id="<?=$name?>" name="<?=$name?>" type="text" value="<?=set_value($name, $default)?>" <?=trim($extra)?>>
		<?=form_error($name)?>
	</div>
</div>
<?php
}

function bootstrap_password($name, $label = '', $default = NULL, $extra = 'class="span4"')
{
?>
<div class="control-group <?php if (form_error($name)) echo 'error'; ?>">
	<?php if ( ! empty($label)): ?>
	<label class="control-label" for="<?=$name?>"><?=$label?></label>
	<?php endif; ?>
	<div class="controls">
		<input id="<?=$name?>" name="<?=$name?>" type="password" value="<?=set_value($name, $default)?>" <?=trim($extra)?>>
		<?=form_error($name)?>
	</div>
</div>
<?php
}

function bootstrap_dropdown($name, $label = '', $options, $default = NULL, $extra = 'class="span4"')
{
?>
<div class="control-group <?php if (form_error($name)) echo 'error'; ?>">
	<?php if ( ! empty($label)): ?>
	<label class="control-label" for="<?=$name?>"><?=$label?></label>
	<?php endif; ?>
	<div class="controls">
		<?=form_dropdown($name, $options, set_value($name, $default), 'id="'.$name.'" '.trim($extra))?>
		<?php if ( ! empty($help_block)): ?>
		<p class="help-block"><?=$help_block?></p>
		<?php endif; ?>
		<?=form_error($name)?>
	</div>
</div>
<?php
}

function bootstrap_submit($name, $value, $extra = 'class="btn"')
{
?>
<input id="<?=$name?>" type="submit" value="<?=$value?>" <?=trim($extra)?>>
<?php
}