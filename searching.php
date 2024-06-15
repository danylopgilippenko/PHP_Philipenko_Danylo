<?php
if(isset($_GET['search'])) {

    $search_query = urlencode($_GET['search']);
    $api_key = 'AIzaSyAw4LU74FumrcOiI18SWJU47wCLrFFdsgA';
    $cx = 'a61791b5629a04e73';

    $url = "https://www.googleapis.com/customsearch/v1?q={$search_query}&key={$api_key}&cx={$cx}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resultJson = curl_exec($ch);
    curl_close($ch);

    if ($resultJson === false) {
        echo 'Ошибка cURL: ' . curl_error($ch);
    } else {

        $search_results = json_decode($resultJson, true);

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2>My Browser</h2>
<form method="GET" action="">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" value=""><br><br>
    <input type="submit" value="Submit">
</form>

<?php

if (isset($search_results)) {

    foreach ($search_results['items'] as $item) {
        echo '<p><a href="' . $item['link'] . '">' . $item['title'] . '</a><br>';
        echo $item['snippet'] . '</p>';
    }
}
?>
</body>
</html>