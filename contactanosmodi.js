const oscuridad = document.querySelector(".lunain");

let header = document.querySelector("header");
window.addEventListener("scroll", () => {
    header.classList.toggle("shadow", window.scrollY > 0)
});

oscuridad.addEventListener("click",()=>{
    blognoche.classList.toggle("bodyoscuroo");
    barraxde.classList.toggle("barraoscura");
    iconocuando.classList.toggle("logonoche");
    contenido.classList.toggle("aboutdark1");
    contenido2.classList.toggle("aboutdark2");
    homenoche.classList.toggle("homenoche");
    itemnoche.classList.toggle("itemoscuro");
    footeroscuro.classList.toggle("foop");

});