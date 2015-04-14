<section class="hhv-tabs">
	<h1>Thêm chủ đề</h1>
	<ul>
		<li><a href="<?php echo base_url(); ?>backend/tag/index" title="Chủ đề">Chủ đề</a></li>
		<li class="active"><a href="<?php echo base_url(); ?>backend/tag/add" title="Thêm chủ đề">Thêm chủ đề</a></li>
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
				<p class="label">Mô tả:</p>
				<textarea class="txtTextarea mceEditor" name="data[description]"><?php echo common_valuepost(isset($data['_post']['description'])?$data['_post']['description']:''); ?></textarea>
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
			<header>SEO</header>
			<section class="container">
				<label class="item">
					<p class="label">Meta title:</p>
					<input type="text" name="data[meta_title]" value="<?php echo common_valuepost(isset($data['_post']['meta_title'])?$data['_post']['meta_title']:''); ?>" class="txtText" />
				</label>	
				<label class="item">
					<p class="label">Meta keywords:</p>
					<input type="text" name="data[meta_keywords]" value="<?php echo common_valuepost(isset($data['_post']['meta_keywords'])?$data['_post']['meta_keywords']:''); ?>" class="txtText" />
				</label>
				<label class="item">
					<p class="label">Meta description:</p>
					<textarea class="txtTextarea" name="data[meta_description]" ><?php echo common_valuepost(isset($data['_post']['meta_description'])?$data['_post']['meta_description']:''); ?></textarea>
				</label>
			</section><!-- .container -->
		</section><!-- .block -->
	</aside>
	</form>
</section><!-- .hhv-form -->
