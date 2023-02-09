<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./resources/css/style.css">
    <script src="./resources/javascript/main.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="content">
        <div class="nav-bar">
            <ul>
                <li><a href="#">Link1</a></li>
                <li><a href="#">Link2</a></li>
                <li><a href="#">Link3</a></li>
                <li><a href="#">Link4</a></li>
            </ul>
            <img id="nav-pic"  alt="user-picture">
        </div>
        <div class="wrapper">

            <div class="profile box">
                <p id="name"></p>
                <div class="profile-pic">
                    <img id="profile-pic" alt="user-picture">
                </div>
                <div class="user-info">
                    <table class="user-info">
                        <tr>
                            <td>Gender</td>
                            <td id="gender"></td>
                        </tr>
                        <tr>
                            <td>Joined</td>
                            <td id="joined"></td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td id="location"></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="stats box"> 
                <div class="manga-stats">
                    <p>Manga Stats</p>
                    <table id="manga-stats-table">
                        <tr>
                            <td>Mean score</td>
                            <td id="manga-stats-meanscore"></td>
                        </tr>
                        <tr>
                            <td>Hours Read</td>
                            <td id="manga-stats-hours"></td>
                        </tr>
                        <tr>
                            <td>Volumes Read</td>
                            <td id="manga-stats-volumes"></td>
                        </tr>
                        <tr>
                            <td>Chapters Read</td>
                            <td id="manga-stats-chapters"></td>
                        </tr>
                        <tr>
                            <td>Pages Read</td>
                            <td id="manga-stats-pages"></td>
                        </tr>
                    </table>
                    <p>Manga Status</p>
                    <table id="manga-status-table">
                        <tr>
                            <td>Completed</td>
                            <td id="manga-completed"></td>
                        </tr>
                        <tr>
                            <td>Reading</td>
                            <td id="manga-reading"></td>
                        </tr>
                        <tr>
                            <td>On Hold</td>
                            <td id="manga-onhold"></td>
                        </tr>
                        <tr>
                            <td>Plan to read</td>
                            <td id="manga-plantoread"></td>
                        </tr>
                        <tr>
                            <td>Total entries</td>
                            <td id="manga-total"></td>
                        </tr>

                        
                    </table>
                </div>

                <div class="anime-stats">
                    <p>Anime Stats</p>
                    <table id="anime-stats-table">
                        <tr>
                            <td>Mean score</td>
                            <td id="anime-stats-meanscore"></td>
                        </tr>
                        <tr>
                            <td>Hours Watched</td>
                            <td id="anime-stats-hours"></td>
                        </tr>
                        <tr>
                            <td>Episodes Watched</td>
                            <td id="anime-stats-episodes"></td>
                        </tr>
                    </table>
                    <p>Anime Status</p>
                    <table id="anime-status-table">
                        <tr>
                            <td>Completed</td>
                            <td id="anime-completed"></td>
                        </tr>
                        <tr>
                            <td>Reading</td>
                            <td id="anime-reading"></td>
                        </tr>
                        <tr>
                            <td>On Hold</td>
                            <td id="anime-onhold"></td>
                        </tr>
                        <tr>
                            <td>Plan to watch</td>
                            <td id="anime-plantowatch"></td>
                        </tr>
                        <tr>
                            <td>Total entries</td>
                            <td id="anime-total"></td>
                        </tr>

                        
                    </table>
                </div>

            </div>
            <div class="manga-list box">
                MANGA LIST
            </div>
            <div class="anime-list box">
                ANIME LIST
            </div>
        </div>
    </div>
    
    <?php?>
</body>
<script>
    async function updatePage(username){
        const rawdata = await getUserInfo(username)
        const data = rawdata["data"]

        updateProfilePicture(data["images"]["webp"]["image_url"])
        updateProfileName(data["username"])
        updateProfileTable(data["gender"],
                           data["joined"],  
                           data["location"])

        updateMangaStats(data["statistics"]["manga"]["mean_score"],
                         data["statistics"]["manga"]["days_read"],
                         data["statistics"]["manga"]["volumes_read"],
                         data["statistics"]["manga"]["chapters_read"])

        updateMangaStatus()

        updateAnimeStats(data["statistics"]["anime"]["mean_score"],
                         data["statistics"]["anime"]["days_watched"],
                         data["statistics"]["anime"]["episodes_watched"])
    }



    function updateProfilePicture(src){
        const navImage = document.getElementById("nav-pic")
        const userImage = document.getElementById("profile-pic")

        navImage.src = src
        userImage.src = src
    }

    function updateProfileName(name){
        return document.getElementById("name").innerHTML = name
    }

    function updateProfileTable(gender,joined,location){
        const gendertext = document.getElementById("gender")
        const joinedtext = document.getElementById("joined")
        const locationtext = document.getElementById("location")

        if(!location) location="N/A";
        if(!gender) gender="N/A";
        if(!joined) joined="N/A"

        gendertext.innerHTML = gender
        joinedtext.innerHTML = joined.slice(0,10)
        locationtext.innerHTML = location
    }

    function updateMangaStats(meanScore,daysRead,volumes,chapters){
        const STATS_CONST = "manga-stats-"

        const meanText = document.getElementById(`${STATS_CONST}meanscore`)
        const hoursText = document.getElementById(`${STATS_CONST}hours`)
        const volumesText = document.getElementById(`${STATS_CONST}volumes`)
        const chaptersText = document.getElementById(`${STATS_CONST}chapters`)
        const pagesText = document.getElementById(`${STATS_CONST}pages`)

        meanText.innerHTML = meanScore;
        hoursText.innerHTML = Math.floor(daysRead*24*100)/100
        volumesText.innerHTML = volumes
        chaptersText.innerHTML = chapters
        pagesText.innerHTML = Math.floor(chapters*(61.96/2))

    }

    function updateAnimeStats(meanScore,daysWatched,episodes){
        const STATS_CONST = "anime-stats-"

        const meanText = document.getElementById(`${STATS_CONST}meanscore`)
        const hoursText = document.getElementById(`${STATS_CONST}hours`)
        const episodesText = document.getElementById(`${STATS_CONST}episodes`)

        meanText.innerHTML = meanScore
        hoursText.innerHTML = Math.floor(daysWatched*24*100)/100
        episodesText.innerHTML = episodes

    }

    function updateMangaStatus(){
        
    }
</script>
<script>
    setTimeout(() => {updatePage("akinadb")}, 0);
</script>
</html>