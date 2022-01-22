<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>X, marks the spot, OR, find the key.</title>
</head>
<body>
	<h1>Send a message:</h1>
	<p>Fill in this form to send an encrypted message to the admin.</p>
	<div class="sendform">
		<form action="store_message.php" method="post">
			<input type="submit" value="Send">
			<table>
				<tbody>
					<tr>
						<td>Your name:</td><td><input type="text" name="name"></td>
					</tr>
					<tr>
						<td>Message:</td><td><input type="text" name="message"></td>
					</tr>
					<tr>
						<td>Key:</td><td><input type="text" name="key"></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<?php
	if(isset($_GET["error"]))
		echo "<div class=redtext>".$_GET["error"]."</div>";
	if(isset($_GET["success"]))
		echo "<div class=greentext>message sent</div>";
	?>
	<h3><a href="/index.php">Home</a></h3>
	<?php include 'footer.php';?>
</body>
</html>