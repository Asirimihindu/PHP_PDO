<?php require_once('core/init.php'); ?>

<?php
//Create Topic Object
$topic = new Topic_;

//Create User Object
$user = new User;

//Create Validator Object
$validate = new Validator;

if(isset($_POST['register'])){
	//Create Data Array
	$data = array();
	$data['name'] = $_POST['name'];
	$data['email'] = $_POST['email'];
	$data['username'] = $_POST['username'];
	$data['password'] = md5($_POST['password']);
	$data['password2'] = md5($_POST['password2']);
	$data['about'] = $_POST['about'];
	$data['last_activity'] = date("Y-m-d H:i:s");
	
	//Required Fields
	$field_array = array('name','email','username','password','password2');
	
	if($validate->isRequired($field_array)){
		if($validate->isValidEmail($data['email'])){
			if($validate->passwordsMatch($data['password'],$data['password2'])){
					//Upload Avatar Image
					if($user->uploadAvatar()){
						$data['avatar'] = $_FILES["avatar"]["name"];
					}else{
						$data['avatar'] = 'noimage.png';
					}
					//Register User
					if($user->register($data)){
						redirect('index.php', 'You are registered and can now log in', 'success');
					} else {
						redirect('index.php', 'Something went wrong with registration', 'error');
					}
			} else {
				redirect('register.php', 'Your passwords did not match', 'error');
			}
		} else {
			redirect('register.php', 'Please use a valid email address', 'error');
		}
	} else {
		redirect('register.php', 'Please fill in all required fields', 'error');
	}
}

//Get Template & Assign Vars
$template = new Template('templates/register.php');

//Assign Vars

//Display template
echo $template;