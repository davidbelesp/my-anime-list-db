<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/css/style.css">
    <script src="./resources/javascript/main.js"></script>
    <script src="./resources/javascript/functions.js"></script>
    <link rel="icon" type="image/x-icon" href="./resources/images/MyAnimeList_Logo_black.png">
    <?php echo "<title>".$_GET["user"]."'s Profile</title>" ?>
</head>
<body>
    <div class="content">
        <div class="nav-bar">
            <img id="nav-pic" alt="user-picture">
            <ul>
                <li><a href="./index.html">Log out</a></li>
            </ul>
        </div>
        <div class="wrapper">

            <div class="profile box">
                <p id="name">-</p>
                <div class="profile-pic">
                    <img id="profile-pic" alt="user-picture">
                </div>
                <div class="user-info">
                    <div class="user-info">
                        <div class="tdata">
                            <p>Gender</p>
                            <p id="gender">-</p>
                        </div>
                        <div class="tdata">
                            <p>Joined</p>
                            <p id="joined">-</p>
                        </div>
                        <div class="tdata">
                            <p>Location</p>
                            <p id="location">-</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="stats box"> 

                <div id="manga-stats-table">
                    <p id="tableTitle">Manga Stats</p>
                    <div class="tdata">
                        <p id="dataname">Mean score</p>
                        <p id="manga-stats-meanscore"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">Hours Read</p>
                        <p id="manga-stats-hours"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">Volumes Read</p>
                        <p id="manga-stats-volumes"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">Chapters Read</p>
                        <p id="manga-stats-chapters"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">Pages Read</p>
                        <p id="manga-stats-pages"></p>
                    </div>
                </div>
                <div id="manga-status-table">
                    <p id="tableTitle">Manga Status</p>
                    <div class="tdata">
                        <p id="dataname">Completed</p>
                        <p id="manga-completed"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">Reading</p>
                        <p id="manga-reading"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">On Hold</p>
                        <p id="manga-onhold"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">Plan to read</p>
                        <p id="manga-plantoread"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">Total entries</p>
                        <p id="manga-total"></p>
                    </div>
                </div>
                <div id="anime-stats-table">
                    <p id="tableTitle">Anime Stats</p>
                    <div class="tdata">
                        <p id="dataname">Mean score</p>
                        <p id="anime-stats-meanscore"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">Hours Watched</p>
                        <p id="anime-stats-hours"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">Episodes Watched</p>
                        <p id="anime-stats-episodes"></p>
                    </div>
                </div>
                <div id="anime-status-table">
                    <p id="tableTitle">Anime Status</p>
                    <div class="tdata">
                        <p id="dataname">Completed</p>
                        <p id="anime-completed"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">Reading</p>
                        <p id="anime-watching"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">On Hold</p>
                        <p id="anime-onhold"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">Plan to watch</p>
                        <p id="anime-plantowatch"></p>
                    </div>
                    <div class="tdata">
                        <p id="dataname">Total entries</p>
                        <p id="anime-total"></p>
                    </div>
                </div>

            </div>
            <div class="m-list-div box">
                <div id="list-link">
                    <a href="./list.php">Manga List</a>
                </div>
                <div class="manga-list"></div>
            </div>
            <div class="a-list-div box">
                <div id="list-link">
                    <a href="./list.php">Anime List</a>
                </div>
                <div class="anime-list"></div>
            </div>
        </div>
    </div>
    
    
</body>
<script>
    setTimeout(() => {sideScroll([document.querySelector(".anime-list"),document.querySelector(".manga-list")])}, 0);
</script>
<?php 
echo "<script>setTimeout(() => {updatePage('".$_GET["user"]."')}, 0);</script>"
?>
</html>