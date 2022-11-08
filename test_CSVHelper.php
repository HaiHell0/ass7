<?php

require_once('CSVHelper.php');

// WRITE
CSVHelper::write('beatles.CSV.php',[['firstname'=>'John','lastname'=>'Lennon'],['firstname'=>'Paul','lastname'=>'McCartney'],['firstname'=>'John','lastname'=>'Lennon']],false,true); // write a recordset to a CSV file
CSVHelper::write('beatles.CSV.php',['firstname'=>'George','lastname'=>'Harrison']); // append a record to a CSV file
CSVHelper::write('beatles.CSV.php',[['firstname'=>'George','lastname'=>'Harrison'],['firstname'=>'Ringo','lastname'=>'Starr']]); // append a recordset to a CSV file
// READ
echo '<pre>';print_r(CSVHelper::read('beatles.CSV.php')); // read a recordset from a CSV file
echo '<pre>';print_r(CSVHelper::read('beatles.CSV.php',2,1)); // read one record from a CSV file
echo '<pre>';print_r(CSVHelper::read('beatles.CSV.php',1,5)); // read the first 3 records from a CSV file


// MODIFY
CSVHelper::modify('beatles.CSV.php',0,['firstname'=>'John','lastname'=>'Lennon','birthdate'=>'1940-10-09']); // modify the first record in a CSV file
CSVHelper::modify('beatles.CSV.php',0,['firstname'=>'John','lastname'=>'Lennon','birthdate'=>'1940-10-09']); // modify the first record in a CSV file



// FIND
echo '<pre>';print_r(CSVHelper::find('beatles.CSV.php','John'));//find all records that exactly match one field
echo '<pre>';print_r(CSVHelper::find('beatles.CSV.php','John',1));//find the first record that exactly matches one field
echo '<pre>';print_r(CSVHelper::find('beatles.CSV.php',[1=>'John'])); //find all the records where the second column exactly matches a value
echo '<pre>';print_r(CSVHelper::find('beatles.CSV.php',[1=>'John'],1)); //find the first record where the second column exactly matches a value

//error checking
echo '<pre>';print_r(CSVHelper::find('beatles.CSV.php','User does not exist'));
echo '<pre>';print_r(CSVHelper::find('beatles.CSV.php',[1=>'John'])); //find all the records where the second column exactly matches a value
echo '<pre>';print_r(CSVHelper::find('beatles.CSV.php',[1=>'John'],1)); //find the first record where the second column exactly matches a value
echo '<pre>';print_r(CSVHelper::read("Fild does not exist")); //find the first record where the second column exactly matches a value

// DELETE
CSVHelper::delete('beatles.CSV.php'); // delete a CSV file
CSVHelper::delete('beatles.CSV.php',4,true); // delete the first record from a CSV file
CSVHelper::delete('beatles.CSV.php',[0,1]); // delete the first and the second records from a CSV file