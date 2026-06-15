<?php

/**
* Name:  Google Invisible reCAPTCHA 
* 
* Author: Geordy James 
*         @geordyjames
*          
* Location: https://github.com/geordyjames/google-Invisible-reCAPTCHA
          
* Created:  13.03.2017

* Created by Geordy James to make a easy version of google Invisible reCAPTCHA PHP Library
* 
* Description:  This is an unofficial version of google Invisible reCAPTCHA PHP Library
* 
*/

class Recaptcha{
	
	public function verifyResponse($recaptcha){
		global $_captcha;
		$secret_key = $_captcha['secret-key'];
		$remoteIp = $this->getIPAddress();

		// Discard empty solution submissions
		if (empty($recaptcha)) {
			return array(
				'success' => false,
				'error-codes' => 'missing-input',
			);
		}


		$getResponse = $this->getHTTP(
			array(
				'secret' => $secret_key,
				'remoteip' => $remoteIp,
				'response' => $recaptcha,
			)
		);

		// get reCAPTCHA server response
		$responses = json_decode($getResponse, true);
        
        $score      =   0;
        $action     =   '';
        if(isset($responses['score'])){
            $score  =   $responses['score'];
        }
        if(isset($responses['action'])){
            $action  =   $responses['action'];
        }
		if (isset($responses['success']) and $responses['success'] == true) {
			$status = true;
		} else {
			$status = false;
			$error = (isset($responses['error-codes'])) ? $responses['error-codes']
				: 'invalid-input-response';
		}
        if ($score < 0.5) {
            $status = false;
        }
		return array(
			'success'        => $status,
			'action'         => $action,
			'score'          => $score,
			'error-codes'    => (isset($error)) ? $error : null,
		);
	}


	private function getIPAddress(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
		{
		$ip = $_SERVER['HTTP_CLIENT_IP'];
		} 
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
		{
		 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} 
		else 
		{
		  $ip = $_SERVER['REMOTE_ADDR'];
		}
		
		return $ip;
	}

	private function getHTTP($data){
		global $_captcha;
		$remoteIp = $this->getIPAddress();
		
		//CURL
		$ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
			CURLOPT_POST => true,
			CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_POSTFIELDS => [
                'secret' => $_captcha['secret-key'],
                'response' => $data['response'],
                'remoteip' => $remoteIp
            ],
            CURLOPT_RETURNTRANSFER => true
        ]);
        
        $output = curl_exec($ch);
        curl_close($ch);
		return $output;
		
        // 		$url = 'https://www.google.com/recaptcha/api/siteverify?'.http_build_query($data);
        // 		$response = file_get_contents($url);
        //      print_r($url);
        // 		return $response;
	}
}

