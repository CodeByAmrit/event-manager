<?php
// Define the base directory for the project
$baseDir = __DIR__;

// Define the route handling logic
$requestedUri = $_SERVER['REQUEST_URI'];

// Clean the URI (remove query parameters if any)
$requestedUri = strtok($requestedUri, '?');

// Define routing rules
switch ($requestedUri) {
    case '/': // Default route (root)
        include $baseDir . '/pages/index.html';
        break;

    case '/about': // Example route for another page
        include $baseDir . '/pages/aboutus.html';
        break;
    case '/contact': // Example route for another page
        include $baseDir . '/pages/contactus.html';
        break;
    case '/gallery': // Example route for another page
        include $baseDir . '/pages/gallery.html';
        break;
    case '/review': // Example route for another page
        include $baseDir . '/pages/review.html';
        break;
    case '/dashboard': // Example route for another page
        include $baseDir . '/dashboard.php';
        break;

    default:
        // Handle 404 - File Not Found
        http_response_code(404);
        echo "404 Not Found";
        break;
}
