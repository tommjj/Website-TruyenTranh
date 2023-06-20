var lastScroll = 0;
const readingBar = document.querySelector('.reading-bar.reading-bar-top');

function scrollHeader(event) {
    if (window.pageYOffset > lastScroll + 150) {
        readingBar.classList.add('header-hidden');
        header.classList.add('hidden');
        nav.classList.add('header-hidden');
        nav.classList.add('active');
        lastScroll = window.pageYOffset;
    } else if (window.pageYOffset < lastScroll -150) {
        header.classList.remove('hidden');
        nav.classList.remove('header-hidden');
        readingBar.classList.remove('header-hidden');
        lastScroll = window.pageYOffset;
    }
    
}

document.addEventListener('scroll', scrollHeader);


const pageCtrl = document.getElementById('page-ctrl');
const containerPage = document.querySelectorAll('.comic-page');


pageCtrl.oninput = function() {
    console.log(pageCtrl.value);

    for(let i = 0; i < containerPage.length; i++) {
        containerPage[i].style.width = `${pageCtrl.value}%`;
    }
}

const epSelecter = document.querySelectorAll('.reading-bar .ep-buttons select');

epSelecter[0].addEventListener('change', (e) => {
    window.location = "?MaTap="+e.target.value;
});

epSelecter[1].addEventListener('change', (e) => {
    window.location = "?MaTap="+e.target.value;
});

const nextButton = document.querySelectorAll('.reading-bar .ep-buttons button.next-button');
const preButton = document.querySelectorAll('.reading-bar .ep-buttons button.pre-button');

nextButton[0].onclick = nextButton[1].onclick = preButton[0].onclick = preButton[1].onclick = function(e) {
    
    if(e.target.getAttribute('MaTap') != -1) {
        window.location = "?MaTap="+e.target.getAttribute('MaTap');
    }
}
