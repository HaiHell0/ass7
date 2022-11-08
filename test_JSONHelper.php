<?php

require_once('JSONHelper.php');

// WRITE
JSONHelper::write('beatles.json.php',[['firstname'=>'John','lastname'=>'Lennon'],['firstname'=>'Paul','lastname'=>'McCartney'],['firstname'=>'John','lastname'=>'Lennon']],false,true); // write a recordset to a JSON file
JSONHelper::write('beatles.json.php',['firstname'=>'George','lastname'=>'Harrison']); // append a record to a JSON file
JSONHelper::write('beatles.json.php',[['firstname'=>'George','lastname'=>'Harrison'],['firstname'=>'Ringo','lastname'=>'Starr']]); // append a recordset to a JSON file
// READ
echo '<pre>';print_r(JSONHelper::read('beatles.json.php')); // read a recordset from a JSON file
echo '<pre>';print_r(JSONHelper::read('beatles.json.php',2,1)); // read one record from a JSON file
echo '<pre>';print_r(JSONHelper::read('beatles.json.php',1,5)); // read the first 3 records from a JSON file


// MODIFY
JSONHelper::modify('beatles.json.php',0,['firstname'=>'John','lastname'=>'Lennon','birthdate'=>'1940-10-09']); // modify the first record in a JSON file
JSONHelper::modify('beatles.json.php',0,['firstname'=>'John','lastname'=>'Lennon','birthdate'=>'1940-10-09']); // modify the first record in a JSON file



// FIND
echo '<pre>';print_r(JSONHelper::find('beatles.json.php','John'));//find all records that exactly match one field
echo '<pre>';print_r(JSONHelper::find('beatles.json.php','John',1));//find the first record that exactly matches one field
echo '<pre>';print_r(JSONHelper::find('beatles.json.php',[1=>'John'])); //find all the records where the second column exactly matches a value
echo '<pre>';print_r(JSONHelper::find('beatles.json.php',[1=>'John'],1)); //find the first record where the second column exactly matches a value

//error checking
echo '<pre>';print_r(JSONHelper::find('beatles.json.php','User does not exist'));
echo '<pre>';print_r(JSONHelper::find('beatles.json.php',[1=>'John'])); //find all the records where the second column exactly matches a value
echo '<pre>';print_r(JSONHelper::find('beatles.json.php',[1=>'John'],1)); //find the first record where the second column exactly matches a value
echo '<pre>';print_r(JSONHelper::read("Fild does not exist")); //find the first record where the second column exactly matches a value

// DELETE
JSONHelper::delete('beatles.json.php'); // delete a JSON file
JSONHelper::delete('beatles.json.php',4,true); // delete the first record from a JSON file
JSONHelper::delete('beatles.json.php',[0,1]); // delete the first and the second records from a JSON file
