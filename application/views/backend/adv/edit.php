<section class="hhv-tabs">
	<h1>Sửa quảng cáo</h1>
	<ul>
		<li><a href="<?php echo base_url(); ?>backend/adv/index" title="Quảng cáo">Quảng cáo</a></li>
		<li><a href="<?php echo base_url(); ?>backend/adv/add" title="Thêm quảng cáo">Thêm quảng cáo</a></li>
	</ul>
</section>

<section class="hhv-form">
	<form method="post" action="">
	<section class="main-panel">
		<header>Thông tin chung</header>
		<?php echo common_showerror(validation_errors()); ?>
		<section class="block">
			<label class="item">
				<p class="label">Tiêu đề:</p>
				<input type="text" name="data[title]" value="<?php echo common_valuepost(isset($data['_post']['title'])?$data['_post']['title']:''); ?>" class="txtText" />
			</label>
			
			<label class="item">
				<p class="label">Vị trí hiển thị:</p>
				<?php echo form_dropdown('data[position]', array(
					'' => '- Chọn vị trí -',
					'Bên phải' => 'Bên phải'
					), common_valuepost(isset($data['_post']['position'])?$data['_post']['position']:''),'class="cbSelect"');
				?>
			</label>

			<label class="item">
				<p class="label">Nội dung:</p>
				<textarea class="txtTextarea mceEditor" name="data[content]"><?php echo common_valuepost(isset($data['_post']['content'])?$data['_post']['content']:''); ?></textarea>
			</label>

			<section class="action">
				<p class="label">Thao tác:</p>
				<section class="group">
					<input type="submit" name="edit" value="Sửa đổi" />
					<input type="reset" name="add" value="Làm lại" />
					
				</section>
			</section>
		</section><!-- .block -->
	</section><!-- .main-panel -->
	<aside class="side-panel">
		<section class="block">
			<header>Nâng cao</header>
			<section class="container">
				<section class="checkbox-radio">
					<p class="label">Hiển thị:</p>
					<section class="group">
						<label><input type="radio" name="data[publish]" value="1" <?php echo common_valuepost(isset($data['_post']['publish'])?(($data['_post']['publish'] == 1)?'checked="checked"':''):''); ?> /><span>Có</span></label>
						<label><input type="radio" name="data[publish]" value="0" <?php echo common_valuepost(isset($data['_post']['publish'])?(($data['_post']['publish'] == 0)?'checked="checked"':''):''); ?> /><span>Không</span></label>
					</section>
				</section>
			</section><!-- .container -->
		</section><!-- .block -->
		<section class="block">
			<header>Thời gian</header>
			<section class="container">
				<label class="item">
					<p class="label">Thời gian bắt đầu:</p>
					<input type="text" name="data[time_start]" value="<?php echo common_valuepost(isset($data['_post']['time_start'])?$data['_post']['time_start']:''); ?>" class="txtText" id="txtTimestart" />
				</label>	
				<label class="item">
					<p class="label">Thời gian kết thúc:</p>
					<input type="text" name="data[time_end]" value="<?php echo common_valuepost(isset($data['_post']['time_end'])?$data['_post']['time_end']:''); ?>" class="txtText" id="txtTimeend"/>
				</label>
			</section><!-- .container -->
		</section><!-- .block -->
	</aside>
	</form>
</section><!-- .hhv-form -->
