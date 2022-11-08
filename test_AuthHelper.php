<?php
include("AuthHelper.php");


AuthHelper::signup(['email'=>"HaiHoang@cnn.com",'hobbies'=>'doing the splits'],'users.csv');
AuthHelper::signin(['email'=>"HaiHoang@cnn.com"],'users.csv');
print_r(AuthHelper::getUserInfo(['email'=>"HaiHoang@cnn.com"],'users.csv'));
print_r ($_SESSION);
//Test sign in user
print_r(AuthHelper::is_logged()?"Yes":"No");
//Test sign out user
AuthHelper::signout();
print_r(AuthHelper::is_logged()?"Yes":"No");
//sign in user that does not exist
print_r(AuthHelper::signin(['email'=>"Does not exist@cnn.com"],'users.csv')?"Yes":"No");

//sign up user that already exists
print_r(AuthHelper::signup(['email'=>"Does not exist@cnn.com"],'users.csv')?"Yes":"No");

?>