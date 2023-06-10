const page = document.getElementsByClassName('page');
const pageBar = document.querySelector('.page-bar ul');

pageBar.addEventListener('click', function(e) {
    console.log([...e.target.parentElement.children].indexOf(e.target));
    
    for(let i = 0; i < page.length; i++) {
        page[i].classList.remove('active');
    }

    for(let i = 0; i < pageBar.children.length; i++) {
        pageBar.children[i].classList.remove('active');
    }

    pageBar.children[[...e.target.parentElement.children].indexOf(e.target)].classList.add('active');
    page[[...e.target.parentElement.children].indexOf(e.target)].classList.add('active');
}, false);