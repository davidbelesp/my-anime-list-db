 async function getList(type, username, offset = 0){
    if (!username || !type) return

    let params = "";

    params += `user=${username}`;
    type == "anime" ? params += "&type=anime" : 
    type == "manga" ? params += "&type=manga" : 
    console.log("No valid type defined on getting list")

    offset ? params += `&offset=${offset}` : ""

    const URL = `./resources/php/req-manager.php?${params}`
    
    const raw = await fetch(URL);
    const data = await raw.json();
    
    return data;
}

async function getFullList(type, username, NSFW = false){
    var list = []

    const teRaw = await fetch(`https://api.jikan.moe/v4/users/${username}/statistics`)
    const teJson = await teRaw.json()
    const totalEntries = teJson["data"][type]["total_entries"]

    const progressElement = document.querySelector("#progress")

    let items = await getList(type, username);
    let offset = 0;

    while (!!items.length){
        items = await getList(type, username, offset);
        items.forEach(element => {
            list.push(element)
        });
        offset +=20
        if(offset > totalEntries) offset = totalEntries
        progressElement.innerHTML = `Loading (${offset-20} / ${totalEntries})`
    }
    currentOptions = ["reading", "watching"]

    const completedList = list.filter(element => element["list_status"]["status"] == "completed")
    const currentList = list.filter(element => element["list_status"]["status"] == "reading" ||
                                               element["list_status"]["status"] == "watching")
    const onholdList = list.filter(element => element["list_status"]["status"] == "on_hold")
    const plantoList = list.filter(element => element["list_status"]["status"] == "plan_to_read" ||
                                              element["list_status"]["status"] == "plan_to_watch")
    const droppedList = list.filter(element => element["list_status"]["status"] == "dropped")
                     
    const FULL_LIST = {}
    
    FULL_LIST["total_entries"] = [...list]
    FULL_LIST["current"] = [...currentList]
    FULL_LIST["onhold"] = [...onholdList]
    FULL_LIST["dropped"] = [...droppedList]
    FULL_LIST["completed"] = [...completedList]
    FULL_LIST["planto"] = [...plantoList]

    console.log(FULL_LIST)

    return FULL_LIST;
}

async function getUserInfo(username){
    if(!username) return console.log("No username!")
    const URL = `https://api.jikan.moe/v4/users/${username}/full`

    const raw = await fetch(URL);
    const data = await raw.json();
    return data;
}
