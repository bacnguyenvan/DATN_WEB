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

		$('.save_condition').prop("disabled",false);
		if(parseInt(number) < 6){
			$('.number_row').val(parseInt(number) + 1);
			$('.list_condition').append(more_condition);
		}
	});

	$('.list_condition').on('click','.delete_condition',function(){
		parents = $(this).parents('.form-group.row');
		parents.remove();

		var number = $('.number_row').val();
		$('.number_row').val(parseInt(number) - 1);
		if(parseInt(number) - 1 <= 0){
			$('.save_condition').prop("disabled",true);
		}
	})

	$("#print_qrcode").click(function(e){

		e.preventDefault();
		$("#img_qrcode img").css({"width":"400","height":"400"});
		window.document.body.innerHTML = $("#img_qrcode")[0].outerHTML;
		window.print();
		location.reload();		

	})
})