/*
$(document).ready(function(){
    $('#profil_option li ul').hide();
    $('#profil_option li').hover(
        function(){$(this).children('ul').slideDown(400);},
        function(){$(this).children('ul').slideUp(400);}
    );
});
*/

//gestion du menu de navigation
const nav_bar = document.getElementById('nav_bar')
document.getElementById('show_menu').addEventListener('click', function(){
    try {
        nav_bar.style.display='block'
        document.getElementById('show_menu').style.display='none'
        document.getElementById('hide_menu').style.display='block'
    } catch (error) {
        console.log("Rien à afficher", error)
    }
    
})

menu = document.getElementById('num_menu').textContent
const path = menu.split('/');
menu = menu.replace('/','')
select(path[1])
function select(a)
{
    if (a == '') {
        a = 'seance'
    }
    document.getElementById('menu_'+a).style.backgroundColor='rgb(255, 236, 110)'
    document.getElementById('menu_'+a).style.color='black'
    document.getElementById('menu_'+a).style.fontWeight='bold'
}