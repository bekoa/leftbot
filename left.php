<?php
// $host       = "sql3.freesqldatabase.com";
// $dbusername = "sql3418306";
// $dbpassword = "vkNZAmU2B4";
// $dbname     = "sql3418306";
// // $options=array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

// $conn='mysql:host='.$host.';dbname='.$dbname.';';

// try {
//   $db = new PDO($conn, $dbusername, $dbpassword);
//   // set the PDO error mode to exception
//   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
// } catch(PDOException $e) {
//   echo "Connection failed: " . $e->getMessage();
//   die();
// }
// #-------------------------------------------------
?> 


<?php
#-------------------------------------------------

ob_start();
$token = '1830290761:AAFGiEfxss3Ody1LtGc7Bsjv-UBi-2GJdqI'; //token bot

define('token',$token);


function bot($method,$data=[]){

  $url = "https://api.telegram.org/bot".token."/".$method;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);  
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

  $res = curl_exec($ch);

  if (curl_error($ch)) {
    var_dump(curl_error($ch));
  }else{
    return json_decode($res);
  }

}
$update = json_decode(file_get_contents('php://input'));

$chat_id    = $update->message->chat->id;
$msg_id     = $update->message->message_id;
$text       = $update->message->text;

$user_id    = $update->message->from->id;
$first_name = $update->message->from->first_name;
$user_name  = $update->message->from->username;

$gruop_id         = $update->message->chat->id;
$gruop_username   = $update->message->chat->username;
$group_type       = $update->message->chat->type;
$group_title       = $update->message->chat->title;

$admin = 1763999670;
$new = $update->message->new_chat_member->id;
$left = $update->message->left_chat_participant->id;
// #------check user-----------------------------------------------------------#-----------------------------------------------------------------
// $user = $db->prepare("SELECT COUNT(*) AS c ,user_id FROM users WHERE user_id='$user_id'"); //query to limit only 1 result
// $user->execute(); // execute qury

// while ($row = $user->fetch(PDO::FETCH_ASSOC)) {$user_db = $row['c'];}

// #------Count users-----------------------------------------------------------#-----------------------------------------------------------------
// $userCount = $db->prepare("SELECT COUNT(*) AS c  FROM users"); //query to limit only 1 result
// $userCount->execute(); // execute qury

// while ($rowCount = $userCount->fetch(PDO::FETCH_ASSOC)) {$user_db_count = $rowCount['c'];}

// #----------check group-------------------------------------------------------#-----------------------------------------------------------------
// $group_id_db = $db->prepare("SELECT COUNT(*) AS c ,group_id FROM groups WHERE group_id='$gruop_id'"); //query to limit only 1 result
// $group_id_db->execute(); // execute qury

// while ($row_group = $group_id_db->fetch(PDO::FETCH_ASSOC)) {$g_id = $row_group['c'];}
// #----------count group-------------------------------------------------------#-----------------------------------------------------------------
// $count_for_groups_admin = $db->prepare("SELECT COUNT(*) AS c ,group_id FROM groups"); //query to limit only 1 result
// $count_for_groups_admin->execute(); // execute qury

// while ($r_g_a = $count_for_groups_admin->fetch(PDO::FETCH_ASSOC)) {$count_g = $r_g_a['c'];}
// #-------------select group----------------------------------------------------#-----------------------------------------------------------------

// $count_for_groups_admin1 = $db->prepare("SELECT user_name FROM groups"); //query to limit only 1 result
// $count_for_groups_admin1->execute(); // execute qury
// #-------------select users----------------------------------------------------#-----------------------------------------------------------------

// $count_for_users_admin1 = $db->prepare("SELECT user_name FROM users"); //query to limit only 1 result
// $count_for_users_admin1->execute(); // execute qury



#------------------------------------------------------------------------------
$replyMarkup = array(
  'keyboard' => array(
  ["Groups","CountGroups"],
  ["Users","CountUsers"]
  ),
  'resize_keyboard'=>true
);
$encodedMarkup = json_encode($replyMarkup);

#------------------------------------------------------------------------------
$member = fopen('group.txt', 'a+');
$get = file_get_contents('group.txt');
$count_member = explode("\n",$get);
$c = count($count_member);


if ($gruop_id and !in_array($gruop_id,$count_member) ) {
            $member1 = fwrite($member,$gruop_id."\n");
              bot('sendMessage',[
              'chat_id'=>$admin,
              'text'=> 'new group : @'.$gruop_username.'
              id : '. $gruop_id . '
              title : '. $group_title.'
              tybe : '. $group_type.'
              count groups : '.$c
                ]);
          }

#---------------------------------------#---------------------------------------
if ($text == '/start' and $user_id == $admin) {

  bot('sendMessage',[
    'chat_id'=>$user_id,
    'text' => 'hi admin',
    'reply_markup' => $encodedMarkup
  ]
);
}

// elseif ($text == 'CountGroups' and $user_id == $admin) {

//   bot('sendMessage',[
//     'chat_id'=>$user_id,
//     'text' => $count_g,
//     'reply_markup' => $encodedMarkup
//   ]
// );
// }
// elseif ($text == 'Groups' and $user_id == $admin) {

//   while ($r_g_a1 = $count_for_groups_admin1->fetch(PDO::FETCH_ASSOC)) { 
  
//     $count_g1 = $r_g_a1['user_name']; 

  
//   bot('sendMessage',[
//     'chat_id'=>$user_id,
//     'text' => '@'.$count_g1 ."\n",
//     'reply_markup' => $encodedMarkup
//   ]
// );
// }  }
// elseif ($text == 'Users' and $user_id == $admin) {
// while ($row_users_admin1 = $count_for_users_admin1->fetch(PDO::FETCH_ASSOC)) {
//   $u_id = $row_users_admin1['user_name'];


//   bot('sendMessage',[
//     'chat_id'=>$user_id,
//     'text' => '@'.$u_id,
//     'reply_markup' => $encodedMarkup
//   ]
// );
// }}
// elseif ($text == 'CountUsers' and $user_id == $admin) {

//   bot('sendMessage',[
//     'chat_id'=>$user_id,
//     'text' => $user_db_count,
//     'reply_markup' => $encodedMarkup
//   ]
// );
// }
elseif ($text == '/start' and $user_db <= 0) {

//   $query = $db->prepare("INSERT INTO users (user_id,first_name,user_name) 
//   VALUES('$user_id','$first_name','$user_name')");
//     $query->execute();


  bot('sendMessage',[
    'chat_id'=>$user_id,
    'text'=> 'it\'s easy to use just put bot as admin in your channel 😁
    you can join our channel for more bots
    ']);

}
if ($text and $user_id == $admin) {

$url_check_admin = file_get_contents("https://api.telegram.org/bot".token."/getChat?chat_id=$text");

    $z = json_decode($url_check_admin);
    $t = $z->result->invite_link;
                  bot('sendMessage',[
                  'chat_id'=>$admin,
                  'text'=> $t
                    ]);
}


if ($left) {
  bot('deleteMessage',[
      'chat_id'=>$chat_id,
      'message_id'=>$msg_id

  ]);
}

if ($new) {
  bot('deleteMessage',[
      'chat_id'=>$chat_id,
      'message_id'=>$msg_id

  ]);
}





?>
