<?php

/*************************
 * Organization: ZSCTF
 * Author: Lechnolocy_LRWF
 * Version: 5.0.0
**************************/

function tokenset ($length = 16) {
    
    // token包含的字符集
    $chars = array(
        'a', 'b', 'c', 'd', 'e', 'f', 'g',
        'h', 'i', 'j', 'k', 'l', 'm', 'n',
        'o', 'p', 'q', 'r', 's', 't',
        'u', 'v', 'w', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G',
        'H', 'I', 'J', 'K', 'L', 'M', 'N',
        'O', 'P', 'Q', 'R', 'S', 'T',
        'U', 'V', 'W', 'X', 'Y', 'Z',
        '1', '2', '3', '4', '5',
        '6', '7', '8', '9', '0');
    
    $keys = array_rand($chars, $length); 

    $password = '';
    
    for($i = 0; $i < $length; $i++) {
        
        $password .= $chars[$keys[$i]];
        
    }
    
    return $password;
    
}

?>