<?php

if (! defined('BASEPATH')) exit('No direct script access allowed');
 
if (! function_exists('demo')) {
    function text_cut($text,$limit)
    {
        // get main CodeIgniter object
       if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
       
        // Write your logic as per requirement
        
    }
}


?>