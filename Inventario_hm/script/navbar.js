const logo=document.getElementById("logo");
const barraLateral=document.querySelector(".barra-lateral");
const spans=document.querySelectorAll("span");
const marginlogo=document.querySelector(".logonav");
const oscuro=document.querySelector(".switch");
const circulo=document.querySelector(".circulo");

oscuro.addEventListener("click",()=>{
    let body=document.body;
    body.classList.toggle("oscuro");
    circulo.classList.toggle("prendido")
});
logo.addEventListener("click",()=>{
    barraLateral.classList.toggle("mini-barra-lateral");
    marginlogo.classList.toggle("logomini");
    
    spans.forEach((span)=>{
        span.classList.toggle("oculto");
    });
});