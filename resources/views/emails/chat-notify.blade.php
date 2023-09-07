<!DOCTYPE html>
<html>
<head>
  <title>Order Complete Email</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: 400;
            font-size: 24px;
            overflow-x: hidden;
        }
        p{
        	margin-top: 10px;
        	margin-bottom: 15px;
        }
        .p-100 {
        	padding: 0 100px;
        }
		table.table {
			background: #000; width:600px;margin: 0 auto;
		}
        .pt-50 {
        	padding-top: 50px;
        }
		@media (max-width: 550px) {
			body table {
				width: 100% !important;
			}
			body .p-100 {
				padding: 0 20px;
			}
		}
</style>
</head>
<body>
<div style="margin: 0 auto">
	<table class="table">
		<tbody>
			<tr>
				<td class="p-100 pt-50">
					<a href="#"><img src="{{asset('assets/imgs/Logo Sahoulatb.png')}}" width="200" style="margin-bottom: 20px;"></a>
				</td>
			</tr>
			<tr>
				<td class="p-100" style="margin-bottom: 20px">
					<h1 style="color: #fff; font-size: 34px; font-weight: bold; text-transform: uppercase; margin-bottom: 0px;">Hi Admin,</h1>
				</td>
			</tr>
			<tr>
				<td class="p-100">
					<p style="color: #fff;">
                        The users are found to be exchanging either phone number or email with each other. You can deactivate the account(s) from your admin dashboard.<br> <br>
                        From User Name: {{$emailData['from']}} <br> <br>
                        To User Name: {{$emailData['to']}} <br> <br>
                        Text: {{$emailData['message']}}
					</p>
				</td>
			</tr>
			<tr>
				<td class="p-100">
					<p style="color: #fff;">Best,</p>
					<p style="color: #fff;">The Sahulat Team</p>
				</td>
			</tr>
			<tr>
				<td class="p-100" style="text-align: center;">
					<div style="border-bottom: 2px solid #fff; margin-bottom:30px; margin-left:auto; margin-right:auto; width: 30%;"></div>
				</td>
			</tr>
			<tr>
				<td class="p-100" style="text-align: center;">
					<div style="border-bottom: 2px solid #fff; margin-bottom:30px; margin-left:auto; margin-right:auto; width: 30%;"></div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
</body>
</html>