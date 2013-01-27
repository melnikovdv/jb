<?php

define('RES_NAME', 'BoogieWoogie.ru');
define('RES_DELIMETER', ' | ');

function parenthesise($str) {
  return '(' . $str . ')';
}

function title($text = null) {
  if ($text === null) {
    return RES_NAME;
  } else {
    return RES_NAME . RES_DELIMETER . $text;  
  }  
}

function captcha() {
  // localhost
  // $publickey = "6LfemtsSAAAAAPMkZ8XWEX1cSbFib9HTnWB14mnL"; 
  // $privatekey = "6LfemtsSAAAAAJIkCDbiqF0FgvogCndt8b2bontx";

  // mlayer
  $publickey = "6LdtmtsSAAAAAJI5Uy4PaHl4mYvcIh1Cxzxh_D2_";
  // $privatekey = "6LdtmtsSAAAAAO7svDTeKrUQF6X250-scCMdJibz";
  echo recaptcha_get_html($publickey) . "<br />";
}
?>