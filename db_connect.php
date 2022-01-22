<?php
function get_conn() {
	$password = getenv('CRYPTSERV_DB_PASSWORD').PHP_EOL;
	$user = getenv('CRYPTSERV_DB_USER').PHP_EOL;
	$host = getenv('CRYPTSERV_DB_HOST').PHP_EOL;
	return pg_connect("host=$host port=5432 dbname=$user  user=$user password=$password");
}
?>