<?php
/*
 MOODIFY image downloader
 1. Put this file inside your moodify folder (same folder as index.php).
 2. Open http://localhost/moodify/download_moodify_images.php
 3. Wait until it says DONE. Images will be saved in MOODIFY_IMAGES/.
 Album artwork is retrieved from Apple's iTunes Search API.
*/

set_time_limit(180);
header("Content-Type: text/html; charset=utf-8");

$base = __DIR__ . DIRECTORY_SEPARATOR . "MOODIFY_IMAGES";
$songsDir = $base . DIRECTORY_SEPARATOR . "songs";
$artistsDir = $base . DIRECTORY_SEPARATOR . "artists";

foreach ([$base, $songsDir, $artistsDir] as $dir) {
    if (!is_dir($dir)) mkdir($dir, 0777, true);
}

$songs = [
    ["As It Was", "Harry Styles", "01_as_it_was.jpg"],
    ["I Think He Knows", "Taylor Swift", "02_i_think_he_knows.jpg"],
    ["All Too Well (10 Minute Version)", "Taylor Swift", "03_all_too_well_10_min.jpg"],
    ["Dancing On My Own", "Robyn", "04_dancing_on_my_own.jpg"],
    ["Quit Playing Games (With My Heart)", "Backstreet Boys", "05_quit_playing_games.jpg"],
    ["The First Snow", "EXO", "06_the_first_snow.jpg"],
    ["Just Us 2", "EXO-SC", "07_just_us_2.jpg"],
    ["Psycho", "Red Velvet", "08_psycho_red_velvet.jpg"],
    ["So Let's Love", "DAY6", "09_so_lets_love.jpg"],
    ["Blind", "ENHYPEN", "10_blind.jpg"],
    ["Like I Want You", "Giveon", "11_like_i_want_you.jpg"],
    ["I Swear I'll Never Leave Again", "keshi", "12_i_swear_ill_never_leave_again.jpg"],
    ["Best Part", "Daniel Caesar H.E.R.", "13_best_part.jpg"],
    ["Folded", "Kehlani", "14_folded.jpg"],
    ["Open Arms", "SZA Travis Scott", "15_open_arms.jpg"],
    ["Ingat", "Alyph", "16_ingat.jpg"],
    ["I KNOW ?", "Travis Scott", "17_i_know.jpg"],
    ["Lose My Mind", "Don Toliver", "18_lose_my_mind.jpg"],
    ["Psycho", "Post Malone Ty Dolla Sign", "19_psycho_post_malone.jpg"],
    ["luther", "Kendrick Lamar SZA", "20_luther.jpg"]
];

$artists = [
    ["The Weeknd", "01_the_weeknd.jpg"],
    ["Tate McRae", "02_tate_mcrae.jpg"],
    ["JENNIE", "03_jennie.jpg"],
    ["Olivia Rodrigo", "04_olivia_rodrigo.jpg"]
];

function getUrl($url) {
    $context = stream_context_create([
        "http" => ["timeout" => 20, "user_agent" => "MOODIFY student project image downloader"],
        "ssl" => ["verify_peer" => true, "verify_peer_name" => true]
    ]);
    return @file_get_contents($url, false, $context);
}

function findArtwork($term) {
    $api = "https://itunes.apple.com/search?term=" . rawurlencode($term) . "&media=music&entity=song&limit=20&country=MY";
    $json = getUrl($api);
    if ($json === false) return false;
    $data = json_decode($json, true);
    if (empty($data["results"])) return false;

    // Prefer an exact-ish title/artist match, otherwise use the first result.
    $wanted = mb_strtolower($term);
    foreach ($data["results"] as $item) {
        $hay = mb_strtolower(($item["trackName"] ?? "") . " " . ($item["artistName"] ?? ""));
        $titlePart = mb_strtolower(explode(" ", $term)[0]);
        if (strpos($hay, $titlePart) !== false && !empty($item["artworkUrl100"])) {
            return str_replace("100x100bb", "600x600bb", $item["artworkUrl100"]);
        }
    }
    foreach ($data["results"] as $item) {
        if (!empty($item["artworkUrl100"])) {
            return str_replace("100x100bb", "600x600bb", $item["artworkUrl100"]);
        }
    }
    return false;
}

function saveArtwork($term, $path) {
    $url = findArtwork($term);
    if (!$url) return false;
    $bytes = getUrl($url);
    if ($bytes === false || strlen($bytes) < 1000) return false;
    return file_put_contents($path, $bytes) !== false;
}

echo "<h2>MOODIFY image downloader</h2><p>Downloading original store artwork from Apple iTunes...</p><ol>";

$ok = 0;
foreach ($songs as $song) {
    [$title, $artist, $filename] = $song;
    $term = $title . " " . $artist;
    $saved = saveArtwork($term, $songsDir . DIRECTORY_SEPARATOR . $filename);
    echo "<li>" . htmlspecialchars($filename) . " â " . ($saved ? "SAVED" : "NOT FOUND") . "</li>";
    if ($saved) $ok++;
}

echo "</ol><h3>Artist spotlight artwork</h3><ol>";
foreach ($artists as $artist) {
    [$name, $filename] = $artist;
    $saved = saveArtwork($name, $artistsDir . DIRECTORY_SEPARATOR . $filename);
    echo "<li>" . htmlspecialchars($filename) . " â " . ($saved ? "SAVED" : "NOT FOUND") . "</li>";
    if ($saved) $ok++;
}
echo "</ol><p><strong>Finished: " . $ok . " / 24 images saved.</strong></p>";
echo "<p>Folder: MOODIFY_IMAGES/songs and MOODIFY_IMAGES/artists</p>";
echo "<p>Note: artist spotlight files are official album/track artwork returned for that artist, not portrait photographs. The 4 genre cards and hero background can keep the image URLs already in your original website CSS.</p>";
echo "<p>After downloading, send the whole MOODIFY_IMAGES folder to your teammate. You can delete this PHP downloader afterward.</p>";