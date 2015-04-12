<section class="hhv-tabs">
	<h1>Thêm nhóm thành viên</h1>
	<ul>
		<li><a href="<?php echo base_url(); ?>backend/user/group" title="Nhóm thành viên">Nhóm thành viên</a></li>
		<li class="active"><a href="<?php echo base_url(); ?>backend/user/addgroup" title="Thêm nhóm thành viên">Thêm nhóm thành viên</a></li>
	</ul>
</section>

<section class="hhv-form">
	<form method="post" action="">
	<section class="main-panel main-panel-single">
		<header>Thông tin chung</header>
		<?php echo common_showerror(validation_errors()); ?>
		<section class="block">
			<label class="item">
				<p class="label">Tiêu đề:</p>
				<input type="text" name="data[title]" value="<?php echo common_valuepost(isset($data['_post']['title'])?$data['_post']['title']:''); ?>" class="txtText" />
			</label>
			
			<section class="checkbox-radio">
				<p class="label">Trạng thái:</p>
				<section class="group">
					<label><input type="radio" name="data[allow]" value="1" <?php echo common_valuepost(isset($data['_post']['allow'])?(($data['_post']['allow'] == 1)?'checked="checked"':''):''); ?> /><span>Cho phép</span></label>
					<label><input type="radio" name="data[allow]" value="0" <?php echo common_valuepost(isset($data['_post']['allow'])?(($data['_post']['allow'] == 0)?'checked="checked"':''):''); ?> /><span>Không cho phép</span></label>
				</section>
			</section>

			<label class="item">
				<p class="label">Nội dung:</p>
				<textarea class="txtTextarea" name="data[group]"><?php echo common_valuepost(isset($data['_post']['group'])?$data['_post']['group']:''); ?></textarea>
			</label>

			<section class="action">
				<p class="label">Thao tác:</p>
				<section class="group">
					<input type="submit" name="add" value="Thêm mới" />
					<input type="reset" name="add" value="Làm lại" />
					
				</section>
			</section>
		</section><!-- .block -->
	</section><!-- .main-panel -->
	</form>
</section><!-- .hhv-form -->
