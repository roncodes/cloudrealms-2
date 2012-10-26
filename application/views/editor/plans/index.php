<div class="page-header">
	<a href="#create-form" data-toggle="modal" class="btn pull-right">Create Plan</a>
	<h1>All Plans</h1>
</div>
<?php if ($plans->count > 0): ?>
<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Price</th>
			<th>Trial Period</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($plans->data as $plan): ?>
		<tr>
			<td><?=$plan->id?>
			<td><?=$plan->name?></td>
			<td><?=format_money($plan->amount)?>/<?=$plan->interval?></td>
			<td><?php if ( ! empty($plan->trial_period_days)) echo $plan->trial_period_days.' days'; ?></td>
			<td><a href="#delete-form" data-id="<?=$plan->id?>" data-toggle="modal" class="delete"><i class="icon-trash"></i></a></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
<div class="alert alert-error">There are no plans</div>
<?php endif; ?>
<?=form_open(base_url('admin/plans/create'), 'class="form-horizontal"')?>
<div class="modal" id="create-form">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3>Create Plan</h3>
	</div>
	<div class="modal-body">
		<?php if (isset($create_error)): ?>
		<div class="alert alert-error"><?=$create_error?></div>
		<?php endif; ?>
		<?=bootstrap_input('id', 'ID*', NULL, 'class="span3"')?>
		<?=bootstrap_input('name', 'Name*', NULL, 'class="span3"')?>
		<?=bootstrap_input('amount', 'Amount*', NULL, 'class="span3"')?>
		<?=bootstrap_dropdown('interval', 'Interval*', $intervals, NULL, 'class="span3"')?>
		<?=bootstrap_input('trial_period_days', 'Trial period days', NULL, 'class="span3"')?>
	</div>
	<div class="modal-footer">
		<?=bootstrap_submit('submit', 'Create Plan', 'class="btn btn-primary"')?>
		<a href="#" class="btn" data-dismiss="modal">Close</a>
	</div>
</div>
<?=form_close()?>
<script>
<?php if (validation_errors() || isset($create_error)): ?>
$('#create-form').modal({show: 'true'});
<?php else: ?>
$('#create-form').modal();
$('#create-form').modal('hide');
<?php endif; ?>
</script>
<?=form_open(base_url('admin/plans/delete'), 'class="form-horizontal"')?>
	<div class="modal" id="delete-form">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">×</a>
			<h3>Confirm Deletion</h3>
		</div>
		<div class="modal-body">
			<?php if (isset($delete_error)): ?>
			<div class="alert alert-error"><?=$create_error?></div>
			<?php endif; ?>
			<p>Are you sure you want to delete this plan? This action cannot be undone.</p>
			<input type="hidden" name="id" value="">
		</div>
		<div class="modal-footer">
			<?=bootstrap_submit('submit', 'Delete Plan', 'class="btn btn-danger"')?>
			<a href="#" class="btn" data-dismiss="modal">Cancel</a>
		</div>
	</div>
<?=form_close()?>
<script>
$(document).ready(function() {
	$('.delete').on('click', function(e) {
		$('#delete-form').find('input[name="id"]').val($(this).attr('data-id'));
	});
});
$('#delete-form').modal();
<?php if ( ! isset($delete_error)): ?>
$('#delete-form').modal('hide');
<?php endif; ?>
</script>