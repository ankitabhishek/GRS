
<?php
$dbc = 
mysqli_connect('localhost', 'root', '', 'muj_complain')
OR die(mysqli_connect_error());
mysqli_set_charset($dbc, 'UTF-8');
