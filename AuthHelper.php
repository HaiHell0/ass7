
<?php
// add parameters
function signin($email,$password,$file){
	if(!file_exists($file))return false;
	// 7. check if the email is registered and if password matches
	$user_emails = csvToArray('..\data\users.csv');
	foreach($user_emails as $user_email){
		if($user_email[0]==$email){
			if(decrypt($user_email[1])==$password){
				
				//password is correct
				//store session info
				$_SESSION['logged']= true;
				$_SESSION['email']= $email;
				redirect("successfully loged in",'../members_page.php');
			}else reload($password.decrypt($user_email[1]));
		}
	};reload('User not found');
	
}

// add parameters
function signup($email, $password){
	// add the body of the function based on the guidelines of signin.php
	// check if the email is valid
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) reload('Your email is invalid');
	
	// check if password length is between 8 and 16 characters
	if(strlen($password)<8) reload('Password too short');
	if(matchStr($password)<2){reload("Password has too few special characters");}
	// 4. check if the file containing banned users exists
	if(!file_exists('..\data\banned.csv')){{reload('cant reach banned user database');}}
	if(!file_exists('..\data\users.csv')){{reload('cant reach user database');}}

	$banned_emails = csvToArray('..\data\banned.csv');
	$user_emails = csvToArray('..\data\users.csv');
	//print_r($banned_emails);
	//echo '<br>';
	foreach($banned_emails as $banned_email){
		//print_r($banned_email);
		if($banned_email[0]==$email){
			reload('Email is on ban list');
		}
	};
	// 6. check if the file containing users exists


	foreach($user_emails as $user_email){
		if($user_email[0]==$email){
			reload('This user already exists');
			die();
		}
	};

	$password = encrypt($password);
	newRecord('..\data\users.csv',array($email,$password));
	return true;
	
}

function signout(){
	// add the body of the function based on the guidelines of signout.php
	if($_SESSION['logged']==false){
		redirect("You are not logged on", '..\index.php');
	}
	// if the user is not logged in, redirect them to the public page


	// use the following guidelines to create the function in auth.php
	$_SESSION['logged']=false;
	session_destroy();
	// redirect the user to the public page.
	redirect("Successfully logged out","..\index.php");
	}


function is_logged(){
	if(isset($_SESSION)){
		if(isset($_SESSION['logged'])){
			if($_SESSION['logged']==true){return true;};
		};

	}
	return false;
	// check if the user is logged
	//return true|false
}