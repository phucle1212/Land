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
});

$(document).ready(function(){
		
});
function deleteAll(){
	if (confirm('Bạn có chắc chắn xóa?')) {
		document.getElementById('btnDel').click(); return false;
	};
}