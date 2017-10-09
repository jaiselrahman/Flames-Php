<?php

function flames($name1, $name2) {
    if(!isset($name1) or !isset($name2)) {
        return null;
    }
    $name1 = sort_str($name1);
    $name2 = sort_str($name2);
    
    if(strlen($name1) < strlen($name2)) {
		$temp = $name2;
		$name2 = $name1;
		$name1 = $temp;
	}
	$len1 = strlen($name1);
    $len2 = strlen($name2);
    $tot = $len1 + $len2;
    $n = 0;
    for($i = 0; $i < $len1; $i++) {
        for($j = $n; $j < $len2; $j++) {
            if($name1[$i] == $name2[$j]) {
                $tot -= 2;
                $n = ++$j;
                break;
            }
        }
    }
    $result = 'flames';
    while (strlen($result) > 1) {
        $n2 = $tot % strlen($result);
        $n2 = ($n2 == 0) ? strlen($result) : $n2; 
        $t = substr($result, $n2);
        $result = substr($result, 0, $n2-1);
        $result = $t . $result;
    }
    switch($result) {
		case 'f':
			$res = 'Friends';
			break;
		case 'l':
			$res = 'Love';
			break;
		case 'a':
			$res = 'Affectionate';
			break;
		case 'm':
			$res = 'Marriage';
			break;
		case 'e':
			$res = 'Enemies';
			break;
		case 's':
			$res = 'Siblings';
			break;
		default:
			$res = null;
	}
	return $res;
}

function sort_str($str) {
    $str = str_split(strtolower($str));
    sort($str);
    $str=implode('',$str);
    return trim($str);
}
