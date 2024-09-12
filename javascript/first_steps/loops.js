for(var i = 1;i<=5;i++){
    console.log(i)
}
console.log('Counting completed')


//Task 2

for(i=5;i>0;i--){
    console.log(i)
}
console.log("Countdown finished")


//Task 3
var i = 1
while(i<=5){
    console.log(i)
    i++
}
console.log('Counting completed')

//Task 4
var i = 5
while(i > 0){
    console.log(i)
    i--
}
console.log("Countdown finished")



//Condicional and loops

//Task 1

for(var i=1;i<11;i++){
    if(i == 1){
        console.log("Gold Medal")
    }else if(i == 2){
        console.log("Silver Medal")
    }else if(i == 3){
        console.log("Bronze Medal")
    }else{
        console.log(i)
    }
}

//Task 2


for(var i=1;i<11;i++){
    switch(i){
        case 1:
            console.log("Gold Medal")
            break
        case 2:
            console.log("Silver Medal")
            break
        case 3:
            console.log("Bronze Medal")
            break
        default:
            console.log(i)
    }
}