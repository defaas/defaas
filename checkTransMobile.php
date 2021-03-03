<?php

    $json = file_get_contents('php://input');
    $result = json_decode($json);
    
    $merchantCode = "D7993"; // from duitku
    $merchantKey = "096004ad69feb734317b50d4d6565ff0"; // from duitku
    $merchantOrderId = $result->{'reference'};  // from merchant, unique
    //$merchantOrderId = "20F3E46B2FDF";
    $signature = md5($merchantCode . $merchantOrderId . $merchantKey);
/* 
    $itemsParam = array(
        'merchantCode' => $merchantCode,
        'signature' => $signature
    );
    
    class emp{}
    
    $params = array_merge((array)$result,$itemsParam);
    $params_string = json_encode($params);
    
    //if sandbox
    $url = 'http://sandbox.duitku.com/webapi/api/merchant/transactionStatus';
    //if production
    //$url = 'https://passport.duitku.com/webapi/api/merchant/transactionStatus';
    
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($params_string))                                                                       
    );   
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    //execute post
    $request = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($httpCode == 200)
    {
	      echo $request;
    }
    else
        echo $httpCode; */

    $params = array(
        'merchantCode' => $merchantCode,
        'merchantOrderId' => $merchantOrderId,
        'signature' => $signature
    );

    $params_string = json_encode($params);
    $url = 'http://sandbox.duitku.com/webapi/api/merchant/transactionStatus';
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($params_string))                                                                       
    );   
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    //execute post
    $request = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($httpCode == 200)
    {
        $result = json_decode($request, true);
        //var_dump($result);
    }
    else
        echo $httpCode;
?>