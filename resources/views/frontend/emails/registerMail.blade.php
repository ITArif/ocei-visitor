<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register email message</title>
</head>
<body>
    <table class="table table-bordered">
	  <tr>
	  	<td>Dear {{ json_encode($name,TRUE)}}</td>
	  </tr>
	  <tr>
	  	<td>প্রধান বিদ্যুৎ পরিদর্শকের দপ্তর থেকে আপনাকে অভিনন্দন. Your account details are as below:-</td>
	  </tr>
	  <tr>
	  	<td>&nbsp;</td>
	  </tr>
	  <tr>
	  	<td>Email: json_encode($email,TRUE)</td>
	  </tr>
	  <tr>
	  	<td>&nbsp;</td>
	  </tr>
	  <tr>
	  	<td>Mobile: json_encode($phone,TRUE)</td>
	  </tr>
	  <tr>
	  	<td>&nbsp;</td>
	  </tr>
	  <tr>
	  	<td>Password: *********(As chosen by you)</td>
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