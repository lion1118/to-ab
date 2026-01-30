 ```php
   <?php
   $appId = "wx80b82b23269ab2f2";
   $appSecret = "7982e76c9f380873ade728f161c7580d";
   $url = $_GET['url'];
   
   $tokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appId&secret=$appSecret";
   $tokenJson = file_get_contents($tokenUrl);
   $tokenArray = json_decode($tokenJson, true);
   $accessToken = $tokenArray['access_token'];
   
   $ticketUrl = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=$accessToken&type=jsapi";
   $ticketJson = file_get_contents($ticketUrl);
   $ticketArray = json_decode($ticketJson, true);
   $ticket = $ticketArray['ticket'];
   
   $nonceStr = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 16);
   $timestamp = time();
   $string = "jsapi_ticket=$ticket&noncestr=$nonceStr×tamp=$timestamp&url=$url";
   $signature = sha1($string);
   
   header('Content-Type: application/json');
   echo json_encode([
       "appId" => $appId,
       "timestamp" => $timestamp,
       "nonceStr" => $nonceStr,
       "signature" => $signature
   ]);
   ?>
   ```