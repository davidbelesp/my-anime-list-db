 async function userFetch(username){
    let params;
    if (username) params = `user=${username}`;
    const URL = `./resources/php/req-manager.php?${params}`

    const raw = await fetch(URL);
    const data = await raw.json();
    console.log(data)
    return data;
}