<?php
/**
 * Tomcat Installation Form Handler
 */
error_reporting(E_ALL);
require_once "/usr/local/cpanel/php/cpanel.php";
require_once "Tomcat.php";
$cpanel = new CPANEL();
$cpanel->set_debug(1);
echo $cpanel->header('cPanel4J');
$domainName = $_POST['domainName'];
$tomCatVersion = $_POST['tomcat-version'];
if(($tomCatVersion=='7.0.57' || $tomCatVersion=='8.0.15') & $domainName != ""){

    $domainListApiCall = $cpanel->api2('DomainLookup','getdocroot', array() );
    $domainList = $domainListApiCall['cpanelresult']['data'];
 
    $docRoot = $domainList['docroot'];
    var_dump($docRoot);
    $roots = explode("/",$docRoot);
    $userName = $roots['2'];
    echo $userName."Is Username";
    $tomcat = new Tomcat();
    $result = $tomcat->createInstance($domainName, $userName, $tomcatVersion);
    if($result['status']=="success"){
        echo $result['message'];
    }else if($result['status']=="fail"){
        echo $result['message'];
    }else{
        echo "Something wrong happend";
    }
    
}else{
    echo "Form Data Error";
}




