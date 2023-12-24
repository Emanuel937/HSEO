<?php
/**
 *  THE ENDPOINT OF CLASS TO
 *  GENERATE THE ALL CLASS
 *  GEETING DATA FROM WEB AND MAKE DATABASE
*/

@Define('__USER__INPUT', $_GET['key']);
class Main extends GetContact
{   
    use StockerCheker;
    public function __construct()
    {   parent::__construct();
        $this->INPUT_FROM_USER   = __USER__INPUT ;
        $this->total             = 10;
        if(isset($this->INPUT_FROM_USER)){
            $this->runMain();
        }else{
            echo "the request don't work, please try to type a keyword to make it run";
        }

    }
    final public function runMain():void{
        // MainStocke can from StockerChecker php file
        // it is a trait method
        $theData = $this->mainStocker();
        $this->isSingleSite($theData);
    }
}

