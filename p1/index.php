<!DOCTYPE html>
<html>
<head>
<title>Project 1</title>
</head>
<body>

<form action="index.php" method="post">
    <label>Enter a string</label>
    <input type="text" name="string">
    <input type="submit" >
</form>
</body>
</html> 
<?php
    if(!$_POST){
        return;
    }
    
    //palindrome
    
    $string = $_POST['string'];
    
    echo "String: {$string} <br><br>";

    if(empty($string)){
        echo "please enter a string";
        return;
    }
    
    $stringStrp =  preg_replace( '/[\W]/', '', $string);
    $stringLwr = strtolower($stringStrp);
    
    echo "Is a palindrome? <br>";
    
    if(strrev($stringLwr) == $stringLwr){
        echo "Yes <br><br>";
    }else{
        echo "No <br>";
    }

    //shift
    
    $chars = str_split($stringLwr);
    $charBytes = [];
    $newString = null;
    
    foreach($chars as $char){
        $charBytes[] = ord($char) + 1;
    }
    
    foreach($charBytes as $charByte){
        $newString .= chr($charByte);
    }
    
    echo "Shifted string: {$newString}";
