<?php
function _db_connect($host, $user, $pass, $db)
{
    $mysqli = new mysqli($host, $user, $pass, $db);
    if ($mysqli->connect_error)
        die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());

    return $mysqli;
}
function _alias($str, $options = array())
{
    // Make sure string is in UTF-8 and strip invalid UTF-8 characters
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => false,
    );
    // Merge options
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );

    // Make custom replacements
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

    // Transliterate characters to ASCII
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }

    // Replace non-alphanumeric characters with our delimiter
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

    // Remove duplicate delimiters
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

    // Truncate slug to max. characters
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

    // Remove delimiter from ends
    $str = trim($str, $options['delimiter']);

    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}
function url_origin($s, $use_forwarded_host = false)
{
    $ssl      = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
    $sp       = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port     = $s['SERVER_PORT'];
    $port     = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
    $host     = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host     = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}
function _sort_array_title($a, $b)
{
    return strcmp($a["title"], $b["title"]);
}
function _strip_tags($string)
{
    global $mysqli;
    return $mysqli->real_escape_string(strip_tags($string));
}
function _full_url($s, $use_forwarded_host = false)
{
    global $_defines;
    /*$is_home    =   false;
    if(isset($_GET)){
        if(isset($_GET['_dev'])){
            $is_home    =   true;
        }
    } else {
        $is_home    =   true;
    }
    if($is_home){
        $str =  $_defines['domain'];
    } else {
        $str =  url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
    }*/

    $str         =  url_origin($s, $use_forwarded_host) . $s['REQUEST_URI'];
    $has_param_1 =   strpos($str, '?');
    $has_param_2 =   strpos($str, '&');
    if ($has_param_1 || $has_param_2) {
        $str    =   $_defines['domain'];
    }
    //print_r($has_params);die;
    $str  =   rtrim($str, '/');
    return $str;
}
function _farsi($string)
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

    $num = range(0, 9);
    $convertedPersianNums = str_replace($num, $persian, $string);

    return $convertedPersianNums;
}
function _mellat_errors($error_code)
{
    switch ($error_code) {
        case "0":
            return "تراکنش با موفقیت انجام شد";
            break;
        case "11":
            return "شماره کارت نامعتبر است";
            break;
        case "12":
            return "موجودی کافی نیست";
            break;
        case "13":
            return "رمز نادرست است";
            break;
        case "14":
            return "تعداد دفعات وارد کردن رمز بیش از حد مجاز است";
            break;
        case "15":
            return "کارت نامعتبر است";
            break;
        case "16":
            return "دفعات برداشت وجه بیش از حد مجاز است";
            break;
        case "17":
            return "کاربر از انجام تراکنش منصرف شده است";
            break;
        case "18":
            return "تاریخ انقضای کارت گذشته است";
            break;
        case "19":
            return "مبلغ برداشت وجه بیش از حد مجاز است";
            break;
        case "21":
            return "پذیرنده نامعتبر است";
            break;
        case "23":
            return "خطای امنیتی رخ داده است";
            break;
        case "24":
            return "اطلاعات کاربری پذیرنده نامعتبر است";
            break;
        case "25":
            return "مبلغ نامعتبر است";
            break;
        case "31":
            return "پاسخ نامعتبر است";
            break;
        case "32":
            return "فرمت اطلاعات وارد شده صحیح نمی باشد";
            break;
        case "33":
            return "حساب نامعتبر است";
            break;
        case "34":
            return "خطای سیستمی";
            break;
        case "35":
            return "تاریخ نامعتبر است";
            break;
        case "41":
            return "شماره درخواست تکراری است";
            break;
        case "42":
            return "یافت نشد Sale تراکنش";
            break;
        case "43":
            return "قبلا درخواست Verify داده شده است";
            break;
        case "44":
            return "درخواست Verfiy یافت نشد";
            break;
        case "45":
            return "تراکنش Settle (تسویه) شده است";
            break;
        case "46":
            return "تراکنش Settle (تسویه)نشده است";
            break;
        case "47":
            return "تراکنش Settle یافت نشد";
            break;
        case "48":
            return "تراکنش Reverse شده است";
            break;
        case "49":
            return "تراکنش Refund یافت نشد";
            break;
        case "51":
            return "تراکنش تکراری است";
            break;
        case "54":
            return "تراکنش مرجع موجود نیست";
            break;
        case "55":
            return "تراکنش نامعتبر است";
            break;
        case "61":
            return "خطا در واریز";
            break;
        case "111":
            return "صادر کننده کارت نامعتبر است";
            break;
        case "112":
            return "خطای سوییچ صادر کننده کارت";
            break;
        case "113":
            return "پاسخی از صادر کننده کارت دریافت نشد";
            break;
        case "114":
            return "دارنده کارت مجاز به انجام این تراکنش نیست";
            break;
        case "412":
            return "شناسه قبض نادرست است";
            break;
        case "413":
            return "شناسه پرداخت نادرست است";
            break;
        case "414":
            return "سازمان صادر کننده قبض نامعتبر است";
            break;
        case "415":
            return "زمان جلسه کاری به پایان رسیده است";
            break;
        case "416":
            return "خطا در ثبت اطلاعات";
            break;
        case "417":
            return "شناسه پرداخت کننده نامعتبر است";
            break;
        case "418":
            return "اشکال در تعریف اطلاعات مشتری";
            break;
        case "419":
            return "تعداد دفعات ورود اطلاعات از حد مجاز گذشته است";
            break;
        case "421":
            return "IP نامعتبر است";
            break;
        default:
            return "خطا در اتصال به درگاه";
    }
}
function sanitize_output($buffer)
{

    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array(
        '>',
        '<',
        '\\1',
        ''
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}
function ob_html_compress($buf)
{
    return str_replace(array("\n", "\r", "\t"), '', $buf);
}
function _ip()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;

    //return '127.0.0.1';
}
function _array_search($input_key, $input_value, $array)
{
    foreach ($array as $key => $val) {
        if ($input_key === $input_value) {
            return $key;
        }
    }
    return null;
}
function pagination_search($query, $per_page = 10, $page = 1, $url = '?')
{
    global $mysqli;
    global $_defines;
    $query = "SELECT COUNT(*) as `num` FROM {$query}";
    $row = mysqli_fetch_assoc(mysqli_query($mysqli, $query));
    $total = $row['num'];
    $adjacents = "1";

    $firstlabel = "<span class='fa fa-angle-right'></span>";
    $prevlabel = "&#60;";
    $nextlabel = "&#62;";
    $lastlabel = "<span class='fa fa-angle-left'></span>";

    $page = ($page == 0 ? 1 : $page);
    $start = ($page - 1) * $per_page;

    $prev = $page - 1;
    $next = $page + 1;

    $lastpage = ceil($total / $per_page);

    $lpm1 = $lastpage - 1; // //last page minus 1
    if ($total <= $per_page) {
        return;
    }
    $pagination = "<div class='posts-view__pagination'>";
    $pagination .= "<div class='row justify-content-center'>";
    if ($lastpage > 1) {
        $pagination .= "<div class='ltn__pagination'><ul class='pagination justify-content-center'>";
        if ($page > 1) {
            //$pagination.= "<li ><a href='{$url}/page,1'>{$firstlabel}</a></li> ";
            $pagination .= "<li class='nav'><a href='{$url}/page,{$prev}'>{$prevlabel}</a></li> ";
        } else {
            $pagination .= "<li class='disabled'><a>{$prevlabel}</a></li> ";
        }
        if ($lastpage < 7 + ($adjacents * 2)) {
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                if ($counter == $page)
                    $pagination .= "<li class='active'><a class='page-numbers active'>" . ("{$counter}") . "</a></li> ";
                else
                    $pagination .= "<li><a href='{$url}/page,{$counter}' class='page-numbers'>" . ("{$counter}") . "</a></li> ";
            }
        } elseif ($lastpage > 5 + ($adjacents * 2)) {

            if ($page < 1 + ($adjacents * 2)) {

                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                    if ($counter == $page)
                        $pagination .= "<li class='active'><a class='page-numbers active'>" . ("{$counter}") . "</a></li> ";
                    else
                        $pagination .= "<li ><a href='{$url}/page,{$counter}'>" . ("{$counter}") . "</a></li> ";
                }
                $pagination .= "<li class='dot'><a> ... </a></li>";
                //$pagination.= "<li ><a href='{$url}/page,{$lpm1}'>".("{$lpm1}")."</a></li> ";
                $pagination .= "<li ><a href='{$url}/page,{$lastpage}'>" . ("{$lastpage}") . "</a></li> ";
            } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                $pagination .= "<li ><a href='{$url}/page,1'>" . ("1") . "</a></li> ";
                //$pagination.= "<li ><a href='{$url}/page,2'>".("2")."</a></li> ";
                $pagination .= "<li class='dot'><a> ... </a></li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<li class='active'><a>" . ("{$counter}") . "</a></li> ";
                    else
                        $pagination .= "<li ><a href='{$url}/page,{$counter}'>" . ("{$counter}") . "</a></li> ";
                }
                $pagination .= "<li class='dot'><a> ... </a></li> ";
                //$pagination.= "<li ><a href='{$url}/page,{$lpm1}'>".("{$lpm1}")."</a></li> ";
                $pagination .= "<li class='no-active'><a href='{$url}/page,{$lastpage}'>" . ("{$lastpage}") . "</a></li> ";
            } else {

                $pagination .= "<li ><a href='{$url}/page,1'>" . ("1") . "</a></li> ";
                //$pagination.= "<li ><a href='{$url}/page,2'>".("2")."</a></li> ";
                $pagination .= "<li class='dot'><a> ... </a></li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination .= "<li class='active'><a>" . ("{$counter}") . "</a></li> ";
                    else
                        $pagination .= "<li class='no-active'><a href='{$url}/page,{$counter}'>" . ("{$counter}") . "</a></li> ";
                }
            }
        }

        if ($page < $counter - 1) {
            $pagination .= "<li class='nav'><a href='{$url}/page,{$next}'>{$nextlabel}</a></li> ";
            //$pagination.= "<li ><a href='{$url}/page,$lastpage'>{$lastlabel}</a></li> ";
        } else {
            $pagination .= "<li class='disabled'><a>{$nextlabel}</a></li> ";
        }

        $pagination .= "</ul></div>";
    }
    $pagination .= "</div></div>";
    if ($lastpage > 1) {
        $mycolsize = 'col-12 text-center text-md-left';
    } else {
        $mycolsize = 'col-12 text-center text-md-left';
    }
    $pagination .= "<div class='" . $mycolsize . " my-farsi'><div class='page-numbers'>";
    $pagination .= "</div></div>";
    if ($lastpage > 1) {
        //$pagination .= "<li class='page_info my-farsi'><span>صفحه ".("{$page}")." از ".("{$lastpage}")."</span></li>";
    }

    return $pagination;
}
function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 0) return $min; // not so random...
    $log = log($range, 2);
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd >= $range);
    return $min + $rnd;
}

function _notification_template($type, $receiver, $action)
{
    global $mysqli;
    $sql       = "SELECT * FROM `email_templates` WHERE `type` = '$type' AND `receiver` = '$receiver' AND  `action` = '$action' ";
    $result    = $mysqli->query($sql);
    $row       = $result->fetch_assoc();
    if (!$row) return "";
    return $row;
}
function _clean_html($string)
{
    $string = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $string);
    $string = preg_replace('/(<[^>]+) dir=".*?"/i', '$1', $string);
    $string = preg_replace('/<p[^>]*><\\/p[^>]*>/', '', $string);
    $string = preg_replace('/<div[^>]*><\\/div[^>]*>/', '', $string);
    $string = preg_replace('/<div[^>]*>&nbsp;<\\/div[^>]*>/', '', $string);
    $string = preg_replace('/<p[^>]*>&nbsp;<\\/p[^>]*>/', '', $string);
    $string = preg_replace('/<p[^>]*>&nbsp;<\\/p[^>]*>/', '', $string);
    $string = preg_replace('/[\r\n]+/', "\n", $string);
    $string = preg_replace('/[ \t]+/', ' ', $string);
    return $string;
}
function _clean($string)
{
    global $mysqli;
    $string = str_replace('"', ' ', $string);
    $string = str_replace("'", ' ', $string);
    $string = trim(preg_replace('/\s+/', ' ', $string));
    $string = _strip_tags(($string));
    return $string;
}
function _token($length = 128)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet .= "0123456789";
    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, strlen($codeAlphabet))];
    }
    return $token;
}
function _random($length = 32)
{
    $token = "";
    $codeAlphabet = "1234567890";
    $codeAlphabet .= "1234567890";
    $codeAlphabet .= "0123456789";
    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[crypto_rand_secure(0, strlen($codeAlphabet))];
    }
    return $token;
}
function _highlight($content, $word, $color = '#FAF200')
{
    $replace = '<span style="background-color: ' . $color . '; color:#222;">' . $word . '</span>'; // create replacement
    $content = str_replace($word, $replace, $content); // replace content

    return $content; // return highlighted data
}

function _function_get($table, $col, $input, $output)
{
    global $mysqli;
    $table    = _strip_tags(($table));
    $col        = _strip_tags(($col));
    $input    = _strip_tags(($input));
    $output = _strip_tags(($output));
    
    // print_r($_config['site_title']);die;
    $sql       = "SELECT $output FROM $table WHERE $col = '$input' ";
    // print_r($sql);die;
    $result    = $mysqli->query($sql);
    $row       = $result->fetch_assoc();
    if (!$row) return "";
    if ($output == '*') {
        return $row;
    } else {
        return $row[$output];
    }
}
function _function_get_multi($table, $col, $input, $output)
{
    global $mysqli;

    $table  = $mysqli->real_escape_string(strip_tags($table));
    $col    = $mysqli->real_escape_string(strip_tags($col));
    $input  = $mysqli->real_escape_string(strip_tags($input));
    $output = $mysqli->real_escape_string(strip_tags($output));

    $sql       = "SELECT $output FROM $table WHERE  $col = '$input' ";
    $result    = $mysqli->query($sql);
    $row       = $result->fetch_assoc();
    if (!$row) return "";
    return $row;
}
function _function_count($table, $col, $input, $output)
{
    global $mysqli;

    $table    = _strip_tags(($table));
    $col        = _strip_tags(($col));
    $input    = _strip_tags(($input));
    $output = _strip_tags(($output));

    $sql       = "SELECT $output AS count FROM $table WHERE  $col = '$input' ";
    //echo $sql;
    $result    = $mysqli->query($sql);
    //$row       = mysqli_fetch_assoc($result);
    $row       = $result->fetch_assoc();
    if (!$row) return "";
    return $row['count'];
}
function _price($price, $show_currency = true)
{
    global $_defines;
    if ($show_currency === true) {
        if ($_defines['currency']['position'] == 'after') {
            return number_format($price, $_defines['currency']['decimals'], $_defines['currency']['decimal_point'], $_defines['currency']['separator']) . ' <font class="my-currency before">' . $_defines['currency']['sign'] . '</font>';
        } else {
            return '<font class="my-currency after">' . $_defines['currency']['sign'] . '</font>' . number_format($price, $_defines['currency']['decimals'], $_defines['currency']['decimal_point'], $_defines['currency']['separator']);
        }
    } else {
        return number_format($price);
    }
}
function startsWith($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}
function _protect_email($email)
{
    $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';

    $key = str_shuffle($character_set);
    $cipher_text = '';
    $id = 'e' . rand(1, 999999999);

    for ($i = 0; $i < strlen($email); $i += 1) $cipher_text .= $key[strpos($character_set, $email[$i])];

    $script = 'var a="' . $key . '";var b=a.split("").sort().join("");var c="' . $cipher_text . '";var d="";';

    $script .= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';

    $script .= 'document.getElementById("' . $id . '").innerHTML="<a my-english href=\\"mailto:"+d+"\\">"+d+"</a>"';

    $script = "eval(\"" . str_replace(array("\\", '"'), array("\\\\", '\"'), $script) . "\")";

    $script = '<script type="text/javascript">/*<![CDATA[*/' . $script . '/*]]>*/</script>';

    return '<span id="' . $id . '">[javascript protected email address]</span>' . $script;
}
function time_passed($timestamp)
{
    //type cast, current time, difference in timestamps
    $timestamp      = (int) $timestamp;
    $current_time   = time();
    $diff           = $current_time - $timestamp;

    //intervals in seconds
    $intervals      = array(
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60
    );

    //now we just find the difference
    if ($diff == 0) {
        return 'just now';
    }

    if ($diff < 60) {
        return $diff == 1 ? $diff . ' ' . 'ثانیه پیش' : $diff . ' ' . 'ثانیه پیش';
    }

    if ($diff >= 60 && $diff < $intervals['hour']) {
        $diff = floor($diff / $intervals['minute']);
        return $diff == 1 ? $diff . ' ' . 'دقیقه پیش' : $diff . ' ' . 'دقیقه پیش';
    }

    if ($diff >= $intervals['hour'] && $diff < $intervals['day']) {
        $diff = floor($diff / $intervals['hour']);
        return $diff == 1 ? $diff . ' ' . 'ساعت پیش' : $diff . ' ' . 'ساعت پیش';
    }

    if ($diff >= $intervals['day'] && $diff < $intervals['week']) {
        $diff = floor($diff / $intervals['day']);
        return $diff == 1 ? $diff . ' ' . 'روز پیش' : $diff . ' ' . 'روز پیش';
    }

    if ($diff >= $intervals['week'] && $diff < $intervals['month']) {
        $diff = floor($diff / $intervals['week']);
        return $diff == 1 ? $diff . ' ' . 'هفته پیش' : $diff . ' ' . 'هفته پیش';
    }

    if ($diff >= $intervals['month'] && $diff < $intervals['year']) {
        $diff = floor($diff / $intervals['month']);
        return $diff == 1 ? $diff . ' ' . 'ماه پیش' : $diff . ' ' . 'ماه پیش';
    }

    if ($diff >= $intervals['year']) {
        $diff = floor($diff / $intervals['year']);
        return $diff == 1 ? $diff . ' ' . 'سال پیش' : $diff . ' ' . 'سال پیش';
    }
}
function _remove_from_comma($str, $item)
{
    $parts = explode(',', $str);
    while (($i = array_search($item, $parts)) !== false) {
        unset($parts[$i]);
    }
    return implode(',', $parts);
}
function _verified_alert($type)
{
    if ($type == 'email') {
        $message    =   _translate('profile_edit_hint_verify_email');
    } else {
        $message    =   _translate('profile_edit_hint_verify_mobile');
    }
    if (!isset($_SESSION['verify_' . $type])) {
        $_SESSION['verify_' . $type]   =  $message;
    }
}
function _verified_alert_remove($type)
{
    if (isset($_SESSION['verify_' . $type])) {
        unset($_SESSION['verify_' . $type]);
    }
}
function _alias_reverse($text)
{
    return ucwords(str_replace("_", " ", $text));
}
function _categories_tree($parent_id)
{
    $items = [];

    global $mysqli;
    global $_defines;
    global $_modules;
    $sql    = "SELECT `id`,`parent_id`,`title`,`alias` FROM `products_categories` WHERE `status` = 'T' ORDER BY CASE WHEN `parent_id` = $parent_id THEN `ordering` END ASC,CASE WHEN `parent_id` <> $parent_id THEN `title` END ASC ";
    
    // echo $sql;die;
    $query = $mysqli->query($sql);
    $ref   = [];
    
    while ($data = $query->fetch_assoc()) {
        $item_link  = $_defines['domain'] . '/products/' . $data['alias'];
        $thisRef    = &$ref[$data['id']];
        $thisRef['id']          = $data['id'];
        $thisRef['parent_id']   = $data['parent_id'];
        $thisRef['title']       = $data['title'];
        $thisRef['alias']       = $data['alias'];
        if ($data['parent_id'] == $parent_id) {
            $items[] = &$thisRef;
        } else {
            $ref[$data['parent_id']]['childs'][] = &$thisRef;
        }
    }

    return $items;
}
