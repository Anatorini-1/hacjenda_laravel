function Szukaj(){
    search = document.querySelector('#searchtxt').value;
    window.location.replace('http://127.0.0.1:8000/offers/search/1?search=' + search);
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