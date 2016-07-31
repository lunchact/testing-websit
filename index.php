<?php
$refresh = "";
$app_token = "0dkgmly4vwspve2z2q4itq26l";
$parameters = array();
$parameters = json_decode('{"device": {"id": "123s456s789", "platform": "ios", "appVersion": "1.0"}, "userId": "abadsdons"}');
$jwt = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6ImFwcF81NzkwZjM3MjdlMTFlMjU3MDBlYjc0NjUifQ.eyJzY29wZSI6ImFwcCJ9.BRwiJ8jQnH7aWoAafHp013hu9sFTdqHdk2cThnO1-WI";
//$jwt = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6ImFwcF81NzkzNThkZjcwYTQ0NzRiMDAyYzFhY2MifQ.eyJzY29wZSI6ImFwcCJ9.x11ff8xYNljFxcW-8pXCiEarwEFUbXUz-ahg7jC2Kq4";
$handle = curl_init("https://api.smooch.io/v1/init");
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($handle, CURLOPT_TIMEOUT, 60);
curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
curl_setopt($handle, CURLOPT_HTTPHEADER, 
	array("Content-Type: application/json; charset=utf-8","Authorization: Bearer ".$jwt)
);

$response = curl_exec($handle);
$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
curl_close($handle);

$response = json_decode($response, true);
//print_r($response);

$app_user_id = $response["appUser"]["_id"];
$user_id = $response["appUser"]["userId"];

//echo 'message: ',$_POST["chatMessage"],'<br><br>';
if (isset($_POST["cmd"]) && $_POST["cmd"] == "sendMessage" && !empty($_POST["chatMessage"])) {
    /*
    curl https://api.smooch.io/v1/appusers/c7f6e6d6c3a637261bd9656f/conversation/messages \
     -X POST \
     -d '{"text":"Just put some vinegar on it", "role": "appMaker"}' \
     -H 'content-type: application/json' \
     -H 'authorization: Bearer your-jwt'
    */
    
    $parameters = array();
    $parameters = json_decode('{"text":"'.$_POST["chatMessage"].'", "role": "appUser"}');
    $handle = curl_init("https://api.smooch.io/v1/appusers/".$user_id."/conversation/messages");
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
    curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
    curl_setopt($handle, CURLOPT_HTTPHEADER, 
        array("Content-Type: application/json; charset=utf-8","app-token: ".$app_token)
    );
    $response = curl_exec($handle);
    $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
    curl_close($handle);
    $refresh = "document.location.replace('index.php');";
}
//get conversations of user

//https://api.smooch.io/v1/appusers/c7f6e6d6c3a637261bd9656f/conversation
//curl https://api.smooch.io/v1/appusers/c7f6e6d6c3a637261bd9656f/conversation \
//     -H 'app-token: cr2g6jgxrahuh68n1o3e2fcnt'

$handle = curl_init("https://api.smooch.io/v1/appusers/".$user_id."/conversation");
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($handle, CURLOPT_TIMEOUT, 60);
curl_setopt($handle, CURLOPT_HTTPHEADER, 
	array("Content-Type: application/json; charset=utf-8","app-token: ".$app_token)
);

$response = curl_exec($handle);
$http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
curl_close($handle);

$response = json_decode($response, true);
//print_r($response);

$conversation_messages = $response["conversation"]["messages"];
$count = count($conversation_messages);
$response_text = "";
for ($i=0;$i<$count;$i++) {
    $className = "message left appeared";
    if ($conversation_messages[$i]['role'] == 'appUser')
        $className = "message right appeared";

    $response_text .= '<li class="'.$className.'">
                    <div class="avatar"></div>
                    <div class="text_wrapper">
                        <div class="text">'.$conversation_messages[$i]['text'].'</div>
                    </div>
                </li>';
}

?>
<!DOCTYPE html>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="stylesheets/chatstyle.css">
    <link type="text/css" rel="stylesheet" href="stylesheets/bootstrap.min.css">

</head>

<body class="home-page">

    <div id="container-fluid">

        <div class="chat_window">
            <div class="top_menu">
                <div class="title">Welcome to THE chatbot
                </div>
            </div>

            <ul class="messages">
                <?php echo $response_text; ?>
                <!--li class="message right appeared">
                    <div class="avatar"></div>
                    <div class="text_wrapper">
                        <div class="text">Hi hi</div>
                    </div>
                </li-->
            </ul>

            <div class="bottom_wrapper clearfix">
                <div class="message_input_wrapper">
                    <input class="message_input" placeholder="Type your message here..." />
                </div>
                <div class="send_message">
                    <div class="icon"></div>
                    <div class="text">Send</div>
                </div>
            </div>
        </div>

                <div class="avatar">
                </div>
                <div class="text_wrapper">
                    <div class="text"></div>
                </div>
        <div class="message_template">
            <li class="message">
            hello</li>
        </div>

    </div>

    <form name="chatform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="chatMessage" id="chatMessage" value="" />
        <input type="hidden" name="cmd" value="sendMessage" />
    </form>

<script type="text/javascript" src="javascripts/bootstrap.min.js"></script>
<!--script type="text/javascript" src="javascripts/chatjs.js"></script-->
<script type="text/javascript" src="javascripts/jquery.js"></script>

<script type="text/javascript">

$(document).ready(function(){
    var getMessageText = function () {
            var $message_input;
            $message_input = $('.message_input');
            return $message_input.val();
        };
    $('.send_message').click(function (e) {
            $('#chatMessage').val(getMessageText()); 
            $("form").submit();
    });
    $('.message_input').keyup(function (e) {
            if (e.which === 13) {
                $('#chatMessage').val(getMessageText()); 
                $("form").submit();
            }
    });
});
<?php echo $refresh; ?>
</script>

</body>
</html>
