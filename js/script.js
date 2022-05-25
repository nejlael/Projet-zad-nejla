$(document).ready(function () {
    const menu = document.querySelector('#menu');
    const popup = document.querySelector('.popup');
    //décalaration des variables pour le menu
    //déclaration des variables pour l'inscription et connexion

    menu.addEventListener("click", (e) => {
        if (popup.style.visibility === "visible") {
            popup.style.visibility = "hidden";
        } else {
            popup.style.visibility = "visible";
        }
    });
});

