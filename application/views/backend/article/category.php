<section class="hhv-tabs">
	<h1>Danh mục</h1>
	<ul>
		<li class="active"><a href="<?php echo base_url(); ?>backend/article/category" title="danh mục">Danh mục</a></li>
		<li><a href="<?php echo base_url(); ?>backend/article/addcategory" title="Thêm danh mục">Thêm danh mục</a></li>
	</ul>
</section>

<section class="hhv-view">
	<section class="advanced">
		<section class="tool">
			<form method="post" action="">
				<?php if(isset($data['_list']) && count($data['_list'])){ ?>
				<input type="button" value="Sắp xếp" onclick="document.getElementById('btnSort').click(); return false; "/>
				<?php } ?>
			</form>
		</section>
	</section>
	<section class="table">
		<form method="post" action="">
		<table cellpadding="0" cellspacing="0" class="main">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên danh mục</th>
					<th>Bài viết</th>
					<th>Ngày tạo</th>
					<th>Người tạo</th>
					<th>Vị trí</th>
					<th>Hiển thị</th>
					<th>Thao tác</th>
					<th class="last">Mã</th>
				</tr>
			</thead>
			<tbody>
			<?php if(isset($data['_list']) && count($data['_list'])){ ?>
			<?php foreach ($data['_list'] as $keyList => $valList) { ?>
				<tr>
					<!-- set STT -->
					<td><?php echo ($keyList+1); ?></td>

					<td class="left"><?php echo str_repeat('|----- ', $valList['level']).$valList['title']?></td>
					<td><?php echo get_count_item('article_item', array('parentid' => $valList['id'])); ?></td>

					<td><?php echo ($valList['created'] != '0000-00-00 00:00:00')?gmdate('H:i d/m/Y', strtotime($valList['created']) + 7*3600):'-'; ?></td>
					<td><?php $user = get_user($valList['userid_created'], 'username'); echo isset($user['username'])?$user['username']:'-' ?></td>
					<td><a href="#"><input type="input" name="order[<?php echo $valList['id']; ?>]" value="<?php echo $valList['order']; ?>" class="order" /></a></td>
					
					<td><a href="<?php echo base_url(); ?>backend/article/setcategory/publish/<?php echo $valList['id']; ?>" title="Trạng thái"><img src="<?php echo base_url(); ?>public/template/backend/images/<?php echo ($valList['publish'] == 1)?'check':'uncheck'; ?>.png" title="Trạng thái" /></a></td>

					<td>
						<a href="<?php echo base_url(); ?>backend/article/editcategory/<?php echo $valList['id']; ?>" title="Thay đổi"><img src="<?php echo base_url(); ?>public/template/backend/images/edit.png" /></a>
						<a href="<?php echo base_url(); ?>backend/article/delcategory/<?php echo $valList['id']; ?>" title="Xóa" onclick="return confirm('Bạn có chắc chắn xóa?');"><img src="<?php echo base_url(); ?>public/template/backend/images/delete.png" /></a></td>
					<td class="last"><?php echo $valList['id']; ?></td>
				</tr>
			<?php } ?>
			<?php } else { ?>
				<td class="last" colspan="9"><p>Không có dữ liệu</p></td>
			<?php } ?>
			</tbody>
			
		</table>
		<section class="display-none">
			<input type="submit" value="Sắp xếp" id="btnSort" name="sort" />
		</section>
		</form>
	</section><!-- .table -->
	<?php echo (isset($data['pagination']) && !empty($data['pagination']))?'<section class="pagination">'.$data['pagination'].'</section>':'' ?>
</section><!-- .hhv-view -->
