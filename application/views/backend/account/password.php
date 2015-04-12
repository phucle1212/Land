<section class="hhv-tabs">
	<h1>Thay đổi mật khẩu</h1>
	<ul>
		<li><a href="<?php echo base_url(); ?>backend/account/info" title="Thay đổi thông tin tài khoản">Thông tin</a></li>
		<li class="active"><a href="<?php echo base_url(); ?>backend/account/password " title="Thay đổi mật khẩu">Mật khẩu</a></li>
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
				<p class="label">Mật khẩu cũ:</p>
				<input type="password" name="data[oldpassword]" value="<?php echo common_valuepost(isset($data['_post']['oldpassword'])?$data['_post']['oldpassword']:''); ?>" class="txtText" />
			</label>
			<label class="item">
				<p class="label">Mật khẩu mới:</p>
				<input type="password" name="data[newpassword]" value="<?php echo common_valuepost(isset($data['_post']['newpassword'])?$data['_post']['newpassword']:''); ?>" class="txtText" />
			</label>
			<label class="item">
				<p class="label">Xác nhận mật khẩu mới:</p>
				<input type="password" name="data[renewpassword]" value="<?php echo common_valuepost(isset($data['_post']['renewpassword'])?$data['_post']['renewpassword']:''); ?>" class="txtText" />
			</label>
			<section class="action">
				<p class="label">Thao tác:</p>
				<section class="group">
					<input type="submit" name="change" value="Thay đổi" />
					<input type="reset" name="" value="Làm lại" />
					
				</section>
			</section>
		</section><!-- .block -->
	</section><!-- .main-panel -->
	</form>
</section><!-- .hhv-form -->