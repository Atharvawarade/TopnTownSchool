<?php

// Replace with your actual API key
$apiKey = "AIzaSyBEGcJMviEcWu5rbgc4FhGPU8r8OAgkTY0";

// Replace with your Blogger blog ID
$blogId = "5207560492914432337";

function getBlogPosts()
{
    global $apiKey, $blogId;

    $url = "https://www.googleapis.com/blogger/v3/blogs/" . $blogId . "/posts?key=" . $apiKey;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    $curlError = curl_error($curl);

    curl_close($curl);

    if ($curlError) {
        echo "Error: " . $curlError;
        return null;
    } else {
        $data = json_decode($response, true);
        return $data["items"] ?? null; // Extract posts from JSON response or null if not found
    }
}

// Example usage
$posts = getBlogPosts();

if ($posts) {
    // Include your HTML template file with post data
    include("blog_posts.html");
} else {
    echo "No blog posts found.";
}
