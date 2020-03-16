function run(){
    var panda1 = document.getElementById("panda1"),
        panda2 = document.getElementById("panda2");
        
     if(panda1.style.display == "block" ){
        panda1.style.display = "none";
        panda2.style.display = "block";
     }else{
        panda1.style.display = "block";
        panda2.style.display = "none";

     }
}


