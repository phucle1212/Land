<section class="hhv-tabs">
	<h1>Bài viết</h1>
	<ul>
		<li class="active"><a href="<?php echo base_url(); ?>backend/article/item" title="Bài viết">Bài viết</a></li>
		<li><a href="<?php echo base_url(); ?>backend/article/additem" title="Thêm bài viết">Thêm bài viết</a></li>
	</ul>
</section>

<section class="hhv-view">
	<section class="advanced">
		<section class="search">
			<form method="get" action="<?php echo base_url(); ?>backend/article/item">
				<input type="hidden" name="sort_field" value="<?php echo $data['_sort']['field']; ?>" />
				<input type="hidden" name="sort_value" value="">
				<?php echo form_dropdown('parentid', (isset($data['_show']['parentid'])?$data['_show']['parentid']:NULL),common_valuepost(isset($data['_parentid'])?$data['_parentid']:0),' id="txtParentid" class="cbSelect"'); ?>
				<input type="text" name="keyword" class="text" value="<?php echo isset($data['_keyword'])?common_valuepost($data['_keyword']):'' ?>">
				<input type="submit" class="submit" value="Tìm kiếm">
			</form>
		</section>
		<section class="tool">
			<form method="post" action="">
				<?php if(isset($data['_list']) && count($data['_list'])){ ?>
				<input type="button" value="Xóa nhiều" onclick="deleteAll();"/>
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
					<th><input type="checkbox" id="check-all" /></th>
					<th><?php echo get_link_sort(
						array(
							'base_url' => $data['_config']['base_url'],
							'page' => $data['_page'],
							'title' => 'Tên bài viết',
							'field' => 'title',
							'sort_field' => $data['_sort']['field'], 
							'sort_value' => $data['_sort']['value'],
							'parentid' => $data['_parentid'],
							'keyword' => $data['_keyword']
						)); ?>
					</th>
					<th>Danh mục</th>
					<th><?php echo get_link_sort(
						array(
							'base_url' => $data['_config']['base_url'],
							'page' => $data['_page'],
							'title' => 'Ngày tạo',
							'field' => 'created',
							'sort_field' => $data['_sort']['field'], 
							'sort_value' => $data['_sort']['value'],
							'parentid' => $data['_parentid'],
							'keyword' => $data['_keyword']
						)); ?>
					</th>
					<th>Người tạo</th>
					<th><?php echo get_link_sort(
						array(
							'base_url' => $data['_config']['base_url'],
							'page' => $data['_page'],
							'title' => 'Vị trí',
							'field' => 'order',
							'sort_field' => $data['_sort']['field'], 
							'sort_value' => $data['_sort']['value'],
							'parentid' => $data['_parentid'],
							'keyword' => $data['_keyword']
						)); ?>
					</th>
					<th><?php echo get_link_sort(
						array(
							'base_url' => $data['_config']['base_url'],
							'page' => $data['_page'],
							'title' => 'Hiển thị',
							'field' => 'publish',
							'sort_field' => $data['_sort']['field'], 
							'sort_value' => $data['_sort']['value'],
							'parentid' => $data['_parentid'],
							'keyword' => $data['_keyword']
						)); ?>
					</th>
					<th>Thao tác</th>
					<th class="last"><?php echo get_link_sort(
						array(
							'base_url' => $data['_config']['base_url'],
							'page' => $data['_page'],
							'title' => 'Mã',
							'field' => 'id',
							'sort_field' => $data['_sort']['field'], 
							'sort_value' => $data['_sort']['value'],
							'parentid' => $data['_parentid'],
							'keyword' => $data['_keyword']
						)); ?>
					</th>
				</tr>
			</thead>
			<tbody>
			<?php if(isset($data['_list']) && count($data['_list'])){ ?>
			<?php foreach ($data['_list'] as $keyList => $valList) { ?>
				<tr>
					<!-- set STT -->
					<td><?php echo (($keyList+1) + $data['_config']['per_page'] * ($data['_page']-1))?></td>

					<td><input type="checkbox" name="checkbox[<?php echo $valList['id']; ?>]" value="1" class="check-all" /></td>
					<td class="left"><?php echo $valList['title']?></td>
					
					<td><?php $category = get_category('article_category', 'id, title', array('id' => $valList['parentid'])); echo isset($category['title'])?$category['title']:''; ?></td>

					<td><?php echo ($valList['created'] != '0000-00-00 00:00:00')?gmdate('H:i d/m/Y', strtotime($valList['created']) + 7*3600):'-'; ?></td>
					
					<td><?php $user = get_user($valList['userid_created'], 'username'); echo isset($user['username'])?$user['username']:'-' ?></td>
					
					<td><a href="#"><input type="input" name="order[<?php echo $valList['id']; ?>]" value="<?php echo $valList['order']; ?>" class="order" /></a></td>

					<td><a href="<?php echo base_url(); ?>backend/article/setitem/publish/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Trạng thái"><img src="<?php echo base_url(); ?>public/template/backend/images/<?php echo ($valList['publish'] == 1)?'check':'uncheck'; ?>.png" title="Trạng thái" /></a></td>

					<td>
						<a href="<?php echo base_url(); ?>backend/article/edititem/<?php echo $valList['id']; ?>?continue=<?php echo base64_encode(common_fullurl()); ?>" title="Thay đổi"><img src="<?php echo base_url(); ?>public/template/backend/images/edit.png" /></a>
						<a href="<?php echo base_url(); ?>backend/article/delitem/<?php echo $valList['id']; ?>" title="Xóa" onclick="return confirm('Bạn có chắc chắn xóa?');"><img src="<?php echo base_url(); ?>public/template/backend/images/delete.png" /></a></td>
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
			<input type="submit" value="Xóa nhiều" id="btnDel" name="del" />
		</section>
		</form>
	</section><!-- .table -->
	<?php echo (isset($data['pagination']) && !empty($data['pagination']))?'<section class="pagination">'.$data['pagination'].'</section>':'' ?>
</section><!-- .hhv-view -->
