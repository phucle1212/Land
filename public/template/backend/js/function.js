$(window).load(function(){

	var _this = '';
	var _temp = '';

	/*===================== DATETIMEPICKER =====================*/
	$('#txtTimestart, #txtTimeend, #txtTimer').datetimepicker({
		format:'H:i:s d/m/Y',
	});

	/*===================== HEIGHT HHV-FORM =====================*/
	if($('section.hhv-form .side-panel').height() > $('section.hhv-form .main-panel').height())
		$('section.hhv-form').height($('section.hhv-form .side-panel').height() + 20);

	/*===================== #CHECK-ALL =====================*/
	// Check id 
	$('#check-all').click(function(){
		if ($(this).prop('checked')) {
			$('.check-all').prop('checked', true).parent().parent().find('td').addClass('select');
		}
		else{
			$('.check-all').prop('checked', false).parent().parent().find('td').removeClass('select');
		}
	});
	// Check class
	$('.check-all').click(function(){
		if ($(this).prop('checked') == false) {
			$(this).parent().parent().find('td').removeClass('select');
			$('#check-all').prop('checked', false);
		}
		else{
			$(this).parent().parent().find('td').addClass('select');
		}
		if ($('.check-all:checked').length == $('.check-all').length) {
			$('#check-all').prop('checked', true);
		}
	});

	// ==========================
	// Tags suggest
	$('#tags-suggest').click(function(){
		// alert('s');
		if ($('#tagspicker-suggest').is(':hidden')) {
			$('#tagspicker-suggest').show();
			$('#tagspicker-suggest').html('<p><img src="http://ajaxload.info/images/exemples/2.gif" />Đang tải dữ liệu ...</p>');
			$.post('../../backend/tag/suggest/', function(data){
				$('#tagspicker-suggest').width(668);
				$('#tagspicker-suggest').html(data);
			});
		}
		else{
			$('#tagspicker-suggest').width(168);
			$('#tagspicker-suggest').hide();
			$('#tagspicker-suggest').html('');
		}
		return false;
	});
	$('#tagspicker-suggest').on('click', '.title a', function(){
		_this = $(this);
		$('#tagspicker-suggest').width(168);
		$('#tagspicker-suggest').html('<p><img src="../../public/template/backend/images/load.gif" />Đang tải dữ liệu ...</p>');
		$.post(_this.attr('href'), function(data){
			$('#tagspicker-suggest').width(668);
			$('#tagspicker-suggest').html(data);
		});
		return false;
	});
	$('#tagspicker-suggest').on('click', '.suggest a', function(){
		_this = $(this);
		_temp = $('#txtTags').val();
		$('#txtTags').val('Đang tải dữ liệu...');
		$.post('../../backend/tag/insert', {item: _this.attr('title'), list: _temp}, function(data){
			$('#txtTags').val(data);
		});
		return false;
	});
});

$(document).ready(function(){
		
});

$(document).ready(function(){});

// Nội dung sẽ mất khi click chuột ra ngoài vùng
$(document).mouseup(function(e){
	var container = $('#tagspicker-suggest');
	if (!container.is(e.target) && container.has(e.target).length === 0) {
		$('#tagspicker-suggest').width(168);
		$('#tagspicker-suggest').html('').hide();
	}
});

function deleteAll(){
	if (confirm('Bạn có chắc chắn xóa?')) {
		document.getElementById('btnDel').click(); return false;
	};
}