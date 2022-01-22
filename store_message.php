<?php include 'db_connect.php';?>
<?php
function encrypt($encrypt_message, $key) {
	#Use the user provided, or secret 40 bit key to encrypt the message
	#40 bits is secure, and much faster than other algorithms.
	$encrypted_message = "";
	for ($x = 0; $x < strlen($encrypt_message); $x++) {
		$encrypted_message = $encrypted_message . chr(ord($encrypt_message[$x]) ^ (ord($key[$x % strlen($key)])));
	}
	return base64_encode($encrypted_message);
}

$dbconn = get_conn();
$name = htmlspecialchars($_POST["name"]);
$message = htmlspecialchars($_POST["message"]);
$encrypt_key = htmlspecialchars($_POST["key"]);

if(empty($name) OR empty($message) OR empty($encrypt_key)) {
	$errormessage = urlencode("empty message, author or key.");
	header("Location: send_message.php?error=$errormessage");
	return;
}

if(strcasecmp($name, "ADMIN") == 0) {
	#Users with the Admin key can post as admins.
	#For convenience, all admin messages must begin with "flag{".
	if(strcmp($encrypt_key, getenv('CRYPTSERV_KEY')) != 0 OR substr($message, 0, 5 ) != "flag{") {
		$errormessage = urlencode("To send as Admin, you need to use the Admin key and your message must start with flag{.");
		header("Location: send_message.php?error=$errormessage");
		return;	
	}
	$encrypt_key = getenv('CRYPTSERV_KEY');
}

$encrypted = encrypt($message, $encrypt_key);
$result = pg_prepare($dbconn, "insertmessage", 'INSERT INTO cryptserv.message (user_from, message, unix_time) values($1, $2, $3)');
$result = pg_execute($dbconn, "insertmessage", array($name, $encrypted, time()));
header("Location: send_message.php?success=yes");
?>