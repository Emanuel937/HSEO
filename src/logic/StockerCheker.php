<?php
/**
 *  - THIS TRAIT CODE, IS USDE FOR :
 *  - GET LINK FROM GOOGLE AFTER GOOGLE
 *  - CHECK IF USER ENTER KEYWORDS OR LINK
 */

declare(strict_types = 1);
trait StockerCheker 
{   
    use GoogleSetting;
    public  $INPUT_FROM_USER;
    public  $total;
    
    public function isKeyWord():bool{
        
        $regEx  = '/^(https?:\/\/)?(www\.)?([a-zA-Z0-9-]+\.){1,}[a-zA-Z]{2,}(\.[a-zA-Z]{2,})?$/';
        $status = preg_match_all($regEx, $this->INPUT_FROM_USER);
        $status = $status == 0 || !$status;

        return $status;
    }
    
    public function linksFromGoogle():Array{
        $this->initializeFromJson();
       return $this->Setting($this->INPUT_FROM_USER, $this->total);
    }

    public function mainStocker():mixed{

        if($this->isKeyWord())
        {
            $res =  $this->linksFromGoogle();
            // GET THE LINK FROM GOOGLE 
        }else{
            $res = $this->INPUT_FROM_USER;
        }
        return $res;
    }

}
