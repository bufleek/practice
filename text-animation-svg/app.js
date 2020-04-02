const fleekmode = document.querySelectorAll("#fleekmode path");
console.log(fleekmode);

for(let i =0; i < fleekmode.length; i++){
    console.log(`letter ${i} is ${fleekmode[i].getTotalLength()}`)
}