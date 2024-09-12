var dairy = ['cheese', 'sour cream', 'milk', 'yogurt', 'ice cream', 'milkshake']

function logDairy(){
    for(var item of dairy){
        console.log(item)
    }
}

logDairy()

const animal = {
    
    canJump: true
    
};

console.log('-------------------------------')
const bird = Object.create(animal);
bird.canFly = true;
bird.hasFeathers = true;

function birdCan(){
        //only shows the objects itself keys
        for(let key of Object.keys(bird)){
            console.log(key+ ': '+ bird[key])
        }
    }
    
    birdCan()

console.log('-------------------------------')
function animalCan(){
    for(let key in bird){
        console.log(key+ ': '+bird[key])
    }
}

animalCan()