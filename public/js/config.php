<?php

$host = "localhost"; /* Host name */
$user = "nayef"; /* User */
$password = "Ne@1341998"; /* Password */
$dbname = "tebkum"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
