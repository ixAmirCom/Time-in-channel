<?php
error_reporting(0);
date_default_timezone_set('Asia/Tehran');
include('jdf.php');
define('TOKEN','12345:Abcd'); // Your Bot Token
$channel = '@'; // Your Channel ID
//===[Required functions]===//
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".TOKEN."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res);
}
}
//=====Variables=====//
$update = json_decode(file_get_contents('php://input'));
if(isset($update->channel_post->new_chat_title)){
bot('deleteMessage',[
'chat_id'=>$update->channel_post->chat->id,
'message_id'=>$update->channel_post->message_id
]);
exit();
}
$time = str_replace(range(0,9),["๐","๐","๐","๐","๐","๐","๐","๐","๐","๐"],jdate("H:i"));
$date = str_replace(range(0,9),["๐","๐","๐","๐","๐","๐","๐","๐","๐","๐"],jdate("Y/m/d"));
$random = ["๐","๐","๐","๐","โค๏ธ","๐","๐","๐น","๐","๐","๐","๐","๐","๐","โ๐ฅฒ","๐","๐ง","๐คช","๐คฉ","๐ฅณ","๐","๐คฏ","๐ถ","๐ด"];
$emoji = $random[array_rand($random)];
bot('setChatDescription',[
'chat_id'=>$channel,
'description'=>"
โข Tสแด Oสษขษชษดแดส Cสแดษดษดแดส Oา AแดษชสAสษช Zแดแดแดษดษช โข

โค๏ธโข ษชแด แดสส sแดแดสแดแดแด าสแดแด แดขแดสแด !

๐ฎ๐ท โข Sแดสแดแดแดแด Tแด Tสแด Lแดแดกs Oา Tสแด Isสแดแดษชแด Rแดแดแดสสษชแด Oา ษชสแดษด !

โ๏ธ โข I.R Time : $time
๐ โข I.R Date : $date
"]); //Channel Description
?>