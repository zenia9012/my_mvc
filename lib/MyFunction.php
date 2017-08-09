<?php
/**
 * Created by PhpStorm.
 * User: Yevhenii
 * Date: 30.07.2017
 * Time: 17:11
 */

class MyFunction {
	function getLang($uri){
		$a = explode('/' , $uri);
		if ($a[0] == ''){
			return 'uk/';
		}
		if ($a[0] == 'uk'){
			$b = 'en';
		}elseif ($a[0] == 'en'){
			$b =  'uk';
		}else{
			return false;
		}
		$a[0] = $b;
		$result = implode($a, '/');
		$result = '/' . $result . '/';
		return $result;
	}
}