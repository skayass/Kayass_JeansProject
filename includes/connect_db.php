<?php

$dbc = mysqli_connect('localhost', 'Samks', 'abc123', 'jeans')
OR die
 (mysqli_connect_error());

mysqli_set_charset($dbc, 'utf8');
if (mysqli_ping($dbc))
{ 
    echo 'MySQL Server'.mysqli_get_server_info($dbc).'connected on'.mysqli_get_host_info($dbc);

}
?>