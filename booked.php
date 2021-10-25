 <section id="bg-bus" class="d-flex align-items-center">
<main id="main">
	<div class="container-fluid">
		<div class="col-lg-12">
			<?php  if(isset($_SESSION['login_id'])): ?>
			<div class="row">
				<div class="col-md-12">
					
				</div>
			</div>
		<?php endif; ?>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<div class="card col-md-12">
					
					<div class="card-body">
						<table class="table table-striped table-bordered" id="booked-field">
							
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">เลขที่</th>
									<th class="text-center">ชื่อ</th>
									<th class="text-center">จำนวนคน</th>
									<th class="text-center">จำนวน</th>
									<th class="text-center">สถานะ</th>
									<th class="text-center">ยกเลิกตั๋ว</th>
									<th class="text-center">แก้ไข</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</main>
</section>
<script>
	$('#new_schedule').click(function(){
		uni_modal('Add New Schedule','manage_schedule.php')
	})
	window.load_booked = function(){
		$('#booked-field').dataTable().fnDestroy();
		$('#booked-field tbody').html('<tr><td colspan="7" class="text-center">Please wait...</td></tr>')
		$.ajax({
			url:'load_booked.php',
			error:err=>{
				console.log(err)
				alert_toast('An error occured.','danger');
			},
			success:function(resp){
				if(resp){
					if(typeof(resp) != undefined){
						resp = JSON.parse(resp)
							if(Object.keys(resp).length > 0){
								$('#booked-field tbody').html('')
								var i = 1 ;
								var confirm1='ต้องการยกเลิกตั๋ว?';
								Object.keys(resp).map(k=>{
									var tr = $('<tr></tr>');
									tr.append('<td class="text-center">'+(i++)+'</td>')
									tr.append('<td class="">'+resp[k].ref_no+'</td>')
									tr.append('<td class="">'+resp[k].name+'</td>')
									tr.append('<td class="">'+resp[k].qty+'</td>')
									tr.append('<td class="">'+resp[k].amount+'</td>')
									tr.append('<td class="">'+(resp[k].status == 1 ? 'จ่ายแล้ว' :'ยังไม่จ่าย')+'</td>')
									tr.append('<td class=""> <center> <a  href="delete.php?id='+resp[k].id+'"><button class="btn btn-sm btn-danger"> ยกเลิกตั๋ว</button></a></td>')
									tr.append('<td><center><button class="btn btn-sm btn-primary mr-2 text-white edit_booked" data-id="'+resp[k].schedule_id+'" data-bid="'+resp[k].id+'"><strong>Edit</strong></button></center></td>')
									$('#booked-field tbody').append(tr)

								})

							}else{
								$('#booked-field tbody').html('<tr><td colspan="7" class="text-center">No data.</td></tr>')
							}
					}
				}
			},
			complete:function(){
				$('#booked-field').dataTable()
				$('.edit_booked').click(function(){
					uni_modal('Edit Booked','customer_book.php?id='+$(this).attr('data-id')+'&bid='+$(this).attr('data-bid'),1)
				})
			}
		})
	}
	
	$(document).ready(function(){
		load_booked()
	})
</script>

