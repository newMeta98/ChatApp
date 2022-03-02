<?php 
session_start();
$dbhost = 'localhost';
$dbname = 'mychat';
$dbuser = 'root';
$dbpass = '';
$dbPDO = new PDO("mysql:dbhost=$dbhost;dbname=$dbname;", "$dbuser", "$dbpass");

include 'db.php';
include 'keys_locks.php';
include 'filters.php';
include 'cookies.php';
include 'funMessinger.php';

if ($_POST['action']  == 'random_key') {
	$random_key = dec_user_to_serv($_POST['random_key_php'], $kh);
	$random_key = encryptthis($random_key, $key_secret);
			
		create_cookie('SecretPHP', $random_key);				
}
if ($email =='') {
	
}else{



if (isset($_POST['action'])) {
	$action = filter_var($_POST['action'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);


	// HEADER top left
	if ($action  == 'Header_Chat') {
		
		$teble = 'users';
		$results_user = ALL_TABLE_WHERE1($teble, $email, $db);
    	
    	while($rows=mysqli_fetch_array($results_user)){

    		echo '<img class="small_profile" src="'.$rows['profile'].'">
             	 <h4>Chats</h4><input type="hidden" name="hidden_email" id="hidden_email" value="'.$email.'">';
    	}
	}
	
	// SEARCH chats
	if ($action  == 'search') {
		$name = filter_sring($_POST['name']);
        $name = mysql_escape($db, $name);
 		$btn_class = 'search_li';

		$search[] =  search($name, $btn_class, $email, $db);
			if (empty($search)) {
				
			}else{
				foreach ($search as $value) {
							foreach ($value as $val) {
								echo $val;
							}
						}
			}
						
			
			
	}

	if ($action  == 'search_btn') {
		$userEmail = $_POST['userEmail'];

		$query_user = "SELECT * FROM chats WHERE user1 = '$userEmail' OR user2 = '$userEmail'";
    	$results_user = mysqli_query($db, $query_user);		

  		while($rows=mysqli_fetch_array($results_user)){

  			if ($rows['user1'] == $email) {
  			 	
  			 	$chat_id = $rows['chat_id'];


  			}elseif ($rows['user2'] == $email) {
  				
  				$chat_id = $rows['chat_id'];

  			}
  		}
  		echo $chat_id;
	}	

	

	// CREATE New CHAT. When new user comes.
	if ($action  == 'Chats_new') {
		$return = Chats_new($email, $db);
		echo $return;
    }

    // echo CHATS on page
	if ($action  == 'Chats') {

		$start = isset($_POST['start']) ? intval($_POST['start']) : 0;

        	
		$query_user = "SELECT * FROM chats WHERE myid > '$start' order by myid ASC";
    	$results_user = mysqli_query($db, $query_user);
    	
    	$items = [];
    	while($rows=mysqli_fetch_array($results_user)){

    		$chatid = $rows['chat_id'];
    		$chatid = explode("-", $chatid);
    		$chatid = $chatid[0];

    		if ($chatid == 'id') {
    	
	    		if ($rows['user1'] == $email) {

					$items['msg'][] = chat_items_msg($db, $rows['lastmsg'],  $rows['timee'], 
												$email, $rows['user1'], $rows['user2'], 
												$rows['chat_id'], $rows['profile2'], 
												$rows['upd'], $rows['receive'], 
												$rows['seen'], $rows['username2'], 
												$key_msgs, $key_g, $key_n, 
												$key_publica, $_COOKIE['SecretPHP'], 
												$key_secret, $rows['typee'],
												$_SESSION['mypin'], $key_pin);
                    
	    		}elseif ($rows['user2'] == $email) {

	                $id = $rows['id'];
					$receive = 'y';

	                $sql = "UPDATE chats SET receive= '$receive' WHERE id = '$id'";
            			mysqli_query($db, $sql);

		       		$items['msg'][] =  chat_items_msg($db, $rows['lastmsg'],  $rows['timee'], 
												$email, $rows['user1'], $rows['user2'], 
												$rows['chat_id'], $rows['profile1'], 
												$rows['upd'], $rows['receive'], 
												$rows['seen'], $rows['username1'], 
												$key_msgs, $key_g, $key_n, 
												$key_publica, $_COOKIE['SecretPHP'], 
												$key_secret, $rows['typee'],
												$_SESSION['mypin'], $key_pin);

	    		}
	    	}
    	}

    	  $query_chats = "SELECT max(myid) AS max FROM chats";
		    $results_chats = mysqli_query($db, $query_chats);
				$rows= mysqli_fetch_object($results_chats);
				$myid = $rows->max;
				$items['id'][] = $myid;
    	    header('Access-Control-Allow-Origin: *');
		    	header('Content-Type: application/json');
		    	echo json_encode($items);
	}




	// look for new chats
	if ($action  == 'load_Chats') {

		$start = isset($_POST['startChat']) ? intval($_POST['startChat']) : 0;
		$DB = new mysqli("localhost","root","","chat");
		$items = $DB->query("SELECT * FROM chats WHERE myid >". $start);

		    	$query_chats = "SELECT max(myid) AS max FROM chats";
		    	$results_chats = mysqli_query($db, $query_chats);
				$rows= mysqli_fetch_object($results_chats);
				$myid = $rows->max;


		
		$DB->close();
		echo $myid;
    	//header('Access-Control-Allow-Origin: *');
    	//header('Content-Type: application/json');	

    	

	}



	// CHat header update
	if ($action  == 'chat_tab_header') {

		$chat_id = filter_var($_POST['chat_id'],
			FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

		$query_user = "SELECT * FROM chats WHERE chat_id = '$chat_id'";
    	$results_user = mysqli_query($db, $query_user);

    	$items = [];	
    	while($rows=mysqli_fetch_array($results_user)){

    		$chatid = $chat_id;
    		$chatid = explode("-", $chatid);
    		$chatid = $chatid[0];

    		if ($chatid == 'id') {


    			if ($rows['user1'] !== $email) {

	    			$header = '<img class="profile_img_m" src="'.$rows['profile1'].'">
	                    <h3>'.$rows['username1'].'</h3>
	                    <input type="hidden" id="chat_id" name="chat_id" value="'.$chat_id.'">
	                    <input type="hidden" id="user_email" name="user_email" value="'.$rows['user1'].'">';
	                
	                $items['header'][] =  $header; 

						if ($rows['seen'] == 'n') {
							$id = $rows['id'];
							$seen = 'y';
		  					$sql = "UPDATE chats SET seen= '$seen' WHERE id = '$id'";
	            				mysqli_query($db, $sql);
						}               

	                 $items['secret'] = create_secret($db, $key_g, $key_n, $email, $rows['user1'], $_COOKIE['SecretPHP'], $key_publica, $key_secret, $_SESSION['mypin'], $key_pin);  

                       
	    		}elseif ($rows['user2'] !== $email) {

	    			$header = '<img class="profile_img_m" src="'.$rows['profile2'].'">
	                    <h3>'.$rows['username2'].'</h3>
	                    <input type="hidden" id="chat_id" name="chat_id" value="'.$chat_id.'">
	                    <input type="hidden" id="user_email" name="user_email" value="'.$rows['user2'].'">';

	                $items['header'][] =  $header;

	                $items['secret'] = create_secret($db, $key_g, $key_n, $email, $rows['user2'], $_COOKIE['SecretPHP'], $key_publica, $key_secret, $_SESSION['mypin'], $key_pin);
	   
	    		}

	    	}
    	}
				$query_chats = "SELECT max(myid) AS max FROM messages";
		    	$results_chats = mysqli_query($db, $query_chats);
				$Rows= mysqli_fetch_object($results_chats);
				$myid = $Rows->max;              
    			
    			$items['start_send'] = $myid;
    			header('Access-Control-Allow-Origin: *');
		    	header('Content-Type: application/json');
		    	echo json_encode($items);
	}


	if ($action  == 'info_btns') {
		$chat_id = filter_var($_POST['chat_id'],
			FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

		$query_user = "SELECT * FROM chats WHERE chat_id = '$chat_id'";

        $results_user = mysqli_query($db, $query_user);
        
        
        while($rows=mysqli_fetch_array($results_user)){

        	$chatid = $chat_id;
    		$chatid = explode("-", $chatid);
    		$chatid = $chatid[0];

    		if ($chatid == 'id') {
    				if ($email == $rows['user1']) {
    					
    					$username = $rows['username2'];
    				}else if ($email == $rows['user2']){

    					$username = $rows['username1'];
    				}

	    		$info_btns = '<button class="shared_img info_btns_li" value="info_imgs">Deljene slike</button>
                <div class="chat_imgs_wrap" style="display: none;"></div>
	    		<button class="edit_nickname info_btns_li" value="info_nick">Nadimak</button>
                <div id="hidden_nick" style="display: none;">
                	'. $username .'<br>
                	<input type="text" name="info_input_nick" id="info_input_nick" value=""><br>
                	
                	<button class="btn_save btn_save_nick" value="'. $chat_id .'" id="btn_save_nick">Sacuvaj</button>
                </div>';
                
    		}

    		echo $info_btns;
        }

	}

	if ($action  == 'info_btn_save_nick') {
	$chat_id = filter_var($_POST['chat_id'],
		FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

	$username = filter_var($_POST['nick'],
		FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

	$query_user = "SELECT * FROM chats WHERE chat_id = '$chat_id'";

    $results_user = mysqli_query($db, $query_user);
    
    
	    while($rows=mysqli_fetch_array($results_user)){

        	$chatid = $chat_id;
    		$chatid = explode("-", $chatid);
    		$chatid = $chatid[0];

    		if ($chatid == 'id') {
				if ($email == $rows['user1']) {
					
					$sql = "UPDATE chats SET username2 = '$username' WHERE chat_id = '$chat_id'";
					mysqli_query($db, $sql);
					echo $username;

				}else if ($email == $rows['user2']){

					$sql = "UPDATE chats SET username1 = '$username' WHERE chat_id = '$chat_id'";
					mysqli_query($db, $sql);
					echo $username;

				}


    		}
	    }
	}
	if ($action  == 'receive_seen') {

		$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
		$query_user = "SELECT * FROM chats WHERE myid > '$start' order by myid ASC";

        $results_user = mysqli_query($db, $query_user);
        
        $items = [];
        while($rows=mysqli_fetch_array($results_user)){

    		$chatid = $rows['chat_id'];
    		$chatid = explode("-", $chatid);
    		$chatid = $chatid[0];

    		if ($chatid == 'id') {

	        	if ($rows['user1'] == $email) {
	        		# sender...

	        		$items['chat_id'] = $rows['chat_id'];
	        		$items['sender'] = $rows['user1'];
	        		$items['receiver'] = $rows['user2'];
	        		$items['receive'] = $rows['receive'];
	        		$items['seen'] = $rows['seen'];

					$items['seen_receive'][] = $items;
	        	}
	        	elseif ($rows['user2'] == $email) {
	        		# risover...

	        		$items['chat_id'] = $rows['chat_id'];
	        		$items['sender'] = $rows['user1'];
	        		$items['receiver'] = $rows['user2'];
	        		$items['receive'] = $rows['receive'];
	        		$items['seen'] = $rows['seen'];

	        		$items['seen_receive'][] = $items;
	        	}
        	}
				}

    	  $query_chats = "SELECT max(myid) AS max FROM chats";
		    $results_chats = mysqli_query($db, $query_chats);
				$rows= mysqli_fetch_object($results_chats);
				$myid = $rows->max;
				$items['id'][] = $myid;
    	    	header('Access-Control-Allow-Origin: *');
		    	header('Content-Type: application/json');
		    	echo json_encode($items);

					
				}
	

	if ($action  == 'seen_new') {
		$chat_id = $_POST['chat_id'];
        $chat_id = filter_sring($chat_id);

        $query_user = "SELECT * FROM chats WHERE chat_id = '$chat_id'";
        $results_user = mysqli_query($db, $query_user);

        while($rows=mysqli_fetch_array($results_user)){
        	$chatid = $chat_id;
    		$chatid = explode("-", $chatid);
    		$chatid = $chatid[0];

    		if ($chatid == 'id') {

	        	if ($rows['user2'] == $email) {

	        		if ($rows['seen'] == 'n') {
							$id = $rows['id'];
							$seen = 'y';
		  					$sql = "UPDATE chats SET seen= '$seen' WHERE id = '$id'";
	            				mysqli_query($db, $sql);
					}
	        	}
	        }
        }
	}



	if ($action  == 'send_msg') {
         	$chat_id = $_POST['chat_id'];
         	$chat_id = filter_sring($chat_id);
         	$user_email = $_POST['user_email'];
         	$user_email = filter_sring($user_email);
         	$type = $_POST['typee'];
			$type = filter_sring($type);

         	$timee = time();
         	$seen = 'n';
         	
         	if ($type == 'text') {
         		$message = $_POST['message'];
         		$message = encryptthis($message, $key_msgs);
         	}


         	if ($message) {

         		$query_chats = "SELECT max(myid) AS max FROM chats";
		    	$results_chats = mysqli_query($db, $query_chats);
				$rows= mysqli_fetch_object($results_chats);
				$myid = $rows->max;

				
	         	$lastmsg = $message;
				$receive = 'n';
				
				$myid = $myid +1;
				
				$upd = "y";

				$Query_user = "SELECT * FROM chats WHERE chat_id = '$chat_id'";
        		$Results_user = mysqli_query($db, $Query_user);

       			while($Rows=mysqli_fetch_array($Results_user)){

		       		$chatid = $chat_id;
		    		$chatid = explode("-", $chatid);
		    		$chatid = $chatid[0];

		    		$query_User = "SELECT * FROM users WHERE email = '$email'";
		        	$results_User = mysqli_query($db, $query_User);
					while($row=mysqli_fetch_array($results_User)){

						$msg_profile = $row['profile'];

		    		if ($chatid == 'id') {
	       				
		        		if ($Rows['user1'] == $email) {

		        			$profile1 = $Rows['profile1'];
		        			$profile2 = $Rows['profile2'];
		        			$username1 = $Rows['username1'];
		        			$username2 = $Rows['username2'];
		        		}else if ($Rows['user2'] == $email) {

		        			$profile1 = $Rows['profile2'];
		        			$profile2 = $Rows['profile1'];
		        			$username1 = $Rows['username2'];
		        			$username2 = $Rows['username1'];	        			
		        		}
		        	}
			    	}
	        	}



			$sql = "UPDATE chats SET user1 = '$email', user2 = '$user_email', username1 = '$username1', username2 = '$username2', profile1 = '$profile1', profile2 = '$profile2', lastmsg = '$lastmsg', timee= '$timee', seen= '$seen', receive= '$receive', myid= '$myid', upd= '$upd', typee= '$type' WHERE chat_id = '$chat_id'";
            mysqli_query($db, $sql);

				$query_chats = "SELECT max(myid) AS max FROM messages";
		    	$results_chats = mysqli_query($db, $query_chats);
				$rows= mysqli_fetch_object($results_chats);
				$myid2 = $rows->max;
				$myid2 = $myid2 +1;
       		$query = $dbPDO->prepare("INSERT INTO messages SET chat_id=?, message=?, user=?, timee=?, profile=?, typee=? , myid=?");
       		$query->execute([$chat_id, $message, $email, $timee, $msg_profile, $type, $myid2]);
               }
	}

	if ($action  == 'messages') {
		$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
// Select Messages From DB // Filtering selected chat

        $chat_id = $POST['chat_id'];
        $start = isset($POST['start_message']) ? intval($POST['start_message']) : 0;
        if ($POST['RsStart'] == 1) {
        	$start = 0;

        }

        $query = $dbPDO->prepare("SELECT * FROM messages WHERE myid >? AND chat_id =? order by myid desc LIMIT 18");
        $query->execute([$start, $chat_id]);
        $rs = $query->fetchAll(PDO::FETCH_OBJ);
// Select Messages From DB // Displaing messages
        $items = [];
        foreach ($rs as $item) {
        	$item->message = decryptthis($item->message, $key_msgs);
    		$items[] = $item;
		}

			$query_chats = "SELECT max(myid) AS max FROM messages";
		    $results_chats = mysqli_query($db, $query_chats);
			$rows= mysqli_fetch_object($results_chats);
			$myid2 = $rows->max;


		$result['items'] = array_reverse($items);
		$result['myid'] = $myid2;
		header('Access-Control-Allow-Origin: *');
    	header('Content-Type: application/json');
    	echo json_encode($result);
	}

    if ($_POST["action"] == "upload_profileImg") {

    		  $img_email = $_POST['img_email'];
              $ext = array('jpg', 'jpeg', 'png');
              $file_ext = explode('.',$_FILES["image"]['name']);
              $img_name = $file_ext[0];
              $file_ext = end($file_ext);
              $Name = md5(rand())."-".md5(rand()).".".$file_ext;
              if (!in_array($file_ext, $ext)){
              ?> <div class="error-msg">
              <?php  echo $_FILES["image"]['name'] . ' - Invalid file extension!';
            ?> </div> <?php
              }else
              {


			$maxDim = 200;
			$file_name = $_FILES['image']['tmp_name'];
			list($width, $height, $type, $attr) = getimagesize( $file_name );
			if ( $width > $maxDim || $height > $maxDim ) {
			    $target_filename = $file_name;
			    $ratio = $width/$height;
			    if( $ratio > 1) {
			        $new_width = $maxDim;
			        $new_height = $maxDim/$ratio;
			    } else {
			        $new_width = $maxDim*$ratio;
			        $new_height = $maxDim;
			    }
			    $src = imagecreatefromstring( file_get_contents( $file_name ) );
			    $dst = imagecreatetruecolor( $new_width, $new_height );
			    imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
			    imagedestroy( $src );

			    if ($file_ext == 'png') {    // adjust format as needed
			     	imagepng( $dst, $target_filename );
			     } 

			     elseif ($file_ext == 'jpeg') {    // adjust format as needed
			     	imagejpeg( $dst, $target_filename );
			     } 

			     elseif ($file_ext == 'jpg') {    // adjust format as needed
			     	imagejpeg( $dst, $target_filename );
			     } 

			    imagedestroy( $dst );

				$img_dir = '../profile/'.$Name;
          		$Img_dir = 'profile/'.$Name;
              	move_uploaded_file($_FILES["image"]['tmp_name'], $img_dir);


                $sql = "UPDATE users SET profile = '$Img_dir' WHERE email = '$img_email'";
          		mysqli_query($db, $sql);
          
          		$query_user = "SELECT * FROM chats WHERE user1 = '$img_email' OR user2 = '$img_email'";
        		$results_user = mysqli_query($db, $query_user);

       			while($rows=mysqli_fetch_array($results_user)){

	        		if ($rows['user1'] == $img_email) {

	        			$Sql = "UPDATE chats SET profile1 = '$Img_dir' WHERE user1 = '$img_email'";
          				mysqli_query($db, $Sql);
	        		}else if ($rows['user2'] == $email) {
	        			
	        			$Sql = "UPDATE chats SET profile2 = '$Img_dir' WHERE user2 = '$img_email'";
          				mysqli_query($db, $Sql);
	        		}
        		}


           		echo $_FILES["image"]['name'] . ' - Seccess! Image has uploaded!';
			}
          }   

    }
    if ($_POST["action"] == "gn") {
    
					$g = rand(11111111,99999999);
						$g =encryptthis($g, $key_g);

  					$n = rand(111111111111111111,
            		999999999999999999);
            			$n = encryptthis($n, $key_n);

					$query = $dbPDO->prepare("INSERT INTO gn SET g=?, n=?");
				    $query->execute([$g, $n]);
    }
       if ($_POST["action"] == "enterPIN") {

    				$pin = dec_user_to_serv($_POST['pin'], $kh);
					$pin = mysql_escape($db, $pin);
					$pin = filter_sring($pin);

					if (filter_var($pin, FILTER_VALIDATE_INT)) {
						$pin = encryptthis($pin, $key_pin);
						$_SESSION['mypin'] = $pin;
					} else {
					    echo("false");
					} 		
    }
}
}
?>