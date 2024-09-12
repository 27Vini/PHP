var age = "a"
if(age >= 65){
    console.log("O senhor recebe sua renda da sua pensão")
}else if(age >= 18){
    console.log("Each month you get a salary")
}else if(age < 18){
    console.log("You get an allowance")
}else{
    console.log("Not a numerical value")
}

var day = "Monday"
switch(day){
    case "Monday":
        console.log("Studied Python")
        break
    case "Tuesday":
        console.log("Studied JS")
        break
    default:
        console.log("Day to happen")
}