var sort = 'desc';
var search = '';
var url = window.location.search.substr(1);
var miasta = url.split('&');
var miasto = "";
console.log(miasto);
function OrderAsc(){
    miasto = miasta[0].split('=')[1];
    sort = 'asc';
    Szukaj(miasto);
}
function OrderDesc(){
    miasto = miasta[0].split('=')[1];
    sort = 'desc'
    Szukaj(miasto);
}
function Szukaj(miasto){
    if(miasto=="" || miasto==undefined){
        search = document.querySelector('#searchtxt').value;
        window.location.replace('http://127.0.0.1:8000/offers/search/1?search=' + search + '&sort=' + sort);
    }
    else{
        window.location.replace('http://127.0.0.1:8000/offers/search/1?search=' + miasto + '&sort=' + sort);
    }
}






var zlecenie_stale = 1;
function zlecenia_stale(x) {
    zlecenie_stale *= -1;
    console.log(document.querySelector('#czestotliwosc').style);
    if(zlecenie_stale == 1){
        document.querySelector('#czestotliwosc').style.display = 'none';
        document.querySelector('#czestotliwosc').innerHTML = "";
    }
    else{
        document.querySelector('#czestotliwosc').style.display = 'inline';
        document.querySelector('#czestotliwosc').innerHTML = "<input type='text' name='czestotliwosc' placeholder='czestotliwosc'><br />";


    }
}