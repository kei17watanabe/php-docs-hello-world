<?php

echo "Hello World!";

// 許可IPリスト
$allowIpList = array(
          '52.234.169.113',
);
// リモートIP取得
$thisIp = $_SERVER['REMOTE_ADDR'];
// リモートIPをドットで区切る
$thisIpNums = explode('.', $thisIp);
// リモートIPを10進数値に変更
$thisIpNum = isset($thisIpNums[3]) ? (
          $thisIpNums[0] * pow(2,24)
          + $thisIpNums[1] * pow(2,16)
          + $thisIpNums[2] * pow(2,8)
          + $thisIpNums[3] * pow(2,0)
          ) : 0;
// 許可IPリストとのマッチ検索開始
$matchFlag = false;
foreach ($allowIpList as $allowIp) {
          // 許可IPをスラッシュで区切る
          $allowIpArray = explode('/', $allowIp);
 
          // 許可IPをドットで区切る
          $allowIpNums = explode('.', $allowIpArray[0]);
 
          // 許可IPを10進数値に変更
          $allowIpNum = isset($allowIpNums[3]) ? (
                    $allowIpNums[0] * pow(2,24)
                    + $allowIpNums[1] * pow(2,16)
                    + $allowIpNums[2] * pow(2,8)
                    + $allowIpNums[3] * pow(2,0)
                    ) : 0;
 
          // 許可IPのマスクを数値に変更
          $maskNum = isset($allowIpArray[1])  
                    ? (pow(2,(int)$allowIpArray[1]) - 1) * pow(2, 32 - (int)$allowIpArray[1])
                    : pow(2, 32) - 1;
 
          // リモートIPと許可IPの一致を確認
          if (($thisIpNum & $maskNum) === ($allowIpNum & $maskNum)) {
                    $matchFlag = true;
                    break;
          }
}
 
// 一致が無ければIP制限
if (!$matchFlag) {
          // 制限の処理・・・
}
