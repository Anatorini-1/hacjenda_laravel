var sort = 'desc';
var search = '';
var url = window.location.search.substr(1);
var miasta = url.split('&');
var miasto = "";
var finished = location.href.indexOf('finished');
var sitee = location.href;
console.log(sitee);
var site_url = 'http://127.0.0.1:8000/';
var numer_praca = 0;
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
    numer_praca = miasta[2].split('=')[1];
    sort = 'asc';
    Szukaj(miasto);
}
function OrderDesc(){
    miasto = miasta[0].split('=')[1];
    numer_praca = miasta[2].split('=')[1];
    sort = 'desc'
    Szukaj(miasto);
}

function Szukaj(miasto){
    var praca = document.querySelector('#praca-list').value;
    if(numer_praca == 0){
        if(praca == 'Mycie Okien' || praca == 'mycie okien' || praca == 'Mycie okien' || praca == 'mycie Okien')
            numer_praca = 1;
        if(praca == 'Mycie Auta' || praca == 'mycie Auta' || praca == 'Mycie auta' || praca == 'mycie auta')
            numer_praca = 2;
        if(praca == 'Odkurzanie' || praca == 'odkurzanie')
            numer_praca = 3;
        if(praca == 'Zcieranie kurzu' || praca == 'zcieranie kurzu' || praca == 'Zcieranie Kurzu' || praca == 'zcieranie Kurzu')
            numer_praca = 4;
        if(praca == 'Mycie Podłóg' || praca == 'mycie Podłóg' || praca == 'mycie podłóg' || praca == 'Mycie podłóg')
            numer_praca = 5;
        if(praca == 'Sprzątanie Łazienki' || praca == 'sprzątanie łazienki' || praca == 'Sprzątanie łazienki' || praca == 'sprzątanie Łazienki')
            numer_praca = 6;
    }
    if(numer_praca != 0){
        search = document.querySelector('#searchs').value;
        window.location.replace(site_url + 'offers/search/1?search=' + search + '&sort=' + sort + '&np=' + numer_praca);
        }
    else if(miasto=="" || miasto==undefined){
        if(finished != -1){
            search = document.querySelector('#searchs').value;
            window.location.replace(site_url + 'offers/finished/1?search=' + search + '&sort=' + sort);
        }else{
            search = document.querySelector('#searchs').value;
            window.location.replace(site_url + 'offers/search/1?search=' + search + '&sort=' + sort);
            }
        }
    else{
        if(finished != -1){
            window.location.replace(site_url + 'offers/finished/1?search=' + miasto + '&sort=' + sort);
        }else{
            window.location.replace(site_url + 'offers/search/1?search=' + miasto + '&sort=' + sort);
        }
    }
}





