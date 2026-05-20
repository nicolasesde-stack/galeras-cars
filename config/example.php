<?php
   // this is a line comment
   /*
   This is a block comment
   deveeloper: Nicolas D. Escobar
   */
   
   echo "hello world. We're here";
    $num1 = 20;
    $num2 = 10;
    $add = $num1 + $num2;
    echo "<br>";
    echo "<font color='RED'><b> the addition is:</b> 
    </font>". $add;
    if ($num1 > $num2){
        echo "<br>you win";

    }else{
        echo "<br>You lose";
    }
?>