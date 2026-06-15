<?php
include '../config.php';
header('Content-Type: application/json; charset=UTF-8');
//print_r($_POST);die;


// your secret key
$secret = $_captcha['secret-key'];

// check secret key
$captcha_passed = 'true';
if (isset($_POST["order_recaptcha"]) && (($_POST["order_recaptcha"]) != '')) {
	$object     = new Recaptcha();
	$captcha_response   = $object->verifyResponse($_POST["order_recaptcha"]);
	if (isset($captcha_response['success']) && $captcha_response['success'] != true) {
		$captcha_passed = 'false';
	} else {
		$captcha_passed = 'true';
	}
}
$captcha_passed = 'true';
if ($captcha_passed == 'false') {
	$response_array['status'] = 'error';
	$response_array['message'] = 'recaptcha error';
} else {
	// print_r($_POST['product_id']);die;
	if (isset($_POST["form_type"])) {
		$form_type	=	$mysqli->real_escape_string(strip_tags($_POST['form_type']));
	} else {
		$form_type	=	'contact';
	}
	if (isset($_POST["product_id"])) {
		$product_id	=	$mysqli->real_escape_string(strip_tags($_POST['product_id']));
		$product_id = intval($product_id);
	} else {
		$product_id	=	0;
	}
	if (isset($_POST["order_service"])) {
		$order_service	=	$mysqli->real_escape_string(strip_tags($_POST['order_service']));
		$order_service = intval($order_service);
	} else {
		$order_service	=	0;
	}
	if (isset($_POST["order_brand"])) {
		$order_brand	=	$mysqli->real_escape_string(strip_tags($_POST['order_brand']));
	} else {
		$order_brand	=	'';
	}
	if (isset($_POST["order_truckname"])) {
		$order_truckname	=	$mysqli->real_escape_string(strip_tags($_POST['order_truckname']));
	} else {
		$order_truckname	=	'';
	}
	if (isset($_POST["order_email"])) {
		$order_email	=	$mysqli->real_escape_string(strip_tags($_POST['order_email']));
	} else {
		$order_email	=	'';
	}
	if (isset($_POST["order_name"])) {
		$order_name	=	$mysqli->real_escape_string(strip_tags($_POST['order_name']));
	} else {
		$order_name	=	'';
	}
	if (isset($_POST["order_phone"])) {
		$order_phone	=	$mysqli->real_escape_string(strip_tags($_POST['order_phone']));
	} else {
		$order_phone	=	'';
	}
	if (isset($_POST["order_subject"])) {
		$order_subject	=	$mysqli->real_escape_string(strip_tags($_POST['order_subject']));
	} else {
		$order_subject	=	'';
	}
	if (isset($_POST["order_msg"])) {
		$order_msg	=	$mysqli->real_escape_string(strip_tags($_POST['order_msg']));
	} else {
		$order_msg	=	'';
	}
	$email_pass = false;
	if (!filter_var($order_email, FILTER_VALIDATE_EMAIL) === false) {
		$email_pass = true;
	} else {
		$email_pass = false;
	}
	if ($form_type == 'order') $email_pass = true;
	if (strlen($_POST["order_phone"]) >= 7) {
		if (!empty($order_msg) && !empty($order_name) && !empty($order_phone)) {
			if ($email_pass) {
				$today_datetime	=	date("Y-m-d H:i:s");
				$str_form_order = "INSERT INTO `form_contact` (
								`product_id`,
								`service_id`,
								`brand`,
								`truck_name`,
								`email`,
								`name`,
								`phone`,
								`subject`,
								`massage`,	
								`ip`,
								`datetime`
								) VALUES (
								'" . $product_id . "',
								'" . $order_service . "',
								'" . $order_brand . "',
								'" . $order_truckname . "',
								'" . $order_email . "',
								'" . $order_name . "',
								'" . $order_phone . "',
								'" . $order_subject . "',
								'" . $order_msg . "',
								'" . $_SERVER['REMOTE_ADDR'] . "',
								'" . $today_datetime . "'
								)";
				// echo $str_form_order;die;
				if ($mysqli->query($str_form_order)) {
					$insert_id = $mysqli->insert_id;
					$response_array['status'] = 'success';
					$response_array['message'] = 'پیام شما با موفقیت ارسال شد';
					_send_contact_email($insert_id);
				} else {
					$response_array['status'] = 'error';
					$response_array['message'] = 'ایمیل شما ثبت نشده است، لطفا دوباره امتحان کنید';
				}
			} else {
				$response_array['status'] = 'error';
				$response_array['message'] = 'آدرس ایمیل نامعتبر است';
			}
		} else {
			$response_array['status'] = 'error';
			$response_array['message'] = 'پر کردن فیلد ها الزامی است';
		}
	} else {
		$response_array['status'] = 'error';
		$response_array['message'] = 'شماره تلفن نامعتبر';
	}
}
echo json_encode($response_array);
mysqli_close($mysqli);
