const fruits = ['kiwi','mango','apple','pear'];
function appendIndex(fruit, index) {
    console.log(`${index}. ${fruit}`)
}
fruits.forEach(appendIndex);

console.log('-------------------------')

const nums = [0,10,20,30,40,50];
nums.filter( function(num) {
    console.log( num > 20);
})
console.log('-------------------------')

nums.map( function(num) {
    console.log( num / 10 );
})


console.log('-------------------------')
const result = new Map();
const drone = {
    speed: 100,
    color: 'yellow'
}
const droneKeys = Object.keys(drone);
droneKeys.forEach( function(key) {
    result.set(key, drone[key])
})
console.log(result)


console.log('-------------------------')
let fruits2 = new Set()
fruits2.add('mango')
fruits2.add('banana')
fruits2.add('mango')
fruits2.add('apple')
console.log(fruits2)