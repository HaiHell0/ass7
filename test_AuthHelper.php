<?php
include("AuthHelper.php");


AuthHelper::signup(['email'=>"HaiHoang@cnn.com",'hobbies'=>'doing the splits'],'users.csv');
AuthHelper::signin(['email'=>"HaiHoang@cnn.com"],'users.csv');
print_r(AuthHelper::getUserInfo(['email'=>"HaiHoang@cnn.com"],'users.csv'));
print_r ($_SESSION);//expected with initialized fields 
//Test sign in user
print_r(AuthHelper::is_logged()?"Yes":"No");//YES
//Test sign out user
AuthHelper::signout();//signs the user out
print_r(AuthHelper::is_logged()?"Yes":"No");//NO
print_r($_SESSION);//expected with uninitialized fields 
//testing with json file 
AuthHelper::signup(['email'=>"HaiHoang@cnn.com",'hobbies'=>'doing the splits'],'users.json');
AuthHelper::signin(['email'=>"HaiHoang@cnn.com"],'users.json');
print_r(AuthHelper::getUserInfo(['email'=>"HaiHoang@cnn.com"],'users.json'));
//Test sign in user
print_r(AuthHelper::is_logged()?"Yes":"No");//YES
//Test sign out user
AuthHelper::signout();//signs the user out
print_r(AuthHelper::is_logged()?"Yes":"No");//NO
print_r($_SESSION);//expected with uninitialized fields 





//sign in user that does not exist
//print_r(AuthHelper::signin(['email'=>"Does not exist@cnn.com"],'users.csv')?"Yes":"No");

//sign up user that already exists
//print_r(AuthHelper::signup(['email'=>"Does not exist@cnn.com"],'users.csv')?"Yes":"No");

?>