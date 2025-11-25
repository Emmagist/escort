<?php
header("Content-Type: application/xml; charset=utf-8");

$base = "https://konjizone.com";

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Homepage
echo '<sitemap>';
echo '<loc>'.$base.'/sitemap-home.xml</loc>';
echo '<lastmod>'.date('Y-m-d').'</lastmod>';
echo '</sitemap>';

// Cities
echo '<sitemap>';
echo '<loc>'.$base.'/sitemap-cities.xml</loc>';
echo '<lastmod>'.date('Y-m-d').'</lastmod>';
echo '</sitemap>';

// Categories
echo '<sitemap>';
echo '<loc>'.$base.'/sitemap-categories.xml</loc>';
echo '<lastmod>'.date('Y-m-d').'</lastmod>';
echo '</sitemap>';

// Escort profiles (split if more than 50k)
$totalProfiles = Users::getTotalEscorts();
$batchSize = 50000;
for($i = 0; $i < ceil($totalProfiles / $batchSize); $i++){
    echo '<sitemap>';
    echo '<loc>'.$base.'/sitemap-escorts-'.$i.'.xml</loc>';
    echo '<lastmod>'.date('Y-m-d').'</lastmod>';
    echo '</sitemap>';
}

// Videos
$totalVideos = Users::getTotalVideos();
$batchSize = 50000;
for($i = 0; $i < ceil($totalVideos / $batchSize); $i++){
    echo '<sitemap>';
    echo '<loc>'.$base.'/sitemap-videos-'.$i.'.xml</loc>';
    echo '<lastmod>'.date('Y-m-d').'</lastmod>';
    echo '</sitemap>';
}

echo '</sitemapindex>';
