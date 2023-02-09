 async function getMangaList(username){
    let params;
    if (username) params = `user=${username}`;
    const URL = `./resources/php/req-manager.php?${params}`

    const raw = await fetch(URL);
    const data = await raw.json();
    console.log(data)
    return data;
}

async function getUserInfo(username){
    if(!username) return console.log("No username!")
    const URL = `https://api.jikan.moe/v4/users/${username}/full`

    const raw = await fetch(URL);
    const data = await raw.json();
    return data;
}
