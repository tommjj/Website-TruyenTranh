var lastScroll = 0;
const readingBar = document.querySelector('.reading-bar.reading-bar-top');

function scrollHeader(event) {
    if (window.pageYOffset > lastScroll + 150) {
        readingBar.classList.add('header-hidden');
        header.classList.add('hidden');
        nav.classList.add('header-hidden');
        nav.classList.remove('active');
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

console.log(container);

pageCtrl.oninput = function() {
    console.log(pageCtrl.value);

    for(let i = 0; i < containerPage.length; i++) {
        containerPage[i].style.width = `${pageCtrl.value}%`;
    }
}