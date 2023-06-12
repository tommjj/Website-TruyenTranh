const page = document.getElementsByClassName('page');
const pageBar = document.querySelector('.page-bar ul');

var index = 0;

const preButton = document.querySelector('.buttons-ctrl .button-pre');
const nextButton = document.querySelector('.buttons-ctrl .button-next');
const submitButton = document.querySelector('.buttons-ctrl .button-submit');

nextButton.onclick = ()=> {
    index++;
    pageBar.children[index].classList.add('active');

    for(let i = 0; i < page.length; i++) {
        page[i].classList.remove('active');
    }

    page[index].classList.add('active');
    setButton();
}

preButton.onclick = ()=> {
    pageBar.children[index].classList.remove('active');
    index--;
    pageBar.children[index].classList.add('active');

    for(let i = 0; i < page.length; i++) {
        page[i].classList.remove('active');
    }

    page[index].classList.add('active');
    setButton();
}

function setButton() {
    preButton.style.display = 'block';
    nextButton.style.display = 'block';
    submitButton.style.display = 'none';

    if(index == 0) {
        preButton.style.display = 'none';
    }

    if(index == (pageBar.childElementCount-1)) {
        submitButton.style.display = 'block';
        nextButton.style.display = 'none';
    }
}

setButton();

const tags = document.querySelector('.create-comic .tags'); 

tags.addEventListener('click', (e) => {
    
    if(e.target.tagName = 'LI') {
        if(!e.target.classList.contains('active')) {
            var val = e.target.innerHTML;
        
            var newIn = document.createElement("input");
            newIn.type = "hidden";
            newIn.name = "tags[]";
            newIn.value = val;

            tags.appendChild(newIn);
            
            e.target.classList.add('active');
        } else {
            var val = e.target.innerHTML;
        
            for (let child of tags.children) {
                if(child.tagName == 'INPUT') {
                    if(child.value == val) {
                        tags.removeChild(child);
                        break;
                    }
                }
            }

            e.target.classList.remove('active');
        }
    }
});

const createForm = document.querySelector('.form-create');

submitButton.onclick = () => {

    var formData = new FormData($('form.form-create')[0]);

    $.ajax({
        type: 'POST',
        url: 'js/create.php',
        processData: false,
        contentType: false,
        data: formData,
        success : function(data) {
            console.log(data);
        }
    });
}


$('button.cancel').click(() => {
    $('.create-comic').css("display", "none");
})

pageBar.addEventListener('click', function(e) {

    if([...e.target.parentElement.children].indexOf(e.target) < index) {
        for(let i = 0; i < page.length; i++) {
            page[i].classList.remove('active');
        }
    
        for(let i = 0; i < pageBar.children.length; i++) {
            pageBar.children[i].classList.remove('active');
        }
    
        pageBar.children[[...e.target.parentElement.children].indexOf(e.target)].classList.add('active');
        page[[...e.target.parentElement.children].indexOf(e.target)].classList.add('active');
        index = [...e.target.parentElement.children].indexOf(e.target);
        setButton();
    }
}, false);