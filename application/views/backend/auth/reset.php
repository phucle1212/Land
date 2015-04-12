<!DOCTYPE html>
<html lang="en">
<head> 
	<meta charset="UTF-8">
	<title><?php echo isset($seo['title'])?$seo['title']:'' ?></title>
	<meta name="keywords" content="">
	<meta name="description" content="">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template/backend/css/login.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/template/backend/css/normalize.css">
</head>
<body>

<header></header>

<section class="hhv-wrapper">
	<form method="post" action="">
	  <fieldset>
	  	<legend>Reset thông tin tài khoản</legend>
	    
	    <nav> 
		    <ul>
		    	<li><a href="#">Về trang chủ</a></li>
		    	<li>/</li>
		    	<li><a href="<?php echo base_url(); ?>backend/auth/forgot">Quên mật khẩu</a></li>
		    </ul>
	    </nav>
	  </fieldset>
	</form>
</section>

<footer><p>Copyright &copy; <?php echo gmdate('Y', time() + 7*3600); ?> Power by <a href="#">hhv</a></p></footer>

</body>
</html>