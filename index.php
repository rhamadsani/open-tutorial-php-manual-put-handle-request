<?php

$request = $_SERVER['REQUEST_METHOD'];

//determine
if(strtolower($request) != 'put'){
    echo json_encode([
        'status' => 'error', 
        'message' => 'method is not allow, using PUT'
    ]);
    return false;
}
function put(){
    parse_str(file_get_contents("php://input"), $_PUT);

    $data = '';
	foreach ($_PUT as $key => $value)
	{
        $clean_key = str_replace('_', ' ', $key);
        $data = str_replace($clean_key.'=', '', $value);
        $data = str_replace('"', '', $data);
	}
    $newArr = explode(PHP_EOL, $data);
    $total = count($newArr);
    $counter = 1;
    foreach($newArr as $k => $val){
        if($k == $counter){
            unset($newArr[$k]);
            $counter+=3;
        }

    }
    unset($newArr[$total-=2]);
    $c = 1;
    $keyVal = [];
    $last = '';
    foreach($newArr as $key => $val)
    {
        if($c % 2 != 0){//if odd
            //is key
            $keyVal[$val] = '';
            $last = $val;
        }else{
            //is val
            $keyVal[$last] = $val;
        }
        $c++;
    }
    // var_dump($keyVal['id']);
    var_dump($keyVal);
}

put();