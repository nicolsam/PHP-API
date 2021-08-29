let url = "http://localhost/PHP-API/public/api/user/";

fetch(url)
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.log('Erro no cliente: ' + error.message);
    })