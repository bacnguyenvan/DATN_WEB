<?php 
	function _debug($data) {

        echo '<pre style="background: #000; color: #fff; width: 100%; overflow: auto">';
        
        $debug_backtrace = debug_backtrace();
        $debug = array_shift($debug_backtrace);

        echo '<div>File: ' . $debug['file'] . '</div>';
        echo '<div>Line: ' . $debug['line'] . '</div>';

        if(is_array($data) || is_object($data)) {
            print_r($data);
        }
        else {
            var_dump($data);
        }
        echo '</pre>';
        // die();
    }

	//get Input
	function getInput($string)
	{
		return isset($_GET[$string])?$_GET[$string]:'';
	}
	// post input 
	function postInput($string)
	{
		return isset($_POST[$string])?$_POST[$string]:'';
	}
	//covert unsigned text
	function changeTitle($str,$strSymbol='-',$case=MB_CASE_LOWER){// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
		$str=trim($str);
		if ($str=="") return "";
		$str =str_replace('"','',$str);
		$str =str_replace("'",'',$str);
		$str = stripUnicode($str);
		$str = mb_convert_case($str,$case,'utf-8');
		$str = preg_replace('/[\W|_]+/',$strSymbol,$str);
		return $str;
	}

	function stripUnicode($str){
		if(!$str) return '';
		//$str = str_replace($a, $b, $str);
		$unicode = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
			'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
			'ae'=>'ǽ',
			'AE'=>'Ǽ',
			'c'=>'ć|ç|ĉ|ċ|č',
			'C'=>'Ć|Ĉ|Ĉ|Ċ|Č',
			'd'=>'đ|ď',
			'D'=>'Đ|Ď',
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
			'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
			'f'=>'ƒ',
			'F'=>'',
			'g'=>'ĝ|ğ|ġ|ģ',
			'G'=>'Ĝ|Ğ|Ġ|Ģ',
			'h'=>'ĥ|ħ',
			'H'=>'Ĥ|Ħ',
			'i'=>'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',	  
			'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
			'ij'=>'ĳ',	  
			'IJ'=>'Ĳ',
			'j'=>'ĵ',	  
			'J'=>'Ĵ',
			'k'=>'ķ',	  
			'K'=>'Ķ',
			'l'=>'ĺ|ļ|ľ|ŀ|ł',	  
			'L'=>'Ĺ|Ļ|Ľ|Ŀ|Ł',
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
			'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
			'Oe'=>'œ',
			'OE'=>'Œ',
			'n'=>'ñ|ń|ņ|ň|ŉ',
			'N'=>'Ñ|Ń|Ņ|Ň',
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
			'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
			's'=>'ŕ|ŗ|ř',
			'R'=>'Ŕ|Ŗ|Ř',
			's'=>'ß|ſ|ś|ŝ|ş|š',
			'S'=>'Ś|Ŝ|Ş|Š',
			't'=>'ţ|ť|ŧ',
			'T'=>'Ţ|Ť|Ŧ',
			'w'=>'ŵ',
			'W'=>'Ŵ',
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
			'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
			'z'=>'ź|ż|ž',
			'Z'=>'Ź|Ż|Ž'
		);
		foreach($unicode as $khongdau=>$codau) {
			$arr=explode("|",$codau);
			$str = str_replace($arr,$khongdau,$str);
		}
		return $str;
	}

	function base_url()
	{
		return $url = 'http://localhost/do_an_tot_nghiep/';
		// return $url = 'http://barcode.localhost.com/';
	}
	function modules($url)
	{
		return base_url()."admin/".$url;
	}

	if(!function_exists('redirectStyle'))
	{
		function redirectStyle($url = '')
		{
			header("location: ".base_url()."admin/{$url}");
			exit();
		}
	}

	if(!function_exists('redirect'))
	{
		function redirect($url = '')
		{
			header("location: ".base_url()."{$url}");
			exit();
		}
	}

	if( ! function_exists('xss_clean') ) {
        function xss_clean($data)
        {
            // Fix &entity\n;
            $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
            $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
            $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
            $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

            // Remove any attribute starting with "on" or xmlns
            $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

            // Remove javascript: and vbscript: protocols
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

            // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

            // Remove namespaced elements (we do not need them)
            $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

            do
            {
                // Remove really unwanted tags
                $old_data = $data;
                $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
            }
            while ($old_data !== $data);

            // we are done...
            return $data;
        }
    }

?>