var sort = 'desc';
var search = '';
var url = window.location.search.substr(1);
var miasta = url.split('&');
var miasto = "";
var finished = location.href.indexOf('finished');
var sitee = location.href;
console.log(sitee);
var site_url = 'https://srogiehacjendy.com/';
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
    if(miasta.length>=3){
    numer_praca = miasta[2].split('=')[1];}
    sort = 'asc';
    Szukaj(miasto);
}
function OrderDesc(){
    miasto = miasta[0].split('=')[1];
    if(miasta.length>=3){
        numer_praca = miasta[2].split('=')[1];}
    sort = 'desc'
    Szukaj(miasto);
}

function Szukaj(miasto){
    if(miasta.length>=3)
        numer_praca = miasta[2].split('=')[1];
    else
        numer_praca="";
    var cena_od = document.querySelector('#cena_od').value;
    var cena_do = document.querySelector('#cena_do').value;
    if(cena_do == undefined){
        cena_do = 0;
    }
    if(cena_od == undefined){
        cena_od = 0;
    }
    var praca = document.querySelector('#praca-list').value;
    if(numer_praca != undefined){
        if(praca == 'Mycie Okien' || praca == 'mycie okien' || praca == 'Mycie okien' || praca == 'mycie Okien')
            numer_praca = 1;
        else if(praca == 'Mycie Auta' || praca == 'mycie Auta' || praca == 'Mycie auta' || praca == 'mycie auta')
            numer_praca = 2;
        else if(praca == 'Odkurzanie' || praca == 'odkurzanie')
            numer_praca = 3;
        else if(praca == 'Zcieranie kurzu' || praca == 'zcieranie kurzu' || praca == 'Zcieranie Kurzu' || praca == 'zcieranie Kurzu')
            numer_praca = 4;
        else if(praca == 'Mycie Podłóg' || praca == 'mycie Podłóg' || praca == 'mycie podłóg' || praca == 'Mycie podłóg')
            numer_praca = 5;
        else if(praca == 'Sprzątanie Łazienki' || praca == 'sprzątanie łazienki' || praca == 'Sprzątanie łazienki' || praca == 'sprzątanie Łazienki')
            numer_praca = 6;
        }else if(praca == ""){
            numer_praca = ""
        }
    if(numer_praca != undefined){
        search = document.querySelector('#searchs').value;
        if(finished != -1){
            window.location.replace(site_url + 'offers/finished/1?search=' + search + '&sort=' + sort + '&np=' + numer_praca + '&cenaod=' + cena_od + '&cenado=' + cena_do);
        }else{
            window.location.replace(site_url + 'offers/search/1?search=' + search + '&sort=' + sort + '&np=' + numer_praca + '&cenaod=' + cena_od + '&cenado=' + cena_do);
        }
    }else if(miasto=="" || miasto==undefined){
        search = document.querySelector('#searchs').value;
        if(finished != -1){
            window.location.replace(site_url + 'offers/finished/1?search=' + search + '&sort=' + sort + '&cenaod=' + cena_od + '&cenado=' + cena_do);
        }else{
            window.location.replace(site_url + 'offers/search/1?search=' + search + '&sort=' + sort + '&cenaod=' + cena_od + '&cenado=' + cena_do);
            }
        }
    else{
        if(finished != -1){
            window.location.replace(site_url + 'offers/finished/1?search=' + miasto + '&sort=' + sort + '&cenaod=' + cena_od + '&cenado=' + cena_do);
        }else{
            window.location.replace(site_url + 'offers/search/1?search=' + miasto + '&sort=' + sort + '&cenaod=' + cena_od + '&cenado=' + cena_do);
        }
    }
}





