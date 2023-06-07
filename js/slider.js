const sliderMain = document.querySelector('.slider-main');
const sliderBar = document.querySelector('.slider-bar');

const nuberSlide = sliderMain.childElementCount;
var sliderIndex = 0;

console.log(nuberSlide);

function getIndex(index) {
    if(index < 0) {
        return nuberSlide - 1;
    }
    if(index >= nuberSlide) {
        return 0;
    }
    return index;
}

function sliderIndexChange(value) {
    sliderIndex +=value;
    sliderIndex = getIndex(sliderIndex);
}

var sliderChange = (index) =>{
    for(let i = 0; i < nuberSlide; i++) {
        sliderMain.children[i].classList.remove('left');
        sliderMain.children[i].classList.remove('right');
        sliderMain.children[i].classList.remove('over-left');
        sliderMain.children[i].classList.remove('over-right');
        sliderMain.children[i].classList.remove('between');
        sliderBar.children[i].classList.remove('active');
    }

    for(let i = 0; i < nuberSlide; i++) {
        if(i < index-1) {
            sliderMain.children[i].classList.add('over-left');
        } else if(i > index+1) {
            sliderMain.children[i].classList.add('over-right');
        }
    }

    sliderMain.children[getIndex(index-1)].classList.add('left');
    sliderMain.children[getIndex(index+1)].classList.add('right');
    sliderMain.children[getIndex(index)].classList.add('between');
    sliderBar.children[index].classList.add('active');
    
    sliderIndex = index;
}

function strartSlider() {   
    sliderChange(sliderIndex);
    sliderIndexChange(1);
    setTimeout(strartSlider, 5000);
}

strartSlider();

function nextSlide() {
    sliderChange(getIndex(sliderIndex+1));
}

function preSlide() {
    sliderChange(getIndex(sliderIndex-1));
}

sliderBar.addEventListener('click',(e) => {
    if( e.target.tagName == 'BUTTON') {
        sliderChange([...e.target.parentElement.children].indexOf(e.target));
    }
},false)