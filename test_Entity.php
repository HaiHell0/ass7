<?php

require_once('Entity.php');
// WRITE
Entity::write('beatles.csv.php',[['firstname'=>'John','lastname'=>'Lennon'],['firstname'=>'Paul','lastname'=>'McCartney'],['firstname'=>'John','lastname'=>'Lennon']],false,true); // write a recordset to a csv file
Entity::write('beatles.csv.php',['firstname'=>'George','lastname'=>'Harrison']); // append a record to a csv file
Entity::write('beatles.csv.php',[['firstname'=>'George','lastname'=>'Harrison'],['firstname'=>'Ringo','lastname'=>'Starr']]); // append a recordset to a csv file
// READ
echo '<pre>';print_r(Entity::read('beatles.csv.php')); // read a recordset from a csv file
echo '<pre>';print_r(Entity::read('beatles.csv.php',2,1)); // read one record from a csv file
echo '<pre>';print_r(Entity::read('beatles.csv.php',1,5)); // read the first 3 records from a csv file


// MODIFY
Entity::modify('beatles.csv.php',0,['firstname'=>'John','lastname'=>'Lennon','birthdate'=>'1940-10-09']); // modify the first record in a csv file
Entity::modify('beatles.csv.php',0,['firstname'=>'John','lastname'=>'Lennon','birthdate'=>'1940-10-09']); // modify the first record in a csv file



// FIND
echo '<pre>';print_r(Entity::find('beatles.csv.php','John'));//find all records that exactly match one field
echo '<pre>';print_r(Entity::find('beatles.csv.php','John',1));//find the first record that exactly matches one field
echo '<pre>';print_r(Entity::find('beatles.csv.php',[1=>'John'])); //find all the records where the second column exactly matches a value
echo '<pre>';print_r(Entity::find('beatles.csv.php',[1=>'John'],1)); //find the first record where the second column exactly matches a value

//error checking
echo '<pre>';print_r(Entity::find('beatles.csv.php','User does not exist'));
echo '<pre>';print_r(Entity::find('beatles.csv.php',[1=>'John'])); //find all the records where the second column exactly matches a value
echo '<pre>';print_r(Entity::find('beatles.csv.php',[1=>'John'],1)); //find the first record where the second column exactly matches a value
echo '<pre>';print_r(Entity::read("Fild does not exist")); //find the first record where the second column exactly matches a value

// DELETE
Entity::delete('beatles.csv.php'); // delete a csv file
Entity::delete('beatles.csv.php',4,true); // delete the first record from a csv file
Entity::delete('beatles.csv.php',[0,1]); // delete the first and the second records from a csv file


/////JSON TESTING//////

// WRITE
Entity::write('beatles.json.php',[['firstname'=>'John','lastname'=>'Lennon'],['firstname'=>'Paul','lastname'=>'McCartney'],['firstname'=>'John','lastname'=>'Lennon']],false,true); // write a recordset to a CSV file
Entity::write('beatles.json.php',['firstname'=>'George','lastname'=>'Harrison']); // append a record to a CSV file
Entity::write('beatles.json.php',[['firstname'=>'George','lastname'=>'Harrison'],['firstname'=>'Ringo','lastname'=>'Starr']]); // append a recordset to a CSV file
// READ
echo '<pre>';print_r(Entity::read('beatles.json.php')); // read a recordset from a CSV file
echo '<pre>';print_r(Entity::read('beatles.json.php',2,1)); // read one record from a CSV file
echo '<pre>';print_r(Entity::read('beatles.json.php',1,5)); // read the first 3 records from a CSV file


// MODIFY
Entity::modify('beatles.json.php',0,['firstname'=>'John','lastname'=>'Lennon','birthdate'=>'1940-10-09']); // modify the first record in a CSV file
Entity::modify('beatles.json.php',0,['firstname'=>'John','lastname'=>'Lennon','birthdate'=>'1940-10-09']); // modify the first record in a CSV file



// FIND
echo '<pre>';print_r(Entity::find('beatles.json.php','John'));//find all records that exactly match one field
echo '<pre>';print_r(Entity::find('beatles.json.php','John',1));//find the first record that exactly matches one field
echo '<pre>';print_r(Entity::find('beatles.json.php',[1=>'John'])); //find all the records where the second column exactly matches a value
echo '<pre>';print_r(Entity::find('beatles.json.php',[1=>'John'],1)); //find the first record where the second column exactly matches a value

//error checking
echo '<pre>';print_r(Entity::find('beatles.json.php','User does not exist'));
echo '<pre>';print_r(Entity::find('beatles.json.php',[1=>'John'])); //find all the records where the second column exactly matches a value
echo '<pre>';print_r(Entity::find('beatles.json.php',[1=>'John'],1)); //find the first record where the second column exactly matches a value
echo '<pre>';print_r(Entity::read("Fild does not exist")); //find the first record where the second column exactly matches a value

// DELETE
Entity::delete('beatles.json.php'); // delete a CSV file
Entity::delete('beatles.json.php',4,true); // delete the first record from a CSV file
Entity::delete('beatles.json.php',[0,1]); // delete the first and the second records from a CSV file

?>