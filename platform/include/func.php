<?php 
function valueClear($veri) 
{
    $veri = str_replace("`","",$veri); 
    $veri = str_replace("=","",$veri ); 
    $veri = str_replace("&","",$veri ) ;
    $veri = str_replace("%","",$veri ) ;
    $veri = str_replace("!","",$veri ) ;
    $veri = str_replace("#","",$veri ) ;
    $veri = str_replace("<","",$veri ) ;
    $veri = str_replace(">","",$veri ) ;
    $veri = str_replace("*","",$veri ) ;
    $veri = str_replace("And","",$veri ); 
    $veri = str_replace("'","&#39",$veri ) ;
    $veri = str_replace("Chr(34)","",$veri ) ; 
    $veri = str_replace("Chr(39)","",$veri ) ;
    return $veri;
}