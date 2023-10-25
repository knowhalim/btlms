<?php

function auth_access($client_id='',$secret=''){
    $curl = curl_init();
    if ($secret=""){
        $secret ='RiMdVCGeTalrbLULbXnul0z9UwMhRxJyQh9yvISrLCtS8SNIHCQf191Hdx68NIjOpMfhLPtnfAqZdpHOHtzKlU0kOChYhXOwhxsF0ugeb4w34ZAIrJMo7nMLjFoTmS1Z';
    }
    if ($client_id!=""){
        $client_id ='1OLe3SQDnkAaa2bqByAf0aMDld9cxMjcwcHJ1akN';
    }
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://172.19.153.99:18000/oauth2/access_token/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('grant_type' => 'client_credentials','token_type' => 'jwt','client_id' => $client_id,'client_secret' => $secret),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $data = json_decode($response,true);
    return $data['access_token'];
}

function display_list_courses(){
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://172.19.153.99:18000/api/courses/v1/courses/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

// Decode the JSON data
$data = json_decode($response, true);

// Loop through each course and create a card
foreach ($data['results'] as $course) {
    echo '<div class="card">';
    echo '<img src="' . $course['media']['image']['raw'] . '" alt="' . $course['name'] . '">';
    echo '<h2>' . $course['name'] . '</h2>';
    echo '<p>' . $course['start_display'] . '</p>';
    echo '<a href="' . $course['blocks_url'] . '">Learn More</a>';
    echo '</div>';
}
?>

<style>
    /* Add CSS for responsive grid layout */
    .card {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px;
        text-align: center;
        background-color: #f9f9f9;
        display: inline-block;
        width: calc(33.33% - 20px); /* Adjust width as needed for responsive layout */
    }

    img {
        max-width: 100%;
        height: auto;
    }
</style><?php 
}