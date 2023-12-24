<?php 
/**
 *  THIS CODE GET DATA FROM GOOGLE 
 *  CHECK IF THE USER HOME WEBSITE IS INDEX
 *  AND CHECK ALSO ALL WEBSITE PAGE IF IS INDEX
 *  AT LEATS THIS CODE VERIFY IF THE CLIENT WEBSITE IS ON TOP 50 OF GOOGLE 
 */
class GoogleData{

    public function __construct($inputFromUser) 
    {
        //init google API
        $this->keywordSearching = $inputFromUser;
    }

    public function setUPGoogleAPI($search_query){
        $search_query = str_replace(" ", "_", $search_query);
        $api_key           = 'AIzaSyDygRCiS1D6TpYJGWYjmJjKtfTO4rpcRVY';
        $search_engine_id = '041e380526ef74058';
        $api_endpoint_url = "https://www.googleapis.com/customsearch/v1?key={$api_key}&cx={$search_engine_id}&q={$search_query}";
        $response_json = file_get_contents($api_endpoint_url);
        $response = json_decode($response_json, true);
        return $response;
    }

    public function isIndex(): bool
    {
        $allLinks  = []; // at the moment is empty
        $allStatus = [];
    
        for ($i = 0; $i < count($allLinks); $i++) {
            $single_link = "site:" . $allLinks[$i];
            $indexStatus = $this->setUPGoogleAPI($single_link);
            if (!$indexStatus) {
                // add the link that isn't indexed by Google
                array_push($allStatus, $allLinks[$i]);
            }
        }
    
        return count($allStatus) > 0 ? true : false;
    }
    
    public function SEO_ON_PAGE(){
        return true;
    }
    public function reportInfo(){
       
    }
    public function Top50Results(){
        // this function just check it the user website is on the top 50 
        // and get the user result
       
    }
}



