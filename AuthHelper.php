<?php
require("Entity.php");
class AuthHelper{

	static function signup($data,$file){
		if(isset($data['email'])){
			if(!Entity::find($file,$data['email'])){
				Entity::write($file,$data);
				session_start();
				$_SESSION['logged']= true;
				$_SESSION['email']= $data['email'];
				return true;
			}else return false;
			
	
		}
	}

	static function signin($data,$file){
		if(isset($data['email'])){
			if(Entity::find($file,$data['email'])){
				session_start();
				$_SESSION['logged']= true;
				$_SESSION['email']= $data['email'];
				return true;
			};
			return false;
		}

	}

	static function signout(){
		$_SESSION['logged']=false;
		$_SESSION['email']=null;
		session_destroy();
	}

	static function getUserInfo($data,$file){
		if(isset($data['email'])){
			return Entity::find($file,$data['email']);
		}return[]; 
	}

	static function is_logged(){
	if(isset($_SESSION)){
		if(isset($_SESSION['logged'])){
			if($_SESSION['logged']==true){return true;};
		};

	}
	return false;
	// check if the user is logged
	//return true|false
}
}