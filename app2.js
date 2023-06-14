let divs = document.querySelectorAll(".year div")
divs.forEach(element => {
    element.cssText = 'width:calc(80vw/30);';
});
let divs2 = document.querySelectorAll(".mounth form button ")

divs2.forEach(element => {
    element.cssText = 'width:calc(80vw/30);';
    
});



let imgs = document.querySelectorAll("[src=data:image/jpeg;base64,bm9uZQ==]")
imgs.forEach(element => {
    if (element.src == 'data:image/jpeg;base64,bm9uZQ==') {
        element.src = 'https://assets.goal.com/v3/assets/bltcc7a7ffd2fbf71f5/bltf7695f98c1f01bd9/62cbfb91c9db8842cf76cb5b/GHP_MESSI-BOOTS_16-9.jpg';
    }
});

