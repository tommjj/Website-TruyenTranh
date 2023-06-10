
/*--------=======nav button and scolled======---------*/

const navButton = document.getElementById('nav-button');
const nav = document.getElementById('nav');
const header = document.getElementById('header');
const containerMain = document.querySelector('.container');

navButton.onclick = function () {

    console.log(window.innerWidth);

    if(window.innerWidth > 1200) {
        nav.classList.remove('hidden');
    }

    if (window.innerWidth < 600) {
        nav.classList.remove('active');
        if (nav.classList.contains('hidden')) {
            nav.classList.remove('hidden');
            return;
        }
        nav.classList.add('hidden');
    } else {
        if (!nav.classList.contains('hidden')) {
            if (!nav.classList.contains('active')) {
                nav.classList.add('hidden');
                setTimeout(() => {
                    nav.classList.add('active');
                   
                }, 20);
            } else {
                nav.classList.remove('active');
                
            }
            return;
        }
        nav.classList.remove('hidden');
    }
}



function scrolled(event) {
    if (window.pageYOffset > 10) {
        header.classList.add('active');
    } else if (window.pageYOffset == 0) {
        header.classList.remove('active');
    }
}

document.addEventListener('scroll', scrolled);

//search
const searchOverlay = document.getElementById('search-overlay');

searchOverlay.onclick = function () {
    searchOverlay.parentElement.classList.toggle('active');
}
//*********************** */
//******help method****** */

function creatItem(img, name, content, tag, link) {
    var newItem = document.createElement('div');
    newItem.classList.add('item');
    var inner = `<a href=\"${link}\" class=\"\" ><img src=\"${img}\" alt=\"\"><div class=\"text\"><div class=\"name\">${name}</div><p>con gà nướng</p><div class=\"content\">${content}</div></div><div class=\"icon\"><i class=\'bx bx-right-arrow-alt\'></i></div></a><div class=\"show-overlay\"></div>`;
    newItem.innerHTML = inner;
    return newItem;
}


//*********************** */
const container = document.getElementById('container');
const body = document.getElementById('body');

function scrollContainer(event) {
    if (!(container === null)) {
        var offset = (container.offsetHeight + container.offsetTop) - window.pageYOffset - body.offsetHeight;

        while (offset < 20) {

            container.appendChild(creatItem("./res/web-logo.png", "logo", "test", "", ""));
            var offset = (container.offsetHeight + container.offsetTop) - window.pageYOffset - body.offsetHeight;
        }
    }
}

document.addEventListener('scroll', scrollContainer);

//**********/
//***test***/

// setTimeout(() => {
//     document.getElementById('head').innerHTML += '<link rel="stylesheet" href="test.css">';
// }, 5000);

