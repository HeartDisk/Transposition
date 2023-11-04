<?php
    require "classes/TranspositionIO.php";
    require "classes/Transposition.php";  

    $transpos = new Transposition();
        $input = 'json/input_second.json';
        $out = 'json/output.json';
        $transpos->responde($input,$out);
?>
