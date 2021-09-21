<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<Title> Redirect </title>

</head>
</html>
<?php
if(isset($_POST['sendmail']))
{
	if($_POST['Con_name'] != "" && $_POST['Con_email'] !="" && $_POST['Con_ph'] != "")
	{
	$name=$_POST['Con_name'];
	$email_id=$_POST['Con_email'];
	$phn=$_POST['Con_ph'];
	$cmmts=$_POST['Con_msg'];
	
			$to = "induvips@gmail.com,customercare.penta@gmail.com";
			$subject = "Contact Details";
			$message="<style type='text/css'>
			p,td{font-family:Verdana;font-size:12px;font-color:black;}
			strong{font-family:Verdana;font-size:12px;font-color:black; font-weight:bold}
			</style>";
			$message.="<strong>Dear Admin,</strong> <br>
			<p>Kindly find the below details for accessing the enquiry. <br/>	
			<p><b>PERSONAL DETAILS</b></p>
			<p><b>Fullname :</b> $name </p>
			<p><b>Email :</b> $email_id </p>
			<p><b>Phone Number: </b> $phn </p>
			<p><b>Message :</b> $cmmts </p>
			";	
			$message.="<p><i>This email is  system generated; please do not reply to this email.</i></p>";
			$headers='From: www.pentaxpress.com'."\r\n".
			'Content-type: text/html; charset=iso-8859-1\r\n'.
			'Reply-To: webmaster@example.com'."\r\n".
			'X-Mailer: PHP/' . phpversion();
			if(mail($to,$subject,$message,$headers))
				{
					echo "<script> alert('Thanks for your response.');</script>";
					echo "<script>window.location.href='contact-us.php';</script>";
				}
			else
				{
					echo "<script> alert('Retry Again. Server is busy rite now!');</script>";
					echo "<script>window.location.href='contact-us.php';</script>";
				}				
		}
	else
	{
		echo "<script> alert('Please fill out with all data and retry again!');</script>";
		echo "<script>window.location.href='donation.php';</script>";
	}
}
?>