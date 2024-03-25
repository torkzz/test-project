<?php


function sortCars($cars, $key, $sortOrder = 'asc')
{
    usort($cars, function ($a, $b) use ($key, $sortOrder) {
        if ($sortOrder === 'asc') {
            return $a[$key] <=> $b[$key];
        } else {
            return $b[$key] <=> $a[$key];
        }
    });
    return $cars;
}

// Retrieve the JSON data from the request body
$request_body = file_get_contents('php://input');
$request_data = json_decode($request_body, true);

// Retrieve the sort order from the query string
$sortOrder = $_GET['sort'] ?? 'asc';

// Sort the cars array
$sortedCars = sortCars($request_data, 'price', $sortOrder);

// Set response headers
header('Content-Type: application/json');

// Output JSON response
echo json_encode($sortedCars);
