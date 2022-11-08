<?php

require_once('CSVHelper.php');
// WRITE
CSVHelper::write('beatles.csv',[['firstname'=>'John','lastname'=>'Lennon'],['firstname'=>'Paul','lastname'=>'McCartney']],false,true); // write a recordset to a JSON file
//CSVHelper::write('beatles.json.php',['firstname'=>'George','lastname'=>'Harrison']); // append a record to a JSON file



?>