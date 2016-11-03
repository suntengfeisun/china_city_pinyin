<?php

//文件位置
$json_file = 'ChinaCityList.json';
//打开文件
$city_json = file_get_contents($json_file);
//后面要加true才是转数组,否则是object
$city_arr = json_decode($city_json,true);

//连接数据库
$connect = mysqli_connect('localhost','root','','appmondb');
//设置数据库编码
mysqli_query($connect,'set names utf8');
 
foreach($city_arr as $k){
    foreach ($k['city'] as $kk){
        $city_name = $kk['county'][0]['countyName'];
        $city_pinyin = ucfirst($kk['county'][0]['countyPY']);
        echo $city_pinyin;
        echo '||||||||';
        $sql = "INSERT INTO `appmon_city_pinyin` (`name`, `pinyin`) VALUES ('{$city_name}','{$city_pinyin}')";
        mysqli_query($connect,$sql);
    }
}

mysqli_close($connect);