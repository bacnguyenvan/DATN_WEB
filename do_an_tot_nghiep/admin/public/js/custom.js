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
	
})