<?php
// Read Chrome bookmarks
$bookmarksPath = $_SERVER['USERPROFILE'] . "C:\\Users\\hp\\AppData\\Local\\Google\\Chrome\\User Data\\Profile 1\\Bookmarks";
$bookmarks = [];

if (file_exists($bookmarksPath)) {
    $bookmarksData = file_get_contents($bookmarksPath);
    $bookmarksData = json_decode($bookmarksData, true);
    
    // Extract relevant data (you may need to adjust this depending on your bookmarks structure)
    foreach ($bookmarksData['roots']['bookmark_bar']['children'] as $bookmark) {
        $bookmarks[] = [
            'title' => $bookmark['name'],
            'url' => $bookmark['url']
        ];
    }
}

// Filter bookmarks based on query
$query = $_GET['q'] ?? '';
if (!empty($query)) {
    $bookmarks = array_filter($bookmarks, function($bookmark) use ($query) {
        return stripos($bookmark['title'], $query) !== false;
    });
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($bookmarks);
?>
