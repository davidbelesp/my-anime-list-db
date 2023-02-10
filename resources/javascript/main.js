 async function getList(type, username){
    if (!username || !type) return

    let params = "";

    username ? params += `user=${username}` : "";
    type == "anime" ? params += "&type=anime" : 
    type == "manga" ? params += "&type=manga" : 
    console.log("No valid type defined")

    const URL = `./resources/php/req-manager.php?${params}`

    const raw = await fetch(URL);
    const data = await raw.json();

    return data;
}

async function getAnimeList(username){
    let params;
    if (username) params = `user=${username}`;
    const URL = `./resources/php/req-manager.php?${params}`

    const raw = await fetch(URL);
    const data = await raw.json();

    return data;
}

async function getUserInfo(username){
    if(!username) return console.log("No username!")
    const URL = `https://api.jikan.moe/v4/users/${username}/full`

    const raw = await fetch(URL);
    const data = await raw.json();
    return data;
}
