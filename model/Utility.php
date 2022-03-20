<?php

/**
 * Description of Utility
 *
 * @author Andy Banagsberg
 * Used for the WishList Project
 */
class Utility {    
   public static function  getUserRoleIdFromSession(){
       $roleID = 0;

       if(isset($_SESSION['loginInfo']))
        {
            foreach ($_SESSION['loginInfo'] as $item)
            {
                $roleID = $item['role'];
            }           
        }
       return $roleID;     
   }
   
    public static function  getUserIdFromSession(){
       $userID = 0;

       if(isset($_SESSION['loginInfo']))
        {
            foreach ($_SESSION['loginInfo'] as $item)
            {
                $userID = $item['id'];
            }           
        }
       return $userID;     
   }
   
   public static function  getMessageFromSession(){
       $message = '';
       if(isset($_SESSION['loginInfo']))
        {
            $message = '';
            foreach ($_SESSION['loginInfo'] as $item)
            {
                $message = $item['message'];
            }
        }
       return $message;     
   }
   
   public static function getLoginClass($UserId)
   {
       $login = 'visible';
       if($UserId == "0" || $UserId == '')
        {
            $login = 'visible';
        }
        else
        {
            $login = 'hidden';
        }
        
        return $login;
   }
   
   public static function getLogoutClass($UserId)
   {
       $logout = 'hidden';
       if($UserId == "0" || $UserId == '')
        {
            $logout = 'hidden';
        }
        else
        {
            $logout = 'visible';
        }
        
        return $logout;
   }
   
   public static function getAdminClass($UserRole)
   {
       $admin = 'hidden';
       if($UserRole == '2')
        {
            $admin = 'visible';
        }
        else
        {
            $admin = 'hidden';
        }
        
        return $admin;
   }
   
   public static function getEditRights($ItemUserId, $UserId, $UserRole)
   {
       $itemVisibility = 'hidden';
       if($ItemUserId == $UserId || $UserRole == '2')
       {
           $itemVisibility = 'visible';
       }
        
        return $itemVisibility;
   }
   
   public static function setSelectedOption($expectedValue, $compareToValue){
        $selectedState = "";
        if($expectedValue == $compareToValue)
        {
            $selectedState = " selected ";
        }
        return $selectedState;
    }       

    public static function getIsActiveString($IsActive) {
        if($IsActive == '0')
        {$activeStatus = 'No';}
        else
        {$activeStatus = 'Yes';}
        return $activeStatus;
    }  
    
    public static function getFulfilled($fulfilledByName)
    {
        if($fulfilledByName != null || trim($fulfilledByName) != '')
        {
            $fulfilled = 'N/A';
        }
        else
        {
            $fulfilled = '';
        }
        
        return $fulfilled;
    }
    
    public static function getFulfilledType($fulfilledByName)
    {
        if($fulfilledByName != null || trim($fulfilledByName) != '')
        {
            $type = 'hidden';
        }
        else
        {
            $type = 'visible';
        }
        
        return $type;
    }
}
