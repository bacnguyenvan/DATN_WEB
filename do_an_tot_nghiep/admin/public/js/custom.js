$(document).ready(function(){

	$(document).on('click','.btn_delete',function(e){
		e.preventDefault();

			var id = $(this).attr('id');
			
			$.confirm({
				title : '',
				content :'<div style="text-align:center; font-size:20px;">Bạn có chắc chắn muốn xóa?</div>',
				buttons: {
					ok: {
						text: 'Có',
						btnClass :'btn-primary',
						action: function action(){
							 window.location.href = 'delete.php?id='+id;
						}
					},
					no : {
						text: 'Hủy',
						btnClass :'btn-default'
					}
				}
			});
	});
	
	$('.btn_add_dk').on('click',function(){
		more_condition = $('.more_condition').html();
		var number = $('.number_row').val();

		if(parseInt(number) < 6){
			$('.number_row').val(parseInt(number) + 1);
			$('.list_condition').append(more_condition);
		}
	})
})