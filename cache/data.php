<?php
// Set your API key and search engine ID
$api_key           = 'AIzaSyDygRCiS1D6TpYJGWYjmJjKtfTO4rpcRVY';
$search_engine_id = '041e380526ef74058';
// Set the search query
$search_query = 'fleuriste';

// Set the number of results per page and the desired total number of results
$results_per_page = 10;
$total_results = 100;

// Initialize the starting index
$start_index = 1;

// Make requests in batches of 10 results until the desired number of results is reached
while ($start_index <= $total_results) {
    // Set the API endpoint URL with the start and num parameters
    $api_endpoint_url = "https://www.googleapis.com/customsearch/v1?key={$api_key}&cx={$search_engine_id}&q={$search_query}&start={$start_index}&num={$results_per_page}";

    // Make a request to the API and get the response
  $response_json = file_get_contents($api_endpoint_url);

    // Decode the JSON response
    $response = json_decode($response_json, true);

    // Check if there is a valid response
    if (isset($response['items'])) {
        // Display the search results
        foreach ($response['items'] as $item) {
            echo "Title: " . $item['title'] . "<br>";
            echo "Link: " . $item['link'] . "<br>";
            echo "Snippet: " . $item['snippet'] . "<br><br>";
        }
    } else {
        echo "Error retrieving search results.";
    }

    // Increment the start index for the next batch of results
    $start_index += $results_per_page;
}
?>
