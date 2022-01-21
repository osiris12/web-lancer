<?php
include_once 'helpers.php';

if(isset($_POST['neighborhood']) && $_POST['neighborhood'] != '')
{
    $hood        = urlencode($_POST['neighborhood']);
    $keywords    = $_POST['keywords'];
    $no_website  = $_POST['website'];
    $api_key     = 'AIzaSyCDa6QBm2_sAunMD27rznV8y59LDSF1OUc';
    $url         = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=$keywords+in+$hood&radius=1000&key=$api_key";
    $result      = file_get_contents($url);
    $json_result = json_decode($result, true);
    $all_results = array();
    $places_data = array();
    if(array_key_exists('next_page_token', $json_result))
    {
        $new_token = $json_result['next_page_token'];
        $all_results[] = $json_result;
        getNextPage($new_token, $api_key, $all_results);
    }
    
    foreach($all_results as $places)
    {
        if($no_website == true)
        {
            foreach($places['results'] as $place)
            {
                $place_data = getPlaceData($place, $api_key);
                if($place_data[5] == '')
                    $places_data[] = $place_data;
            }
        }
        else
        {
            foreach($places['results'] as $place)
            {
                $place_data = getPlaceData($place, $api_key);
                if($place_data != false)
                {
                    $places_data[] = $place_data;
                }
            }
        }
    }

    if(empty($places_data))
    {
        echo "<h1>No results</h1>";exit;
    }
//    print_f($places_data);exit;
    downloadCSVFile($places_data);
//    print_f($places_data);exit;
}
exit;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Data Results</title>
    <style>
        .table{
            margin-top: 50px;
        }
    </style>
</head>
<body>
<br/>
<h1>Results Data</h1>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Website</th>
            <th scope="col">Contact Name</th>
            <th scope="col">Contact Number</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
    </tbody>
</table>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

