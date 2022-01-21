<?php
function print_f($arr)
{
    echo "<pre>" . print_r($arr, true) . "</pre>";
}

function tokenExists($results)
{
    if(isset($results['next_page_token'] ))
    {
        return $results['next_page_token'];
    }
    return false;
}

function getNextPage($token, $api_key, &$all_results): int
{
    if($token == false)
    {
        return 1;
    }
    sleep(3);
    $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?pagetoken=$token&key=$api_key";
    $results = json_decode(file_get_contents($url), true);
    $all_results[] = $results;
    $new_token = tokenExists($results);
    return getNextPage($new_token, $api_key, $all_results);
}

function getPlaceData($place, $api_key): array
{
    $place_id = $place['place_id'];
    $place_url = "https://maps.googleapis.com/maps/api/place/details/json?placeid=$place_id&key=$api_key";
    return createDataArray(json_decode(file_get_contents($place_url), true));
}

function createDataArray($data): array
{
    $data_array = array();
    $data_array[] = $data['result']['name'];
    $data_array[] = $data['result']['formatted_address'];
    $data_array[] = $data['result']['formatted_phone_number'];
    $data_array[] = $data['result']['rating'];
    $data_array[] = $data['result']['user_ratings_total'];
    $data_array[] = $data['result']['website'];
    $data_array[] = $data['result']['url'];
    $data_array[] = $data['result']['opening_hours']['weekday_text'];
    return $data_array;
}

function downloadCSVFile($data)
{
    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    // create a file pointer connected to the output stream
    $file = fopen('php://output', 'w');
    // output the column headings
    fputcsv($file, array('name', 'address', 'phone_number', 'overall_rating', 'total_ratings', 'website', 'url'));
    populateCSVFile($file, $data);
}

function populateCSVFile($file, $data)
{
    foreach($data as $place)
    {
        $place_data = array(
            $place[0],
            $place[1],
            $place[2],
            $place[3],
            $place[4],
            $place[5],
            $place[6]
        );
        fputcsv($file, $place_data);
    }
}