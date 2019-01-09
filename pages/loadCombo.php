<?php

include './dbconfig1.php';
$query = 'SELECT * FROM offencelist';
$result = mysql_query($query);
$list = array();
while ($row = mysql_fetch_assoc($result)) {
    $list[] = $row['offencedescp'];
}
echo json_encode($list);

