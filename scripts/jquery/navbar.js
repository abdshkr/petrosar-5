//navigationbar


      
        $(document).ready(window.onscroll = function() {scrollFunction()});
                 
       function scrollFunction() {
               if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
               document.getElementById("navigation-bar").style.paddingTop = "10px";
               document.getElementById("navigation-bar").style.transition = "0.3s";
               document.getElementById("navigation-bar").style.backgroundImage = "linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(26,111,176,0.5326331216080182) 35%, rgba(26,111,176,0.87156869583771) 100%)";
               document.getElementById("img-logo").src = "./img/LOGO2.png"
                           
               } else {
               document.getElementById("navigation-bar").style.paddingTop = "90px";
               document.getElementById("navigation-bar").style.transition = "0.3s";
               document.getElementById("navigation-bar").style.backgroundImage = "none";
               document.getElementById("img-logo").src = "./img/LOGO1.png"
                           
               }
       }




$(document).on('click',function(){
$('.collapse').collapse('hide');
})
