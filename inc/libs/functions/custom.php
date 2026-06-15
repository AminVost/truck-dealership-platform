<?php
/* ====================================================================================================================
                                                Global Functions
==================================================================================================================== */
function _is_login()
{
    global $mysqli;
    if (isset($_SESSION['user']['id'])) {
        return true;
    } else {
        return false;
    }
}
function _function_get_array($table, $col, $input, $output)
{
    global $mysqli;
    $array  = [];
    $table  = _strip_tags($table);
    $col    = _strip_tags($col);
    $input  = _strip_tags($input);
    $output = _strip_tags($output);

    $sql    = "SELECT $output FROM $table WHERE  $col = '$input' ";
    $result = $mysqli->query($sql);
    while ($row = $result->fetch_assoc()) {
        $array[] = $row;
    }
    return $array;
}
function _menu_tree($position)
{
    $items = [];
    if ($position) {
        global $mysqli;
        global $_defines;
        global $_modules;


        $query = $mysqli->query("SELECT `id`,`parent_id`,`page_id`,`module_id`,`service_id`,`brand_id` , `url`,`title` FROM `menues` WHERE `position` = '$position' AND `status` = 'T' ORDER BY `ordering` ");
        
        $ref   = [];
        while ($data = $query->fetch_assoc()) {
            // print_r($data);
            $item_link  = _menu($data['page_id'] , $data['module_id'] , $data['service_id'] , $data['brand_id'] ,  $data['url']);
            $thisRef    = &$ref[$data['id']];
            $thisRef['id']          = $data['id'];
            $thisRef['parent_id']   = $data['parent_id'];
            $thisRef['title']       = $data['title'];
            $thisRef['link']        = $item_link;
            if ($data['parent_id'] == 0) {
                $items[] = &$thisRef;
            } else {
                $ref[$data['parent_id']]['childs'][] = &$thisRef;
            }
        }
    }
    return $items;
}
function _update_hit($table, $primary_key)
{
    if (!isset($_COOKIE["$table" . $primary_key])) {
        global $mysqli;
        $sql_update     =   "UPDATE `$table` SET `hits` = `hits` + 1 WHERE `id` = $primary_key ";
        $mysqli->query($sql_update);
        setcookie("$table" . $primary_key,  true, time() + 3600 * 24 * 30 * 12);
    }
}
function _menu($page_id , $module_id , $service_id , $brand_id ,  $url)
{
    global $mysqli;
    global $_defines;
    global $_modules;

    $menu = array();
    $menu_target = '';
    if (isset($page_id) && $page_id != 0) {
        $menu_link = $_defines['domain'] . "/page/" . _function_get('pages', 'id', $page_id, 'alias');
    } else if (isset($module_id) && $module_id != 0) {
        if ($module_id == $_modules['home']['id']) {
            $menu_link = $_defines['domain'];
        } else {
            $menu_link = $_defines['domain'] . "/" . _function_get('modules', 'id', $module_id, 'alias');
        }
    } else if (isset($service_id) && $service_id != 0) {
        $menu_link = $_defines['domain'] . "/service/" . _function_get('services', 'id', $service_id, 'alias');
    } else if (isset($brand_id) && $brand_id != 0) {
        $menu_link = $_defines['domain'] . "/brands/" . _function_get('brands', 'id', $brand_id, 'alias');
    } else if (isset($url)) {
        $menu_link = $url;
        $menu_target = 'target="_blank"';
        $menu_target .= ' rel="nofollow" ';
    } else {
        $menu_link = 'javascript:void(0)';
        $menu_target = ' href-no-link ';
    }
    $menu['link'] = $menu_link;
    $menu['target'] = $menu_target;
    return $menu;
}
function _to_persian($string)
{
    $english = range(0, 9);
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $convertedPersianNums = str_replace($english, $persian, $string);
    return $convertedPersianNums;
}
function _print($array, $die = false)
{
    print("<pre>" . print_r($array, true) . "</pre>");
    $die ? die : null;
}
function _alerts($data)
{
    if (isset($_SESSION['alerts'])) {
        array_push($_SESSION['alerts'], $data);
    } else {
        $_SESSION['alerts'] = array($data);
    }
}
function _translate($key)
{
    global  $mysqli;
    $key    =   strtoupper($key);
    if (isset($_SESSION['translations']->$key)) {
        return $_SESSION['translations']->$key;
    } else {
        $key = strtolower($key);
        if ($key) {
            $value = _alias_reverse($key);
        }
        if (!isset($_SESSION['no_translate'])) $_SESSION['no_translate'] = [];
        $_SESSION['no_translate'][$key] = $value;
        return $value;
    }
}
function _user($col)
{
    global $mysqli;
    global $date;
    if (isset($_SESSION['user']['id'])) {
        $user_id    = $_SESSION['user']['id'];
        $query      = "SELECT $col FROM `customers` WHERE `id` = $user_id  AND `status`='T' ";
        $row        = mysqli_fetch_assoc(mysqli_query($mysqli, $query));
        if ($col == '*') {
            $result =   [];
            foreach ($row as $key => $value) {
                if ($key != 'password' && $key != 'datetime' && $key != 'reset_code' && $key != 'id' && $key != 'status') {
                    $result['data'][$key] = $value;
                }
            }
        } else {
            $result     = $row[$col];
        }
        return $result;
    } else {
        return null;
    }
}
function base64_to_png($base64_string, $output_file)
{
    $ifp = fopen($output_file, 'wb');
    $data = explode(',', $base64_string);
    fwrite($ifp, base64_decode($data[1]));
    fclose($ifp);
    return $output_file;
}
function _validate_iran_mobile($input)
{
    if (preg_match("/^(?:(?:(?:\\+?|00)(98))|(0))?((?:90|91|92|93|99)[0-9]{8})$/", $input)) {
        return true;
    } else {
        return false;
    }
}
function _validate_email($input)
{
    if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
function _send_sms($parameters)
{
    global $_sms;
    $APIKey     = $_sms['api-key'];
    $SecretKey  = $_sms['secret-key'];
    switch ($parameters['sms_type']) {
        case 'activation_code':
            $template_id = '43052';
            break;
        case 'order_submited':
            $template_id = '43053';
            break;
        default:
            $template_id = '43052';
    }
    if ($template_id) {

        try {
            // message data
            if ($parameters['sms_type'] == 'activation_code') {
                $data = array(
                    "ParameterArray" => array(
                        array(
                            "Parameter" => "activation_code",
                            "ParameterValue" => $parameters['activation_code']
                        )
                    ),
                    "Mobile" => $parameters['user_mobile'],
                    "TemplateId" => $template_id
                );
            }
            if ($parameters['sms_type'] == 'order_submited') {
                $data = array(
                    "ParameterArray" => array(
                        array(
                            "Parameter" => "order_code",
                            "ParameterValue" => $parameters['order_code']
                        ),
                        array(
                            "Parameter" => "order_link",
                            "ParameterValue" => $parameters['order_link']
                        )
                    ),
                    "Mobile" => $parameters['user_mobile'],
                    "TemplateId" => $template_id
                );
            }
            $SmsIR_UltraFastSend    = new SmsIR_UltraFastSend($APIKey, $SecretKey);
            $UltraFastSend          = $SmsIR_UltraFastSend->UltraFastSend($data);
            // var_dump($UltraFastSend);
            // die;
            if ($UltraFastSend == 'your verification code is sent')
                return true;
            else
                return true;
            //return $UltraFastSend;
            return true;
        } catch (Exeption $e) {
            return false;
            //echo 'Error UltraFastSend : '.$e->getMessage();
        }
    } else {
        return false;
    }
}
function _api_get($_url)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        //CURLOPT_PORT => "443",
        CURLOPT_URL => $_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_SSL_VERIFYPEER => FALSE,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Cache-Control: no-cache"
        )
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $response_array = json_decode($response, true);
    return $response_array;
}
/* ====================================================================================================================
                                                Email Functions
==================================================================================================================== */
function _email_template_design($body)
{
    global $_defines;
    if (file_exists(ROOT . '/inc/libs/email_templates/general.php')) {
        $url = $_defines['domain'] . '/inc/libs/email_templates/general.php';
        $postdata = http_build_query(
            array(
                'data' => $body
            )
        );
        $header = array(
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: " . strlen($postdata)
        );
        $options = array(
            'http' => array(
                'method' => 'POST',
                'content' => $postdata,
                'header' => implode("\r\n", $header)
            )

        );
        $email_body =  file_get_contents($url, false, stream_context_create($options));
    } else {
        $email_body             =   $body;
    }
    return $email_body;
}
function _email_template($type, $action)
{
    global $mysqli;
    $sql    = "SELECT * FROM `email_templates` WHERE type = '$type' AND  action = '$action' ";
    $result = $mysqli->query($sql);
    $row    = mysqli_fetch_assoc($result);
    if (!$row) return "";
    return $row;
}
function _send_email($type, $action, $to, $fields)
{
    global $_config;
    global $_defines;
    $my_domain = $_defines['domain'];
    $email_template   =   _email_template($type, $action);
    if ($email_template) {
        $my_smtp_host       = $_config['smtp_host'];
        $my_smtp_username   = $_config['smtp_username'];
        $my_smtp_password   = $_config['smtp_password'];
        $my_smtp_type       = $_config['smtp_type'];
        $my_smtp_port       = $_config['smtp_port'];
        $my_smtp_from_email = $_config['smtp_from_email'];
        $my_smtp_from_name  = $_config['smtp_from_name'];
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        // $mail->SMTPDebug = 3;											// Enable verbose debug output
        $mail->isSMTP();
        $mail->CharSet         = 'UTF-8';                                    // Set mailer to use SMTP
        $mail->Host         = $my_smtp_host;                              // Specify main and backup SMTP servers
        $mail->SMTPAuth     = true;                                       // Enable SMTP authentication
        $mail->Username     = $my_smtp_username;                        // SMTP username
        $mail->Password     = $my_smtp_password;                        // SMTP password
        $mail->SMTPSecure     = $my_smtp_type;                               // Enable TLS encryption, `ssl` also accepted
        $mail->Port         = $my_smtp_port;                            // TCP port to connect to
        $mail->From         = $my_smtp_from_email;
        $mail->FromName     = $my_smtp_from_name;
        $addresses = explode(',', $to);
        foreach ($addresses as $address) {
            $mail->addAddress($address, '');
        }
        $mail->addReplyTo($my_smtp_from_email, $my_smtp_from_name);
        //$mail->addAttachment('/var/tmp/file.tar.gz');         		// Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');   			// Optional name
        $mail->isHTML(true);   // Set email format to HTML
        $email_body             =   $email_template['body'];
        $email_body             =   str_replace('{{domain}}', $my_domain, $email_body);
        $email_body_replaced    =   new EmailParser($fields, $email_body, false);
        $mail->Subject          =   $email_template['subject'];
        $mail->Body             =   _email_template_design($email_body_replaced->output());
        $mail->AltBody          =   $email_body_replaced->output();
        if ($mail->send()) {
            return 'mail-ok';
        } else {
            return 'mail-error';
        }
    } else {
        return;
    }
}
/* ====================================================================================================================
                                                Forms Functions
==================================================================================================================== */
function _form_contact($data)
{
    global $mysqli;
    $contact_datetime   = date("Y-m-d H:i:s");
    $contact_status     = 'new';
    $contact_ip         = _ip();
    $contact_first_name = _strip_tags($data['first_name']);
    $contact_last_name  = _strip_tags($data['last_name']);
    $contact_mobile     = _strip_tags($data['mobile']);
    $contact_email      = _strip_tags($data['email']);
    $contact_subject    = _strip_tags($data['subject']);
    $contact_message    = _strip_tags($data['message']);

    $sql_insert = "INSERT INTO `form_contact` (
                    `first_name`,
                    `last_name`,
                    `mobile`,
                    `email`,
                    `subject`,
                    `message`,
                    `datetime`,
                    `ip`,
                    `status`
                ) VALUES (
                    '" . $contact_first_name . "',
                    '" . $contact_last_name . "',
                    '" . $contact_mobile . "',
                    '" . $contact_email . "',
                    '" . $contact_subject . "',
                    '" . $contact_message . "',
                    '" . $contact_datetime . "',
                    '" . $contact_ip . "',
                    '" . $contact_status . "'
                )";

    if ($mysqli->query($sql_insert)) {
        $contact_id = $mysqli->insert_id;
        // _send_contact_email($contact_id);
        $response_array['status'] = 'success';
        $response_array['message'] = _translate("contact_form_submit_success");
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = _translate("contact_form_submit_error");
    }
    return json_encode($response_array);
}
function _send_contact_email($contact_id)
{
    global $mysqli;
    global $_config;
    global $_date;
    $sql_contact           = "SELECT * FROM `form_contact` WHERE `id` = '$contact_id' ";
    $result_contact        = $mysqli->query($sql_contact);
    $contact               = $result_contact->fetch_assoc();
    $contact['datetime']   = date('Y/m/d H:i:s', strtotime($contact['datetime']));
    $email_to_customer     = $contact['email'];
    _send_email('user', 'contact', $email_to_customer, $contact);
    _send_email('admin', 'contact', $_config['smtp_to_email'], $contact);
}
function _send_order_email($order_id)
{
    global $mysqli;
    global $_config;
    global $_date;
    $sql_order           = "SELECT * FROM `form_order` WHERE `id` = '$order_id' ";
    $result_order        = $mysqli->query($sql_order);
    $order               = $result_order->fetch_assoc();
    $order['datetime']   = date('Y/m/d H:i:s', strtotime($order['datetime']));
    $email_to_customer     = $order['email'];
    _send_email('user', 'order', $email_to_customer, $order);
    _send_email('admin', 'order', $_config['smtp_to_email'], $order);
}
function _send_register_email($register_id)
{
    global $mysqli;
    global $_config;
    global $_date;
    $sql_register           = "SELECT * FROM `form_register` WHERE `id` = '$register_id' ";
    $result_register        = $mysqli->query($sql_register);
    $register               = $result_register->fetch_assoc();
    $register['datetime']   = date('Y/m/d H:i:s', strtotime($register['datetime']));
    $email_to_customer     = $register['customer_email'];
    _send_email('user', 'register', $email_to_customer, $register);
    _send_email('admin', 'register', $_config['smtp_to_email'], $register);
}
function _form_subscribe($data)
{
    global $mysqli;
    $subscribe_datetime = date("Y-m-d H:i:s");
    $subscribe_ip       = _ip();
    $subscribe_status   = 'new';
    $subscribe_email    = _strip_tags($data['email']);
    $sql_check          = "SELECT * FROM `subscribes` WHERE `email` = '$subscribe_email'";
    $result_check       = $mysqli->query($sql_check);
    $total_check        = $result_check->num_rows;
    if ($total_check == 1) {
        $response_array['status']   = 'error';
        $response_array['message']  = _translate("subscribe_form_email_duplicate_error");
    } else {
        $sql_insert = "INSERT INTO `form_subscribes` (
                            `email`,
                            `datetime`,
                            `ip`,
                            `status`
                        ) VALUES (
                            '" . $subscribe_email . "',
                            '" . $subscribe_datetime . "',
                            '" . $subscribe_ip . "',
                            '" . $subscribe_status . "'
                        )";
        if ($mysqli->query($sql_insert)) {
            $subscribe_id = $mysqli->insert_id;
            _send_subscribe_email($subscribe_id);
            $response_array['status']   = 'success';
            $response_array['message']  = _translate("subscribe_form_submit_success");
        } else {
            $response_array['status']   = 'error';
            $response_array['message']  = _translate("subscribe_form_submit_error");
        }
    }
    return json_encode($response_array);
}
function _send_subscribe_email($subscribe_id)
{
    global $mysqli;
    global $_config;
    $sql_subscribe     = "SELECT * FROM `form_subscribes` WHERE `id` = '$subscribe_id' ";
    $result_subscribe  = $mysqli->query($sql_subscribe);
    $item              = $result_subscribe->fetch_assoc();
    $item['datetime']  = date('Y/m/d - H:i:s', strtotime($item['datetime']));
    $email_to_customer = $item['email'];
    _send_email('user', 'subscribe', $email_to_customer, $item);
    _send_email('admin', 'subscribe', $_config['smtp_to_email'], $item);
}
/* ====================================================================================================================
                                                Authentication Functions
==================================================================================================================== */
// function _auth_login($data)
// {
//     global $mysqli;
//     $request_username   = _strip_tags($data['username']);
//     $request_password   = _strip_tags($data['password']);
//     $request_remember   = !empty($data['remember']) && isset($data['remember']) ? 'T' : 'F';
//     $request_password   = md5(stripslashes($request_password));
//     $request_email      = '';
//     $request_mobile     = '';
//     if (_validate_email($request_username)) {
//         $request_email = $request_username;
//     }
//     if (_validate_iran_mobile($request_username)) {
//         $request_mobile = $request_username;
//     }
//     $sql_check_duplicate        = "SELECT * FROM `customers` WHERE (`email` = '$request_email' OR `mobile` = '$request_mobile') AND `password` = '" . $request_password . "' ";
//     $result_check_duplicate     = $mysqli->query($sql_check_duplicate);
//     $check_duplicate            = $result_check_duplicate->fetch_assoc();
//     $row_exist                  = $result_check_duplicate->num_rows;
//     if ($row_exist > 0) {
//         $response_array['status']   = 'success';
//         $response_array['message']  = _translate("auth_login_form_submit_success");
//         $_SESSION['user']                   = [];
//         $_SESSION['user']['id']             = $check_duplicate['id'];
//         $_SESSION['user']['first_name']     = $check_duplicate['first_name'];
//         $_SESSION['user']['last_name']      = $check_duplicate['last_name'];
//         $_SESSION['user']['email']          = $check_duplicate['email'];
//         $_SESSION['user']['mobile']         = $check_duplicate['mobile'];
//         if ($request_remember == 'T') {
//             setcookie('user_id', _user('id'), time() + (86400 * 30));
//         }
//     } else {
//         $response_array['status']  = 'error';
//         $response_array['message'] = _translate("auth_login_form_user_not_found_error");
//     }
//     return json_encode($response_array);
// }
// function _auth_auto_login($user_id)
// {
//     global $mysqli;
//     $sql_check_duplicate        = "SELECT * FROM `customers` WHERE `id` = '$user_id' AND `status` = 'T'";
//     $result_check_duplicate     = $mysqli->query($sql_check_duplicate);
//     $check_duplicate            = $result_check_duplicate->fetch_assoc();
//     $row_exist                  = $result_check_duplicate->num_rows;
//     if ($row_exist > 0) {
//         $_SESSION['user']                   = [];
//         $_SESSION['user']['id']             = $check_duplicate['id'];
//         $_SESSION['user']['first_name']     = $check_duplicate['first_name'];
//         $_SESSION['user']['last_name']      = $check_duplicate['last_name'];
//         $_SESSION['user']['mobile']         = $check_duplicate['mobile'];
//         $_SESSION['user']['email']          = $check_duplicate['email'];
//     }
// }
// function _auth_register($data)
// {
//     global $mysqli;
//     $request_first_name         = _strip_tags($data['first_name']);
//     $request_last_name          = _strip_tags($data['last_name']);
//     $request_mobile             = _strip_tags($data['mobile']);
//     $request_email              = _strip_tags($data['email']);
//     $request_password           = _strip_tags($data['password']);
//     $request_password           = md5(stripslashes($request_password));
//     $register_date              = date("Y-m-d H:i:s");
//     $email_statement_check      = '';
//     $mobile_statement_check     = '';
//     if (!empty($request_email)) {
//         $email_statement_check  = " `email` = '" . $request_email . "' ";
//     }
//     if (!empty($request_mobile)) {
//         $mobile_statement_check  = "OR `mobile` = '" . $request_mobile . "' ";
//     }
//     $sql_check_duplicate        = "SELECT * FROM `customers` WHERE $email_statement_check $mobile_statement_check";
//     $result_check_duplicate     = $mysqli->query($sql_check_duplicate);
//     $check_duplicate            = $result_check_duplicate->fetch_assoc();
//     $user_exist                = $result_check_duplicate->num_rows;
//     if ($user_exist > 0) {
//         $response_array['status']  = 'error';
//         $response_array['message'] = _translate("auth_register_form_user_exist_error");
//     } else {
//         $sql_register = "INSERT INTO `customers` (
//                         `first_name`,
//                         `last_name`,
//                         `mobile`,
//                         `email`,
//                         `password`,
//                         `datetime`,
//                         `status`
//                           ) VALUES (
//                         '" . $request_first_name . "',
//                         '" . $request_last_name . "',
//                         '" . $request_mobile . "',
//                         '" . $request_email . "',
//                         '" . $request_password . "',
//                         '" . $register_date . "',
//                         'T'
//                       )";
//         if ($mysqli->query($sql_register)) {
//             $user_id = $mysqli->insert_id;
//             $_SESSION['user']                   = [];
//             $_SESSION['user']['id']             = $user_id;
//             $_SESSION['user']['first_name']     = $request_first_name;
//             $_SESSION['user']['last_name']      = $request_last_name;
//             $_SESSION['user']['mobile']         = $request_mobile;
//             $_SESSION['user']['email']          = $request_email;
//             $response_array['status'] = 'success';
//             $response_array['message'] = _translate("auth_register_form_submit_success");
//             if (!empty($request_email)) {
//                 _send_register_email($user_id);
//             }
//         } else {
//             $response_array['status'] = 'error';
//             $response_array['message'] = _translate("auth_register_form_submit_error");
//         }
//     }
//     return json_encode($response_array);
// }
// function _send_register_email($user_id)
// {
//     global $mysqli;
//     global $_config;
//     global $_date;
//     $sql_customer      = "SELECT * FROM `customers` WHERE `id` = '$user_id' ";
//     $result_customer   = $mysqli->query($sql_customer);
//     $item              = $result_customer->fetch_assoc();
//     $item['datetime']  = $_date->date('Y/m/d - H:i:s', strtotime($item['datetime']));
//     $email_to_customer = $item['email'];
//     _send_email('user', 'register', $email_to_customer, $item);
//     _send_email('admin', 'register', $_config['smtp_to_email'], $item);
// }
// function _auth_forgot($data)
// {
//     global $mysqli;
//     $request_username = _strip_tags($data['username']);
//     $request_username = stripslashes($request_username);
//     $request_email      = '';
//     $request_mobile     = '';
//     if (_validate_email($request_username)) {
//         $request_email = $request_username;
//     }
//     if (_validate_iran_mobile($request_username)) {
//         $request_mobile = $request_username;
//     }
//     $sql_check     = "SELECT * FROM `customers` WHERE (`email` = '$request_email' OR `mobile` = '$request_mobile') AND `status` = 'T' ";
//     $result_check  = $mysqli->query($sql_check);
//     $row_forgot    = $result_check->fetch_assoc();
//     $total_exist   = $result_check->num_rows;
//     if ($total_exist == 1) {
//         $reset_code   = _random(6);
//         $user_id      = $row_forgot['id'];
//         $sql_update   = "UPDATE `customers` SET `reset_code` = '" . $reset_code . "' WHERE `id` = $user_id ";
//         if ($mysqli->query($sql_update)) {
//             $response_array['status'] = 'success';
//             $response_array['message'] = _translate("auth_forgot_form_send_code_success");
//             if ($request_email) {
//                 _send_forgot_email($user_id);
//             }
//             // if ($request_mobile) {
//             //     _send_forgot_sms($user_id);
//             // }
//         } else {
//             $response_array['status'] = 'error';
//             $response_array['message'] = _translate("auth_forgot_form_send_code_error");
//         }
//     } else {
//         $response_array['status'] = 'error';
//         $response_array['message'] = _translate("auth_forgot_form_user_not_found_error");
//     }
//     return json_encode($response_array);
// }
// function _auth_forgot_verify($data)
// {
//     global $mysqli;
//     $request_username       = _strip_tags($data['username']);
//     $request_code           = _strip_tags($data['code']);
//     $request_email      = '';
//     $request_mobile     = '';
//     if (_validate_email($request_username)) {
//         $request_email = $request_username;
//     }
//     if (_validate_iran_mobile($request_username)) {
//         $request_mobile = $request_username;
//     }
//     $sql_check      = "SELECT * FROM `customers` WHERE (`email` = '$request_email' OR `mobile` = '$request_mobile') AND `reset_code` = '$request_code' ";
//     $result_check   = $mysqli->query($sql_check);
//     $row_check      = $result_check->fetch_assoc();
//     if ($row_check) {
//         $sql_update   = "UPDATE `customers` SET `reset_code` = NULL WHERE (`email` = '$request_email' OR `mobile` = '$request_mobile') ";
//         if ($mysqli->query($sql_update)) {
//             $response_array['status']   = 'success';
//             $response_array['message']  = _translate("auth_forgot_form_code_verify_success");
//             $_SESSION['temp_user_id']   = $row_check['id'];
//         } else {
//             $response_array['status']   = 'error';
//             $response_array['message']  = _translate("auth_forgot_form_code_invalid_error");
//         }
//     } else {
//         $response_array['status']   = 'error';
//         $response_array['message']  = _translate("auth_forgot_form_code_invalid_error");
//     }
//     return json_encode($response_array);
// }
// function _auth_forgot_password($data)
// {
//     global $mysqli;
//     $user_id            = isset($_SESSION['temp_user_id']) ? $_SESSION['temp_user_id'] : null;
//     $request_password   = _strip_tags($data['password']);
//     $request_password   = md5(stripslashes($request_password));
//     $sql_update = "UPDATE `customers` SET `password` = '$request_password' WHERE `id` = '$user_id' ";
//     if ($mysqli->query($sql_update)) {
//         $response_array['status']   = 'success';
//         $response_array['message']  = _translate("auth_forgot_form_password_change_success");
//         $user_info = _function_get('customers', 'id', $user_id, '*');
//         unset($_SESSION['temp_user_id']);
//         $_SESSION['user']                   = [];
//         $_SESSION['user']['id']             = $user_info['id'];
//         $_SESSION['user']['first_name']     = $user_info['first_name'];
//         $_SESSION['user']['last_name']      = $user_info['last_name'];
//         $_SESSION['user']['mobile']         = $user_info['mobile'];
//         $_SESSION['user']['email']          = $user_info['email'];
//     } else {
//         $response_array['status']   = 'error';
//         $response_array['message']  = _translate("auth_forgot_form_password_change_error");
//     }
//     return json_encode($response_array);
// }
// function _send_forgot_email($user_id)
// {
//     global $mysqli;
//     global $_config;
//     global $_date;
//     $sql_forgot        = "SELECT * FROM `customers` WHERE `id` = '$user_id' ";
//     $result_forgot     = $mysqli->query($sql_forgot);
//     $item              = $result_forgot->fetch_assoc();
//     $item['datetime']  = $_date->date('Y/m/d - H:i:s', strtotime($item['datetime']));
//     $email_to_customer = $item['email'];
//     _send_email('user', 'forgot', $email_to_customer, $item);
//     _send_email('admin', 'forgot', $_config['smtp_to_email'], $item);
// }
// function _send_forgot_sms($item_id)
// {
//     global $mysqli;
//     $sql_contact    = "SELECT * FROM `customers` WHERE `id` = '$item_id' ";
//     $result_contact = $mysqli->query($sql_contact);
//     $item           = $result_contact->fetch_assoc();
//     $parameters['sms_type']    = 'reset_code';
//     $parameters['user_mobile'] = $item['mobile'];
//     $parameters['reset_code']  = $item['mobile_hash'];
//     _send_sms($parameters);
// }
/* ====================================================================================================================
                                                Profile Functions
==================================================================================================================== */
function _profile_edit($data)
{
    global $mysqli;
    $user_id = _user('id');
    $request_first_name     = _strip_tags($data['first_name']);
    $request_last_name      = _strip_tags($data['last_name']);
    $request_mobile         = _strip_tags($data['mobile']);
    $request_email          = _strip_tags($data['email']);
    $sql_check_duplicate    = "SELECT * FROM `customers` WHERE (`mobile` = '$request_mobile' OR `email` = '$request_email') AND `id` <> '$user_id'";
    $result_check_duplicate = $mysqli->query($sql_check_duplicate);
    $total_check_duplicate  = $result_check_duplicate->num_rows;
    if ($total_check_duplicate > 0) {
        $response_array['status']  = 'error';
        $response_array['message'] = _translate("profile_edit_form_duplicate_error");
    } else {
        $sql_update = "UPDATE `customers` SET 
                      `first_name` = '" . $request_first_name . "',
                      `last_name`  = '" . $request_last_name . "',
                      `mobile`     = '" . $request_mobile . "',
                      `email`      = '" . $request_email . "'
                      WHERE `id`   = $user_id ";
        if ($mysqli->query($sql_update)) {
            $response_array['status']  = 'success';
            $response_array['message'] = _translate("profile_edit_form_submit_success");
            $_SESSION['user']                   = [];
            $_SESSION['user']['id']             = $user_id;
            $_SESSION['user']['first_name']     = $request_first_name;
            $_SESSION['user']['last_name']      = $request_last_name;
            $_SESSION['user']['name']           = $request_first_name . ' ' . $request_last_name;
            $_SESSION['user']['email']          = $request_email;
            $_SESSION['user']['mobile']         = $request_mobile;
        } else {
            $response_array['status']  = 'error';
            $response_array['message'] = _translate("profile_edit_form_submit_error");
        }
    }
    return json_encode($response_array);
}
function _profile_password($data)
{
    global $mysqli;
    $user_id        = _user('id');
    $password_old   = md5(_strip_tags($data['old']));
    $password_new   = md5(_strip_tags($data['new']));
    $sql_check      = "SELECT * FROM `customers` WHERE `id` = '$user_id' ";
    $result_check   = $mysqli->query($sql_check);
    $row_check      = $result_check->fetch_assoc();
    if ($row_check['password'] == $password_old) {
        $sql_update = "UPDATE `customers` SET `password` = '" . $password_new . "' WHERE `id` = $user_id ";
        if ($mysqli->query($sql_update)) {
            $response_array['status']   = 'success';
            $response_array['message']  = _translate("profile_password_form_submit_success");
        } else {
            $response_array['status']   = 'error';
            $response_array['message']  = _translate("profile_password_form_submit_error");
        }
    } else {
        $response_array['status']   = 'error';
        $response_array['message']  = _translate("profile_password_form_old_password_error");
    }
    return json_encode($response_array);
}
