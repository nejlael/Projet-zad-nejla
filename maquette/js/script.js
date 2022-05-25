$(document).ready(function(){
    $("#inscription").hide();
});//CHARGE LE DOCUMENT ET CACHE MA DIV INSCRIPTION

const menu = document.querySelector('#menu');
const popup = document.querySelector('.popup');
//décalaration des variables pour le menu

const connexion = document.getElementById('connexion');
const inscription = document.getElementById('inscription');
const btnconnexion = document.getElementById('btnconnexion');
const btninscription = document.getElementById('btninscription');
//déclaration des variables pour l'inscription et connexion

menu.addEventListener("click" , (e) => {
    if (popup.style.visibility === "visible"){
    popup.style.visibility = "hidden";
} else {
    popup.style.visibility = "visible";
}
});

    
btnconnexion.addEventListener('click', function(){
    $("#inscription").hide();
    $("#connexion").show();
});

btninscription.addEventListener('click', function(){
    $("#connexion").hide();
    $("#inscription").show();
});