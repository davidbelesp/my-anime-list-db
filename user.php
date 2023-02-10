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
            <img id="nav-pic" alt="user-picture">
            <ul>
                <li><a href=""">Log out</a></li>
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
            <div class="manga-list box"></div>
            <div class="anime-list box"></div>
        </div>
    </div>
    
    <?php?>
</body>
<script>
    async function updatePage(username){
        const rawdata = await getUserInfo(username)
        const data = rawdata["data"]

        data["manga-list"] = await getList("manga",username)
        data["anime-list"] = await getList("anime",username)

        updateProfilePicture(data["images"]["webp"]["image_url"])
        updateProfileName(data["username"]) 
        updateProfileTable(data["gender"],
                           data["joined"],  
                           data["location"])

        mangaStats = data["statistics"]["manga"];
        animeStats = data["statistics"]["anime"]

        updateMangaStats(mangaStats["mean_score"],
                         mangaStats["days_read"],
                         mangaStats["volumes_read"],
                         mangaStats["chapters_read"])

        updateMangaStatus(mangaStats["completed"],
                          mangaStats["reading"],
                          mangaStats["on_hold"],
                          mangaStats["plan_to_read"],
                          mangaStats["total_entries"])

        updateAnimeStats(animeStats["mean_score"],
                         animeStats["days_watched"],
                         animeStats["episodes_watched"])

        updateAnimeStatus(animeStats["completed"],
                          animeStats["watching"],
                          animeStats["on_hold"],
                          animeStats["plan_to_watch"],
                          animeStats["total_entries"])

        updateList("manga",data["manga-list"])
        updateList("anime",data["anime-list"])

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

    function updateMangaStatus(completed,reading,onhold,plantoread,totalEntries){
        const STATS_CONST = "manga-"

        const completedNumber = document.getElementById(`${STATS_CONST}completed`)
        const readingNumber = document.getElementById(`${STATS_CONST}reading`)
        const onholdNumber = document.getElementById(`${STATS_CONST}onhold`)
        const plantoreadNumber = document.getElementById(`${STATS_CONST}plantoread`)
        const totalNumber = document.getElementById(`${STATS_CONST}total`)

        completedNumber.innerHTML = completed
        readingNumber.innerHTML = reading
        onholdNumber.innerHTML = onhold
        plantoreadNumber.innerHTML = plantoread
        totalNumber.innerHTML = totalEntries
    }

    function updateAnimeStatus(completed,watching,onhold,plantowatch,totalEntries){
        const STATS_CONST = "anime-"

        const completedNumber = document.getElementById(`${STATS_CONST}completed`)
        const watchingNumber = document.getElementById(`${STATS_CONST}watching`)
        const onholdNumber = document.getElementById(`${STATS_CONST}onhold`)
        const plantowatchNumber = document.getElementById(`${STATS_CONST}plantowatch`)
        const totalNumber = document.getElementById(`${STATS_CONST}total`)

        completedNumber.innerHTML = completed
        watchingNumber.innerHTML = watching
        onholdNumber.innerHTML = onhold
        plantowatchNumber.innerHTML = plantowatch
        totalNumber.innerHTML = totalEntries
    }

    function updateList(type, list){
        const parentDiv = document.querySelector(`.${type}-list`)
        
        
        Object.keys(list).forEach((key)=>{
            const image = list[key]["node"]["main_picture"]["medium"]

            const cardDiv = document.createElement("div")
            cardDiv.classList.add("card")
            cardDiv.style = `--image:url(${image})`

            const cardInfo = document.createElement("div")
            cardInfo.classList.add("cardInfo")

            const cardTitle = document.createElement("p")
            cardTitle.setAttribute("id", "cardTitle")
            cardTitle.innerHTML = list[key]["node"]["title"]

            cardInfo.appendChild(cardTitle)
            cardDiv.appendChild(cardInfo)
            parentDiv.appendChild(cardDiv)
        })
    }   

</script>
<script>
    setTimeout(() => {updatePage("akinadb")}, 0);
</script>
</html>