<?php

require_once('JSONHelper.php');

// WRITE
JSONHelper::write('beatles.json.php',[['firstname'=>'John','lastname'=>'Lennon'],['firstname'=>'Paul','lastname'=>'McCartney']],false,true); // write a recordset to a JSON file
