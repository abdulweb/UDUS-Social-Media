<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			<?php echo e(trans('common.page_settings')); ?>

		</h3>
	</div>
	<div class="panel-body">
		<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<form method="POST" action="<?php echo e(url('admin/page-settings')); ?>">

			<?php echo e(csrf_field()); ?>

			<div class="privacy-question">

				<ul class="list-group">
					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							<?php echo e(Form::label('page_member_privacy', trans('admin.page_member_privacy'))); ?>

							<?php echo e(Form::select('page_member_privacy', array('members' => trans('common.members'), 'only_admins' => trans('admin.only_admins')), Setting::get('page_member_privacy', 'only_admins'), ['class' => 'form-control', 'placeholder' => trans('admin.please_select')])); ?>

						</fieldset>						
					</li>

					<li href="#" class="list-group-item">
						<fieldset class="form-group">
							<?php echo e(Form::label('page_timeline_post_privacy', trans('admin.page_timeline_post_privacy'))); ?>

							<?php echo e(Form::select('page_timeline_post_privacy', array('everyone' => trans('common.everyone'), 'only_admins' => trans('admin.only_admins')) , Setting::get('page_timeline_post_privacy', 'everyone') , ['class' => 'form-control', 'placeholder' => trans('admin.please_select')])); ?>

						</fieldset>
					</li>
				</ul>
				<div class="pull-right">
					<?php echo e(Form::submit(trans('common.save_changes'), ['class' => 'btn btn-success'])); ?>

				</div>
			</div>
		<?php echo e(Form::close()); ?>

		
	</div>
</div><!-- /panel -->

<div class="panel panel-default">
	<div class="panel-heading no-bg panel-settings">
		<h3 class="panel-title">
			<?php echo e(trans('admin.manage_page_categories')); ?>

			<span class="btn-custom btn-rtl">
				<a href="<?php echo e(url('admin/category/create')); ?>" class="btn btn-default"><?php echo e(trans('admin.create_category')); ?></a>
			</span>
		</h3>
	</div>
	<div class="panel-body">
		<div class="announcement-container table-responsive">	
			<table class="table announcements-table">
				<thead>
			    	<th><?php echo e(trans('admin.name')); ?></th>
			        <th><?php echo e(trans('common.description')); ?></th>	 
			        <th><?php echo e(trans('common.status')); ?></th>
			        <th><?php echo e(trans('admin.action')); ?></th>
		    	</thead>
			    <tbody>
			     <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    	<tr>
			        	<td><?php echo e($categorie->name); ?></td>
			            <td> 
			            	<span class="description">
			            		<?php echo e(str_limit($categorie->description, 50)); ?>			            		 
			            	</span>
						</td> 
						<td>
							<?php if($categorie->active == 1): ?>
								<?php echo e(trans('admin.active')); ?>

							<?php else: ?>
								<?php echo e(trans('admin.inactive')); ?>

							<?php endif; ?>
						</td>
						<td>
							<ul class="list-inline">	
								<li><a href="<?php echo e(url('admin/category/'.$categorie->id.'/edit')); ?>"><span class="pencil-icon bg-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a></li>
								<li><a href="#" data-categorie-id="<?php echo e($categorie->id); ?>" class="category-delete"><span class="trash-icon bg-danger"><i class="fa fa-trash" aria-hidden="true"></i></span></a></li>
							</ul>
						</td>
			        </tr>			        
			        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			    </tbody>
			</table>
			<div class="pagination-holder">
				<?php echo e($categories->render()); ?>

			</div>	
		</div>
	</div>
</div>
<?php echo Theme::asset()->container('footer')->usePath()->add('admin', 'js/admin.js'); ?>

