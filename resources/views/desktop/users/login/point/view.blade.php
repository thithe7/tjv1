@extends('layout.userLoginLayout')
@section('content_login')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/toastr/toastr.min.css') }}">
<section>
	<blockquote>
		TJ Point
	</blockquote>
	<div style="margin: 10px 0 10px 0;">Table bellow will show your last 5 point detail.</div>
	<table class="table-bordered table-striped">
		<thead>
			<tr style="text-align: left;">
				<th style="width: 10px;">no</th>
				<th>Date</th>
				<th>Point</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i=1;
			if (count($point) > 0) {
				foreach ($point as $row) {
					if ($i < 6) {
						echo "<tr>".
						"<td>".$i."</td>".
						"<td>".date('d M Y H:i:s', strtotime($row->created_at))."</td>".
						'<td style="text-align: right;">'.number_format($row->total_point,0,",",".").'</td>'.
						'</tr>';
						$i++;
					}
				}
			} else {
				echo "<tr><td colspan='3'>You have no transaction history for now.</td></tr>";
			}
			?>
		</tbody>
	</table>
</section>
<script src="{{ URL::asset('frontassets/users_login/plugins/jquery.min.js') }}"></script>
<script src="{{ URL::asset('frontassets/users_login/plugins/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('frontassets/users_login/plugins/toastr/toastr.min.js') }}"></script>
<script>
	$(document).ready(function(){

	});

	$(document).on('click', '#btn-gen-voucher', function(){
		if ($(this).attr('form-view') == 'hide') {
			$(this).attr('form-view', 'show');
			$('#form-gen-voucher').show();
		} else {
			$(this).attr('form-view', 'hide');
			$('#form-gen-voucher').hide();
		}
	});

	$(document).on('click', '#submitGenVoucher', function(){
		if ($('#point').val() < 100 || $('#point').val() > 300) {
			toastr.error('Minimum 100 point and maximum 300 point to generate a voucher.');
		} else {
			$('#submitGenVoucher').hide();
			$.ajax({
				method: 'POST',
				dataType: 'json',
				url: '{!! url("/do_genVoucher") !!}',
				data: {'point': $('#point').val()},
				success: function (data) {
					if (data.success === true) {
						toastr.success(data.msgServer);
						$('#btn-gen-voucher').show();
						location.reload();
					} else {
						toastr.warning(data.msgServer);
					}
				},
				fail: function (e) {
					toastr.error(e);
				}
			});
		}
	});
</script>
@endsection