<section class="title">
	<h4><?php echo lang('county:counties'); ?></h4>
</section>

<section class="item">
<div class="content">

	<?php if ($counties['total'] > 0): ?>
	
		<table class="table" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th><?php echo lang('county:question'); ?></th>
					<th><?php echo lang('county:answer'); ?></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($faqs['entries'] as $faq): ?>
				<tr>
					<td><?php echo $faq['question']; ?></td>
					<td><?php echo $faq['answer']; ?></td>
					<td class="actions"><?php echo anchor('admin/county/edit/' . $faq['id'], lang('global:edit'), 'class="button edit"'); ?>
                                            <?php echo anchor('admin/county/delete/' . $faq['id'], lang('global:delete'), array('class' => 'confirm button delete')); ?>
                                        </td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		<?php echo $faqs['pagination']; ?>
		
	<?php else: ?>
		<div class="no_data"><?php echo lang('county:no_counties'); ?></div>
	<?php endif;?>
	
</div>
</section>