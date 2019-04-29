Skip to content


  
Pull requests 
Issues 
Marketplace 
Explore 




 


Watch 
0 
Star 
0 
Fork 
548 

winbot2/line-bot-exam-php 
forked from Sorajz/line-bot-exam-php 
Code 
Pull requests 0 
Projects 0 
Wiki 
Insights 
Settings 
Branch: master 
line-bot-exam-php/webhooks.php 
Find file 
Copy path 
 winbot2 Update webhooks.php 
3a0e4cf 8 days ago 
2 contributors 
 
 
54 lines (46 sloc) 1.73 KB 
Raw
Blame
History


<?php // callback.php



require "vendor/autoload.php";

require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');



$access_token ='Osna1M1GIGBTjYukdyr/f21866nrS/h6rsva98nLQnJcDodL5hCt/J2AEZUBrQzpQKHuabtRtSaQj6nJcsEV6Ws20BRoRVk4lixmpixIOY9jkZUzTS3kuS4ORC2i+YZVOrI9XNOYDBMrzdHnZiN6OwdB04t89/1O/w1cDnyilFU=';



// Get POST body content

$content = file_get_contents('php://input');

// Parse JSON

$events = json_decode($content, true);

// Validate parsed JSON data

if (!is_null($events['events'])) {

	// Loop through each event

	foreach ($events['events'] as $event) {

		// Reply only when message sent is in 'text' format

		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {

			// Get text sent

			$text = $event['source']['userId'];

			// Get replyToken

			$replyToken = $event['replyToken'];



			// Build message to reply back

			$messages = [

				'type' => 'text',

				'text' => $text

			];



			// Make a POST Request to Messaging API to reply to sender

			$url = 'https://api.line.me/v2/bot/message/reply';

			$data = [

				'replyToken' => $replyToken,

				'messages' => [$messages],

			];

			$post = json_encode($data);

			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);



			$ch = curl_init($url);

			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

			$result = curl_exec($ch);

			curl_close($ch);



			echo $result . "\r\n";

		}

	}

}

echo "OK";



© 2019 GitHub, Inc.
Terms
Privacy
Security
Status
Help

Contact GitHub
Pricing
API
Training
Blog
About

