<?php
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Library SSOAuth
 *
 * @package		Template - Library
 * @author		Julius Limson 
 * @link		gist.github.com/jtlimson
 * @version		1.1
 */

namespace App\Helpers;
use SoapClient;

class Efiling {

    private $params;
    private $soapClient;    
   // private $soapToken;
    private $ip_address;    
    public function __construct(){    
        
     //   $this->soapToken = array( 'token' => config('app.soap_token') );

        if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $this->ip_address =array('ip_address'=>  $_SERVER['HTTP_X_FORWARDED_FOR']);
        } else {
            $this->ip_address =array('ip_address'=> $_SERVER['REMOTE_ADDR']) ;
        }
        $soap_address = config('app.soap_address');       
        @$sgs = file_get_contents($soap_address);         //check if webservice is online
        if ($sgs == FALSE)
        {
                throw new Exception();
        }
        $this->soapClient = new SoapClient($soap_address);        
    }

    public function CopyToBackUp($pin, $branch_id)
    {
        $soap = $this->soapClient->CopyToBackUp( array("pin" => $pin, "branch_id" => $branch_id) );
        return $soap->CopyToBackUpResult;  //returns bool 
    }
    
    public function MoveBackUpFolder($originPin, $ReplaceWith, $branch_id) 
    {
        $soap = $this->soapClient->MoveBackUpFolder( array("originPin" => $originPin, 
                    "ReplaceWith" => $ReplaceWith, 
                    "branch_id" => $branch_id) );
    
        return $soap->MoveBackUpFolderResult;        //returns bool 
    }
    
    public function MoveBackUpFile($originalPin, $originalFileName, $targetPin, $targetFileName, $branch_id) 
    {
        $soap = $this->soapClient->MoveBackUpFile( array("originalPin" => $originalPin, 
                    "originalFileName" => $originalFileName, 
                    "targetFileName" => $targetFileName, 
                    "branch_id" => $branch_id) );
       
        return $soap->MoveBackUpFileResult; //returns bool 
    }

    public function CreateStagingDirectory($pin, $branch_id)
    {
        $soap = $this->soapClient->CreateStagingDirectory( array("pin" => $pin, "branch_id" => $branch_id) );     
      
        return $soap->CreateStagingDirectoryResult;  //returns string 
    }
    
    public function DeleteStagingDirectory($pin, $branch_id) 
    {
        $soap = $this->soapClient->DeleteStagingDirectory( array("pin" => $pin, "branch_id" => $branch_id) );
        
        return $soap->DeleteStagingDirectoryResult;  //returns bool 
    }
    
    public function DeleteStagingFiles($pin, $fileName, $branch_id) {
        $soap = $this->soapClient->DeleteStagingFiles( array("pin" => $pin, 
                "fileName" => $fileName, 
                "branch_id" => $branch_id) );       
                
        return $soap->DeleteStagingFilesResult;  //returns bool 
    }

    public function GetStagingDirectories($branch_id) 
    {
        $soap = $this->soapClient->GetStagingDirectories( array("branch_id" => $branch_id) );
        
        if( $soap->GetStagingDirectoriesResult == null || $soap->GetStagingDirectoriesResult == [] || $soap->GetStagingDirectoriesResult == ""  || 
            count( (array) $soap->GetStagingDirectoriesResult) == 0)  {           
            $is_array =   [];           
        }
        else 
        {            
            $is_array = $soap->GetStagingDirectoriesResult->string ;
        }
        return (array)$is_array; //returns string[]       
    }

    public function GetStagingFiles($pin, $branch_id)
    {
        $soap = $this->soapClient->GetStagingFiles( array("pin" => $pin, "branch_id" => $branch_id) );

        if( $soap->GetStagingFilesResult == null || $soap->GetStagingFilesResult == [] || $soap->GetStagingFilesResult == ""  || 
        count( (array) $soap->GetStagingFilesResult) == 0)  {           
            $is_array =   [];           
        }
        else 
        {            
            $is_array = $soap->GetStagingFilesResult->string ;
        }
        return (array)$is_array; //returns string[]
    }

    public function GetFiles($pin, $branch_id) 
    {
        $soap = $this->soapClient->GetFiles( array("pin" => $pin, "branch_id" => $branch_id) );

        if( $soap->GetFilesResult == null || $soap->GetFilesResult == [] || $soap->GetFilesResult == ""  || 
        count( (array) $soap->GetFilesResult) == 0)  {           
            $is_array =   [];           
        }
        else 
        {            
            $is_array = $soap->GetFilesResult ;
        }
        return (array)$is_array; //returns Obj
    }

}
?>