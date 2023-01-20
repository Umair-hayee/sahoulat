<!DOCTYPE html>
<html>
<head>
  <title>Password Reset Link</title>
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
					<h1 style="color: #fff; font-size: 34px; font-weight: bold; text-transform: uppercase; margin-bottom: 0px;">Hi {{$emailData['name']}},</h1>
				</td>
			</tr>
			<tr>
				<td class="p-100">
					<p style="color: #fff;">
                        Please click on the button below to verify your email address!
					</p>
                    <p style="color: #fff;"><a href="{{route('confirm.email', $emailData['email'])}}">Confirm Email</a></p>
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
					<a href="{{route('reset.link.form')}}" style="font-size: 20px;font-weight: bold; background: #00aeef;color: #fff;padding: 5px 30px; border-radius: 10px; text-decoration: none; margin-bottom: 80px; margin-top: 15px; display: inline-block; text-transform: uppercase;">Reset Password</a>
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