<?php
header('Content-Type: application/json');

$settings = file_get_contents("settings.json");

$data = json_decode($settings, true);

if(isset($_GET['set'])){
    $save = 1;
    $set = $_GET['set'];
    $data["lights"]["green"] = ($set % 2);
    $set = ($set - ($set % 2)) / 2;
    $data['lights']['yellow'] = ($set % 2);
    $set = ($set - ($set % 2)) / 2;
    $data['lights']['red'] = ($set % 2);
}

if(isset($_GET['toggle'])){
    $save = 1;
    $set = $_GET['toggle'];
    $data["lights"]["green"] = (($set % 2) xor $data["lights"]['green']);
    $set = ($set - ($set % 2)) / 2;
    $data['lights']['yellow'] = (($set % 2) xor $data["lights"]['yellow']);
    $set = ($set - ($set % 2)) / 2;
    $data['lights']['red'] = (($set % 2) xor $data["lights"]['red']);
}

if(isset($_GET['mode'])){
    $save = 1;
    $mode = $_GET['mode'];
    $data['mode'] = $mode;
}

if($save==1){
    $json = json_encode($data);
    $file = fopen("settings.json", "w");
    fwrite($file, $json);
    print $json;
}else{

//http_response_code(511);

print $settings;
}