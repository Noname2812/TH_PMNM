var listForm = document.getElementsByTagName("form")
var arrayForm =[...listForm]

var nameForm =["login","forgotPass","createAncount","re-enterNewPassword"]
//
var listChoice = document.getElementsByClassName("choice")
var arrayChoie =[...listChoice]
//
function addClassHidden(){
    for (let i=0;i<arrayForm.length;i++){
        let show=document.getElementById(nameForm[i]+"")
        show.classList.add("hidden")
    }
}
function forgot() {
    addClassHidden()
    document.getElementById("forgotPass").classList.remove("hidden")
}
function createAncount(){
    addClassHidden()
    document.getElementById("createAncount").classList.remove("hidden")
    arrayChoie[0].classList.add("hidden")
    arrayChoie[1].classList.remove("hidden")
}
function creatNewPass(){
    addClassHidden()
    document.getElementById("re-enterNewPassword").classList.remove("hidden")
}
function login(){
    addClassHidden()
    document.getElementById("login").classList.remove("hidden")
}