<section class="hhv-tabs">
	<h1>Thay đổi thông tin tài khoản</h1>
	<ul>
		<li class="active"><a href="<?php echo base_url(); ?>backend/account/info" title="Thay đổi thông tin tài khoản">Thông tin</a></li>
		<li><a href="<?php echo base_url(); ?>backend/account/password " title="Thay đổi mật khẩu">Mật khẩu</a></li>
	</ul>

</section>

<section class="hhv-form">
	<form method="post" action="">
	<section class="main-panel main-panel-single">
		<header>Thông tin chung</header>
	    <?php echo common_showerror(validation_errors()); ?>
		<section class="block">
			<label class="item">
				<p class="label">Tên sử dụng:</p>
				<input type="text" value="<?php echo $data['auth']['username'] ?>" class="txtText" readonly="true" disabled/>
			</label>
			<label class="item">
				<p class="label">Email:</p>
				<input type="text" name="data[email]" value="<?php echo common_valuepost(isset($data['_post']['email'])?$data['_post']['email']:''); ?>" class="txtText" />
			</label>
			<label class="item">
				<p class="label">Tên đầy đủ:</p>
				<input type="text" name="data[fullname]" value="<?php echo common_valuepost(isset($data['_post']['fullname'])?$data['_post']['fullname']:''); ?>" class="txtText" />
			</label>
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