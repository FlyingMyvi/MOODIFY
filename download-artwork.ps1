param(
    [int]$SongLimit = 0,
    [int]$ArtistLimit = 0
)

$ErrorActionPreference = 'Stop'

$base = Join-Path $PSScriptRoot 'MOODIFY_IMAGES'
$songsDir = Join-Path $base 'songs'
$artistsDir = Join-Path $base 'artists'

New-Item -ItemType Directory -Force -Path $base, $songsDir, $artistsDir | Out-Null

$songs = @(
    @{ Title = 'As It Was'; Artist = 'Harry Styles'; File = '01_as_it_was.jpg' },
    @{ Title = 'I Think He Knows'; Artist = 'Taylor Swift'; File = '02_i_think_he_knows.jpg' },
    @{ Title = 'All Too Well (10 Minute Version)'; Artist = 'Taylor Swift'; File = '03_all_too_well_10_min.jpg' },
    @{ Title = 'Dancing On My Own'; Artist = 'Robyn'; File = '04_dancing_on_my_own.jpg' },
    @{ Title = 'Quit Playing Games (With My Heart)'; Artist = 'Backstreet Boys'; File = '05_quit_playing_games.jpg' },
    @{ Title = 'The First Snow'; Artist = 'EXO'; File = '06_the_first_snow.jpg' },
    @{ Title = 'Just Us 2'; Artist = 'EXO-SC'; File = '07_just_us_2.jpg' },
    @{ Title = 'Psycho'; Artist = 'Red Velvet'; File = '08_psycho_red_velvet.jpg' },
    @{ Title = "So Let's Love"; Artist = 'DAY6'; File = '09_so_lets_love.jpg' },
    @{ Title = 'Blind'; Artist = 'ENHYPEN'; File = '10_blind.jpg' },
    @{ Title = 'Like I Want You'; Artist = 'Giveon'; File = '11_like_i_want_you.jpg' },
    @{ Title = "I Swear I'll Never Leave Again"; Artist = 'keshi'; File = '12_i_swear_ill_never_leave_again.jpg' },
    @{ Title = 'Best Part'; Artist = 'Daniel Caesar H.E.R.'; File = '13_best_part.jpg' },
    @{ Title = 'Folded'; Artist = 'Kehlani'; File = '14_folded.jpg' },
    @{ Title = 'Open Arms'; Artist = 'SZA Travis Scott'; File = '15_open_arms.jpg' },
    @{ Title = 'Ingat'; Artist = 'Alyph'; File = '16_ingat.jpg' },
    @{ Title = 'I KNOW ?'; Artist = 'Travis Scott'; File = '17_i_know.jpg' },
    @{ Title = 'Lose My Mind'; Artist = 'Don Toliver'; File = '18_lose_my_mind.jpg' },
    @{ Title = 'Psycho'; Artist = 'Post Malone Ty Dolla Sign'; File = '19_psycho_post_malone.jpg' },
    @{ Title = 'luther'; Artist = 'Kendrick Lamar SZA'; File = '20_luther.jpg' }
)

$artists = @(
    @{ Name = 'The Weeknd'; File = '01_the_weeknd.jpg' },
    @{ Name = 'Tate McRae'; File = '02_tate_mcrae.jpg' },
    @{ Name = 'JENNIE'; File = '03_jennie.jpg' },
    @{ Name = 'Olivia Rodrigo'; File = '04_olivia_rodrigo.jpg' }
)

function Find-Artwork([string]$Term) {
    $api = 'https://itunes.apple.com/search?term=' + [uri]::EscapeDataString($Term) + '&media=music&entity=song&limit=20&country=MY'

    try {
        $data = Invoke-RestMethod -Uri $api -Headers @{
            'User-Agent' = 'MOODIFY student project image downloader'
        } -TimeoutSec 30
    } catch {
        return $null
    }

    if (-not $data.results) { return $null }

    $titlePart = ($Term -split ' ')[0].ToLowerInvariant()
    foreach ($item in $data.results) {
        $hay = ("$($item.trackName) $($item.artistName)").ToLowerInvariant()
        if ($hay.Contains($titlePart) -and $item.artworkUrl100) {
            return $item.artworkUrl100.Replace('100x100bb', '600x600bb')
        }
    }

    foreach ($item in $data.results) {
        if ($item.artworkUrl100) {
            return $item.artworkUrl100.Replace('100x100bb', '600x600bb')
        }
    }

    return $null
}

function Save-Artwork([string]$Term, [string]$Path) {
    $url = Find-Artwork $Term
    if (-not $url) { return $false }

    try {
        Invoke-WebRequest -Uri $url -OutFile $Path -UseBasicParsing -TimeoutSec 30
        if ((Get-Item -LiteralPath $Path).Length -gt 1000) { return $true }
        Remove-Item -LiteralPath $Path -Force
        return $false
    } catch {
        if (Test-Path -LiteralPath $Path) { Remove-Item -LiteralPath $Path -Force }
        return $false
    }
}

$songList = if ($SongLimit -gt 0) { @($songs | Select-Object -First $SongLimit) } else { $songs }
$artistList = if ($ArtistLimit -gt 0) { @($artists | Select-Object -First $ArtistLimit) } else { $artists }

$songList = @($songList)
$artistList = @($artistList)

$ok = 0
$total = $songList.Count + $artistList.Count

foreach ($song in $songList) {
    $term = "$($song.Title) $($song.Artist)"
    $path = Join-Path $songsDir $song.File
    $saved = Save-Artwork $term $path
    "{0} - {1}" -f $song.File, $(if ($saved) { 'SAVED' } else { 'NOT FOUND' })
    if ($saved) { $ok++ }
}

foreach ($artist in $artistList) {
    $path = Join-Path $artistsDir $artist.File
    $saved = Save-Artwork $artist.Name $path
    "{0} - {1}" -f $artist.File, $(if ($saved) { 'SAVED' } else { 'NOT FOUND' })
    if ($saved) { $ok++ }
}

"Finished: $ok / $total images saved."
"Folder: $base"
