<?php include 'db_connect.php';?>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>X, marks the spot, OR, find the key.</title>
</head>
<body>
	<h1>Public announcements:</h1>
	<p>This page contains messages from the admins accessible for all members</p>
	<p>The encrypted messages are available here so members with the key can make backups.</p>
	<p>If you are a member, please use your key to decrypt the message, especially from the Admin, <br/> they may contain important information.</p>
	<table>
		<thead>
			<tr>
				<td>Date</td>
				<td>Author</td>
				<td>Message</td>
			</tr>
		</thead>
		<tbody>
			<?php
			$dbconn = get_conn();
			$result = pg_query($dbconn, "select * from cryptserv.message");
			while ($row = pg_fetch_row($result)) {
			$class = strcasecmp($row[0], "ADMIN") == 0 ? "adminmessage" : "usermessage";
			echo "<tr class=\"$class\">";
				$date = date("y-m-d, h:i", $row[2]);
				echo "<td> $date</td>";
				echo "<td> $row[0]</td>";
				echo "<td> $row[1]</td>";
			echo "</tr>";
		} 
		?>
	</tbody>
</table>
<p>The messages are base64 encoded so they can be copied from the browser.</p>
<h3><a href="/index.php">Home</a></h3>
<?php include 'footer.php';?>
</body>
</html>