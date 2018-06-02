<?php

	
	require_once('./vendor/autoload.php');
	// Namespace
	use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
	use \LINE\LINEBot;
	use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
	$channel_token = '+wH1+7b6BQxj7F5o6PjJ8jZQAjNCCoBSPfNReVKkM1A8uzmTiYov6YFAcjmyDlMuMj2IflY0Sudc7eOQs9WTtEjR9LyKvMz7n0jh8O+RHi7W+kmOxfXAYbPZZqO9rj7mkEPL+WNvi933Iue+4SM+wAdB04t89/1O/w1cDnyilFU=';
	$channel_secret = 'ed2f82255280a198e32bee01585c2c87';
	// Get message from Line API
	$content = file_get_contents('php://input');
	$events = json_decode($content, true);
	
	if (!is_null($events['events'])) {
		// Loop through each event
		foreach ($events['events'] as $event) {
			// Line API send a lot of event type, we interested in message only.
			if ($event['type'] == 'message') {
				// Get replyToken
				$replyToken = $event['replyToken'];
				if ($event['message']['type'] == 'text') {					
					// Reply message
					$respMessage = 'Hello, your message is '. $event['message']['text'];
					$httpClient = new CurlHTTPClient($channel_token);
					$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
					$textMessageBuilder = new TextMessageBuilder($respMessage);
					$response = $bot->replyMessage($replyToken, $textMessageBuilder);
				}				
			}
		}
	}
	echo "OK";
