const URL = './resources/php/request.php'

async function fetchMAL(){
    const raw = await fetch(URL);
    const data = await raw.json();
    console.log(data)
    return raw;
}