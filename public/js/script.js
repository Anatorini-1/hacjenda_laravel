var sort = 'desc';
var search = '';
var url = window.location.search.substr(1);
var miasta = url.split('&');
var miasto = "";
var finished = location.href.indexOf('finished');
function logkey(){
document.addEventListener('keypress', pressed);
}
function pressed(e){
    if(e.code == "Enter"){
        Szukaj();
    }
}
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
        if(finished != -1){
            search = document.querySelector('#searchtxt').value;
            window.location.replace('http://127.0.0.1:8000/offers/finished/1?search=' + search + '&sort=' + sort);
        }else{
            search = document.querySelector('#searchtxt').value;
            window.location.replace('http://127.0.0.1:8000/offers/search/1?search=' + search + '&sort=' + sort);
            }
        }
    else{
        if(finished != -1){
            window.location.replace('http://127.0.0.1:8000/offers/finished/1?search=' + miasto + '&sort=' + sort);
        }else{
            window.location.replace('http://127.0.0.1:8000/offers/search/1?search=' + miasto + '&sort=' + sort);
        }
    }
}





