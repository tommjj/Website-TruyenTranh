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
