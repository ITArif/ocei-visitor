<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Confirmation email</title>
</head>
<body>
    <table class="table table-bordered">
	  <tr>
	  	<td>Dear {{ json_encode($name,TRUE)}}</td>
	  </tr>
	  <tr>
	  	<td>Please click on below link to activate your account:-</td>
	  </tr>
	  <tr>
	  	<td><a href="{{url('confirmEmail/'.json_encode($code,TRUE))}}">Confirm Account</a></td>
	  </tr>
	  <tr>
	  	<td>&nbsp;</td>
	  </tr>
	  <tr>
	  	<td>Thanks & Regards,</td>
	  </tr>
	  <tr>
	  	<td>প্রধান বিদ্যুৎ পরিদর্শকের দপ্তর</td>
	  </tr>
    </table>
</body>
</html>