<?php
const PATH = __DIR__ . "/string.json";
const __SPACE__ = " ";
const __PLUS__ = "+";

trait GoogleSetting
{
    //@var string
    private  $api_key;
    //@var string
    private $search_engine_id;
    public  $res;
    //@var int
    private $startIndex       = 1;
    private $resultPerPage    = 10;
    private $jsonDataString;
    private $urlOfGoogle;
    private $first;

    final public function initializeFromJson()
    {   

        $this->jsonDataString    = file_get_contents(PATH);
        $this->jsonDataString    = json_decode($this->jsonDataString);
        $this->first             = $firstIndexOfJson = $this->jsonDataString[0];
        $this->api_key           = $firstIndexOfJson->api_key;
        $this->search_engine_id  = $firstIndexOfJson->search_engine_id;
        $this->urlOfGoogle       = $firstIndexOfJson->link;
        echo "The keyword was identified";
     
    }
    final public function setting(string $keyWord,  int $total_results):Array
        {   
            $keyWord = str_replace(__SPACE__,__PLUS__, $keyWord);
            while ($this->startIndex <= $total_results) 
            {
                $api_endpoint_url  = $this->urlOfGoogle;
                $api_endpoint_url .= $this->first->parem[0].$this->api_key;
                $api_endpoint_url .= $this->first->parem[1].$this->search_engine_id;
                $api_endpoint_url .= $this->first->parem[2].$keyWord;
                $api_endpoint_url .= $this->first->parem[3].$this->startIndex;
                $api_endpoint_url .= $this->first->parem[4].$this->resultPerPage;
                $api_endpoint_url .= $this->first->parem[5];
                $api_endpoint_url .= $this->first->coutryCode->france;
                //PERCE DATA
                $response_json = file_get_contents($api_endpoint_url);
                $response = json_decode($response_json, true);
                echo " connectin to the server ....";
                if (isset($response[$this->first->elem[0]])) {
                    foreach ($response[$this->first->elem[0]] as $item) {
                        $this->res[] = $item[$this->first->elem[1]];
                        echo "getting data from server ...";
                    }
                    /**
                     *  make a condiction here to check when the code doesn't run
                     */
                } else {
                    exit(500);
                }
                $this->startIndex += $this->resultPerPage;
        }
        echo "The server send all data";
        return $this->res;
    }
}



