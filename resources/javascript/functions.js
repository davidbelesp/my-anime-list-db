function sideScroll(elements){
    const sideScroll = elements

    sideScroll.forEach(element => {
        element.addEventListener("wheel", (event) => {
            event.preventDefault()
            console.log(event.deltaY)
            if(event.deltaY > 0){
                element.scrollLeft += 400;
            } else {
                element.scrollLeft -= 400;
            }
        })
    })
}

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

function logout(){
    localStorage.removeItem("username")
    location.href = "./index.html"
}