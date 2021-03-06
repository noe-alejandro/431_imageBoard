<?php

  //*****************************************************
  //**** User Registration and Authentication Queries ***
  //*****************************************************

  // Create new user
  function register_user_query($username, $password, $fullname, $profile_image, $status)
  {
    // Encrypt password using MD5 algorithm
    $hash = md5($password);
    $query  = "INSERT INTO USER (";
    $query .= "Username, Password, Fullname, ProfilePic, Status";
    $query .= ") VALUES (";
    $query .= "'{$username}', '{$hash}', '{$fullname}', '{$profile_image}', $status";
    $query .= ");";

    return $query;
  }

  // Search for the users credentials
  function authenticate_user_query($username, $password)
  {
    // Encrypt password using MD5 algorithm
    $hash = md5($password);

    $query  = "SELECT * ";
    $query .= "FROM USER ";
    $query .= "WHERE Username = '{$username}' AND Password = '{$hash}';";

    return $query;
  }

  // Create new chatroom
  function create_chatroom_query($username, $chatroom_subject)
  {
    $query  = "INSERT INTO CHATROOM (";
    $query .= "RoomName, StartUser";
    $query .= ") VALUES (";
    $query .= "'{$chatroom_subject}', '{$username}'";
    $query .= ");";

    return $query;
  }

  // Get user info
  function get_user($username)
  {
    $query  = "SELECT * ";
    $query .= "FROM USER ";
    $query .= "WHERE Username = '{$username}'";

    return $query;
  }

  // Update profile picture
  function update_profile_image_query($username, $image_data)
  {
    $query = "UPDATE USER ";
    $query .= "SET ProfilePic = '{$image_data}' ";
    $query .= "WHERE Username = '{$username}'";

    return $query;
  }

  //****************************************************
  //************* Chatroom Feature Queries *************
  //****************************************************

  // Retrieve all chatrooms created
  function get_chatrooms_query()
  {
    $query  = "SELECT * ";
    $query .= "FROM CHATROOM;";

    return $query;
  }

  // Save chat message from the user
  function log_chat_query($username, $room_id, $chat_message)
  {
    $query  = "INSERT INTO CHATROOMLOG (";
    $query .= "ChatEntry, SentBy, RoomNo";
    $query .= ") VALUES (";
    $query .= "'{$chat_message}', '{$username}', $room_id";
    $query .= ");";

    return $query;
  }

  // Retrieve all chats for the particular chatroom
  function get_chatlog_query($room_id)
  {
    $query  = "SELECT * ";
    $query .= "FROM CHATROOMLOG ";
    $query .= "WHERE RoomNo = $room_id";

    return $query;
  }

  function get_chatroom_user_query($room_id)
  {
    $query  = "SELECT * ";
    $query .= "FROM CHATROOMUSER ";
    $query .= "WHERE RoomNo = $room_id";

    return $query;
  }

  function add_chatroom_user_query($username, $room_id)
  {
    $query  = "INSERT INTO CHATROOMUSER (";
    $query .= "User, RoomNo";
    $query .= ") VALUES (";
    $query .= "'{$username}', $room_id";
    $query .= ");";

    return $query;
  }

  function remove_chatroom_user_query($username, $room_id)
  {
    $query  = "DELETE FROM CHATROOMUSER ";
    $query .= "WHERE ";
    $query .= "User = '{$username}' AND RoomNo = $room_id";

    return $query;
  }

  //****************************************************
  //************* Mailbox System Queries ***************
  //****************************************************

  // Create new message
  function create_mail_query($subject, $content, $sender, $receiver, $status)
  {
    $query  = "INSERT INTO MAILBOX (";
    $query .= "MsgText, Status, Subject, Sender, Receiver";
    $query .= ") VALUES (";
    $query .= "'{$content}', '{$status}', '{$subject}', '{$sender}', '{$receiver}'";
    $query .= ");";

    return $query;
  }

  // Retrieve all messages sent to user
  function get_message_inbox($username)
  {
    $query  = "SELECT * ";
    $query .= "FROM MAILBOX ";
    $query .= "WHERE Receiver = '{$username}' ";
    $query .= "ORDER BY MsgDate DESC ;";

    return $query;
  }

  // Retrieve all messages sent by user
  function get_message_sent($username)
  {
    $query  = "SELECT * FROM MAILBOX ";
    $query .= "WHERE Sender = '{$username}' ;";

    return $query;
  }

  function get_single_message($messageID)
  {
    $query = "SELECT * FROM MAILBOX ";
    $query .= "WHERE MsgID = $messageID;";

    return $query;
  }

  function update_message_status($messageID, $status)
  {
    $query = "UPDATE MAILBOX ";
    $query .= "SET Status = $status ";
    $query .= "WHERE MsgID = $messageID;";

    return $query;
  }

  //****************************************************
  //***************** Forum Queries ********************
  //****************************************************
  function get_forums()
  {
    $query = "SELECT *";
    $query .= "FROM FORUM";

    return $query;
  }
  function request_forum($forumname, $description, $user)
  {
    $query  = "INSERT INTO REQUESTS (";
    $query .= "FName, Description, RequestedBy";
    $query .= ") VALUES (";
    $query .= "'{$forumname}', '{$description}', '{$user}'";
    $query .= ");";
    return $query;
  }

  //****************************************************
  //*********** Threads and Posts Queries **************
  //****************************************************
  function get_related_threads($forumName)
  {
    $query = "SELECT * FROM THREAD WHERE FName = '{$forumName}';";
    return $query;
  }

  function create_thread_query($forumname, $status, $title, $content, $start_user)
  {
    $query  = "INSERT INTO THREAD (";
    $query .= "FName, Status, Title, Content, StartUser";
    $query .= ") VALUES (";
    $query .= "'{$forumname}', '{$status}', '{$title}', '{$content}', '{$start_user}'";
    $query .= ");";
    return $query;
  }

  function get_posts($threadNo)
  {
    $query = "SELECT PostText, PostDate, Poster, PostNo, Photodata FROM POST WHERE ThreadNo = '{$threadNo}';";
    return $query;
  }

  function post_reply($username, $post, $image, $threadNo)
  {
    $query  = "INSERT INTO POST (";
    $query .= "Poster, PostText, Photodata, ThreadNo";
    $query .= ") VALUES (";
    $query .= "'{$username}', '{$post}', '{$image}' ,'{$threadNo}'";
    $query .= ");";
    return $query;
  }

  function update_post($content, $postNo)
  {
    $query  = "UPDATE POST SET PostText='{$content}' WHERE PostNo='{$postNo}';";
    return $query;
  }

  //****************************************************
  //**************** Moderator Queries *****************
  //****************************************************



  //****************************************************
  //************* Administrator Queries ****************
  //****************************************************


?>
