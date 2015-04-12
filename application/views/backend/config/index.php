<section class="hhv-tabs">
	<h1>Cấu hình hệ thống</h1>
	<?php
	$_tabs = array(
		'seo' => 'SEO',
		'frontend' => 'Trang chủ', 
	);

	echo '<ul>';
	foreach ($_tabs as $key => $val) {
		echo '<li '.(($data['_group']==$key)?'class="active"':'').'><a href="'.HHV_BASE_URL.'backend/config/index/'.$key.' " title="Cấu hình '.$val.'">'.$val.'</a></li>';
	}
	echo '</ul>';
	?>
</section>

<section class="hhv-form">
	<form method="post" action="">
	<section class="main-panel main-panel-single">
		<header>Thông tin chung</header>
		<section class="block">
			<?php
				if(isset($data['_config']) || count($data['_config'])){
					foreach ($data['_config'] as $keyConfig => $valConfig) { ?>
						<?php if($valConfig['type'] == 'text'){ ?>
							<label class="item">
								<p class="label"><?php echo $valConfig['label']; ?></p>
								<input type="text" name="data[<?php echo $valConfig['keyword']; ?>]" value="<?php echo common_valuepost(isset($data['_post'][$valConfig['keyword']])?$data['_post'][$valConfig['keyword']]:$valConfig['value']); ?>" class="txtText" />
							</label>
						<?php } else if($valConfig['type'] == 'textarea'){ ?>
							<label class="item">
								<p class="label"><?php echo $valConfig['label']; ?></p>
								<textarea name="data[<?php echo $valConfig['keyword']; ?>]" class="txtTextarea"><?php echo common_valuepost(isset($data['_post'][$valConfig['keyword']])?$data['_post'][$valConfig['keyword']]:$valConfig['value']); ?></textarea>
							</label>
						<?php } else if($valConfig['type'] == 'radio'){ ?>
							<section class="checkbox-radio">
							<p class="label"><?php echo $valConfig['label']; ?></p>
								<section class="group">
									<label style="margin-bottom: 0px;"><input type="radio" name="data[<?php echo $valConfig['keyword']; ?>]" value="1" <?php echo (($valConfig['value']==1)?'checked="checked"':'') ?> /><span>Có</span></label>
									<label style="margin-bottom: 0px;"><input type="radio" name="data[<?php echo $valConfig['keyword']; ?>]" value="0" <?php echo (($valConfig['value']==0)?'checked="checked"':'') ?> /><span>Không</span></label>
								</section>
							</section>
						<?php } ?>
					<?php } } ?>
			<section class="action">
				<p class="label">Thao tác:</p>
				<section class="group">
					<input type="submit" name="change" value="Thay đổi" />
					<input type="reset" name="add" value="Làm lại" />
				</section>
			</section>
		</section><!-- .block -->
	</section><!-- .main-panel -->
	</form>
</section><!-- .hhv-form -->