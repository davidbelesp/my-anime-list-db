 async function userFetch(username){
    const URL = `./resources/php/request.php?user=${username}`

    const raw = await fetch(URL);
    const data = await raw.json();
    console.log(data)
    return data;
}

async function fetchMAL(){
    const URL = './resources/php/request.php'

    const raw = await fetch(URL);
    const data = await raw.json();
    console.log(data)
    return data;
}