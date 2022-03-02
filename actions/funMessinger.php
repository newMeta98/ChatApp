<?php 

 		// SMALL FUN
function ALL_TABLE_WHERE1($teble, $email, $db)
{
	$query_user = "SELECT * FROM $teble WHERE email = '$email'";
	$results_user = mysqli_query($db, $query_user);
	return $results_user;
}

function MaxID_plus1($table, $db)
{
	$query_chats = "SELECT max(myid) AS max FROM $table";
	$results_chats = mysqli_query($db, $query_chats);
	if ($results_chats) {
			$rows= mysqli_fetch_object($results_chats);
			$myid = $rows->max;

			$myid = $myid +1;
			return $myid;
	}else{
			$myid = 1;
			return $myid;
	}

}
function MaxID($table, $db)
{
	$query_chats = "SELECT max(myid) AS max FROM $table";
	$results_chats = mysqli_query($db, $query_chats);
	$rows= mysqli_fetch_object($results_chats);
	$myid = $rows->max;

	return $myid;
}


function chat_id_filter($chat_id)
{
	$chatid = $chat_id;
    $chatid = explode("-", $chatid);
    $chatid = $chatid[0];

    return $chatid;
}

function chat_tab_header($profile, $username, $chat_id, $user)
{
	$header = '<img class="profile_img_m" src="'.$profile.'">
                    <h3>'.$username.'</h3>
                    <input type="hidden" id="chat_id" name="chat_id" value="'.$chat_id.'">
                    <input type="hidden" id="user_email" name="user_email" value="'.$user.'">';

    return $header;
}

		// BIG FUN

function search($name, $btn_class, $email, $db)
	{
		$query_user = "SELECT * FROM users WHERE username LIKE '%$name%'";
    	$results_user= mysqli_query($db, $query_user);
    	$num_row = $results_user->num_rows;
    	if ($num_row != 0) {
	    	while($rows=mysqli_fetch_array($results_user)){
	    		
					if ($rows['email'] != $email) {

						$search[] = '<button class="'.$btn_class.' no_outline chats_li_style" id="'.$rows['email'].'">
		                   		<div class="chats_li_name left">
		                        	<img src="'.$rows['profile'].'">
										<input class= "chats_name no_outline pointer disable-select" type= "text" name= "chats_name" value= "'.$rows['username'].'" readonly></div></button>';	
		           	}	
	    	}	
	    	
    	}else{
    		$search[] ='';
    	}
    	return $search;	
	}
function Chats_new($email, $db)
{	
	$query_user = "SELECT * FROM users";
	$results_user = mysqli_query($db, $query_user);
	
	$users_array[]="";
	while($rows=mysqli_fetch_assoc($results_user)){
		
			$users_array[] = $rows;
    	$username = $rows['username'];
    	$profile = $rows['profile'];
	}

	foreach ($users_array as $users_emails) {
		if ($users_emails != "") {
			$Users_emails[] = $users_emails['email'];
		}
	}

	$query_chats = "SELECT * FROM chats";
	$results_chats = mysqli_query($db, $query_chats);
	
	$chats_array[]="";

	while($rows=mysqli_fetch_assoc($results_chats)){
		if (($rows['user1'] == $email) || ($rows['user2'] == $email)){
					
				$chats_array[] = $rows;
		}
	}
	
	$Chats_emails1[]="";
	foreach ($chats_array as $chats_emails) {
		if ($chats_emails != "") {

			$Chats_emails1[] = $chats_emails['user1'];
		}
	}
	$Chats_emails2[]="";
	foreach ($chats_array as $chats_emails) {
		if ($chats_emails != "") {
			$Chats_emails2[] = $chats_emails['user2'];
		}
	}
	
	$emails_filter1 = array_diff($Users_emails, $Chats_emails1);
	
	$emails_filter2 = array_diff($emails_filter1, $Chats_emails2);
	

	if ($emails_filter2 != "") {
		$chat_id = "id-".md5(rand());
		$user2 = "";
		foreach ($emails_filter2 as $user) {
			if ($emails_filter2 != "") {
				if ($user != $email) {
					$user2 = $user;
				}	
			}
		}

		if ($user2 != "") {
			if ($user2 != $email) {
				$query_user = "SELECT * FROM users WHERE email = '$email'";
		    	$results_user = mysqli_query($db, $query_user);
			
		    	while($rows=mysqli_fetch_assoc($results_user)){

			    	$username1 = $rows['username'];
			    	$profile1 = $rows['profile'];
				}


				$query_user = "SELECT * FROM users WHERE email = '$user2'";
		    	$results_user = mysqli_query($db, $query_user);
			
		    	while($rows=mysqli_fetch_assoc($results_user)){

			    	$username2 = $rows['username'];
			    	$profile2 = $rows['profile'];
				}					

					$last_msg = 'dfdsffwe243fv45h56h45t3b5th56btyh65yh5n56h5';

					$timee = time();
					$seen = "n";
					$receive = "n";
					$upd = 'n';

					
					$table = 'chats';
					$myid = MaxID_plus1($table, $db);

			

	$query1 = "INSERT INTO chats (chat_id, user1, user2, username1, username2, profile1, profile2, lastmsg, timee, seen, receive, myid, upd, typee)
		VALUES('$chat_id', '$email', '$user2', '$username1', '$username2', '$profile1', '$profile2', '$last_msg', '$timee', '$seen', '$receive', '$myid', '$upd', '$typee')";
	
	if(mysqli_query($db, $query1)){
	    return $user2; 
		return "1"; 
	}  
			}
        }	
	}
}

function chat_items_msg($db, $lastmsg,  $timee, $email, $user1, $user2, $chat_id, $profile2, $upd, $receive, $seen, $username2, $key_msgs, $key_g, $key_n, $key_publica, $SecretPHP, $key_secret, $type, $mypin, $key_pin)
{

	$items['email'] = $email;
	$items['sender'] = $user1;
	$items['receiver'] = $user2;
	$items['chat_id'] = $chat_id;
   	
	$items['username'] = $username2;
  	

   	if ($email != $user2) {
		
   		$userpub = $user2;
   	}elseif ($email != $user1){

    	$userpub = $user1;
    }

    $Query_user = "SELECT * FROM users WHERE email = '$email'";
	$Results_user = mysqli_query($db, $Query_user);

	while($Rows=mysqli_fetch_assoc($Results_user)){
		$a = $Rows['a'];
	}




   	$items['profile'] = $profile2;

   	if ($upd == 'y') {
   		$items['lastmsg'] = decryptthis($lastmsg, $key_msgs);
   	}elseif ($upd == 'n') {
   		$items['lastmsg'] = $lastmsg;
   	}

    $items['timee'] = $timee;
    $items['update'] = $upd;
    $items['receive'] = $receive;
    $items['seen'] = $seen;
    $items['typee'] = $type;


   
    $items['secret'] = create_secret($db, $key_g, $key_n, $email, $userpub, $SecretPHP, $key_publica, $key_secret, $mypin, $key_pin);

    return $items;
}

function create_secret($db, $key_g, $key_n, $email, $userpub, $SecretPHP, $key_publica, $key_secret, $mypin, $key_pin)
{
    
  
		
	$query_User = "SELECT * FROM users WHERE email = '$userpub'";
	$results_User = mysqli_query($db, $query_User);

	while($row=mysqli_fetch_assoc($results_User)){
		$b = $row['publica'];

	}
    $Query_user = "SELECT * FROM users WHERE email = '$email'";
	$Results_user = mysqli_query($db, $Query_user);

	while($Rows=mysqli_fetch_assoc($Results_user)){
		$a = $Rows['a'];
	}

	$query_user = "SELECT * FROM gn WHERE id= '4' LIMIT 1";
	$results_user = mysqli_query($db, $query_user);

	while($rows=mysqli_fetch_assoc($results_user)){
		$g = $rows['g'];
		$n = $rows['n'];
	}



    $g = decryptthis($g, $key_g);

	$n = decryptthis($n, $key_n);

	$pin = decryptthis($mypin, $key_pin);

	$a =  decryptthis($a, pinkey($pin));

	$PublicKey_b =  decryptthis($b, $key_publica);

    $secret_b = bcpowmod($PublicKey_b, $a, $n);

    if ($secret_b) {

    	$numbers = $secret_b;
		$split_num = str_split($numbers,5);

		$secret = 'Weov'.$split_num[0].'r#%vr'.$split_num[1].'eimEb$tKEAWB'.$split_num[3].'sdf^#df'.$split_num[2].'^%cs)uO';

		$random_key = decryptthis($SecretPHP, $key_secret);
		$secret = CryptoJSAesEncrypt($random_key , $secret);

    }

	return $secret;
}



?>