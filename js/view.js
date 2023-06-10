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


//commant
const containerCommants = document.querySelector('.container-commants');

containerCommants.addEventListener('click', (e) => {    
    if(e.target.classList.contains('reply')) {
        console.log(e.target.parentElement.parentElement.parentElement.childNodes);
       e.target.parentElement.parentElement.parentElement.childNodes[5].classList.toggle('active');
    }

    if(e.target.classList.contains('show-reply')) {
        e.target.parentElement.parentElement.parentElement.childNodes[7].classList.toggle('active');
        e.target.childNodes[1].classList.toggle('bx-chevron-up');
    }

    if(e.target.classList.contains('like')) {
        //like
    }

    if(e.target.classList.contains('delete')) {
        //delete 
    }
}, false);