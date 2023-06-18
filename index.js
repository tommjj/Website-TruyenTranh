
/*--------=======nav button and scolled======---------*/

const navButton = document.getElementById('nav-button');
const nav = document.getElementById('nav');
const header = document.getElementById('header');
const containerMain = document.querySelector('.container');

navButton.onclick = function () {

    console.log(window.innerWidth);

    if (window.innerWidth > 600) {
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

const account = document.querySelector('header div.account');

account.onclick = () => {
    document.querySelector('header div.account .account-op').classList.toggle('active');
}

document.querySelector('#log-out').onclick = () => {

    $.ajax({
        type: 'POST',
        url: window.location.protocol + '//' + window.location.hostname + '/WEBTruynTranh/methodPhp/log-out.php',
        data: '',
        success: function (data) {
            if (data == 'true') {
                window.location = window.location.protocol + '//' + window.location.hostname + '/WEBTruynTranh/signin-signup/index.html';
            }
        }
    });
};

//show more followed

const followedContainer = document.querySelector('.nav .show-followed');
const showMoreFollowed = document.querySelector('.nav .show-followed .show-more-followed')


if (!(showMoreFollowed == null)) {
    showMoreFollowed.onclick = (e) => {
        showMoreFollowed.classList.toggle('active');
        showMoreFollowed.children[0].children[0].classList.toggle('bx-flip-vertical');
        followedContainer.classList.toggle('active');
    }
}

//search-suggestions

const searchSuggestions = document.querySelector('.search-suggestions');
const searchBarIndex = document.querySelector('.search input[type="text"]');

// searchBarIndex.onfocus = function () {
//     searchSuggestions.classList.add('active');
// }

searchBarIndex.onblur = function () {

    setTimeout(() => {
        searchSuggestions.classList.remove('active');
    }, 250);
}

searchSuggestions.addEventListener('click', (e) => {
    if (e.target.tagName == 'LI') {
        searchBarIndex.value = e.target.innerHTML;
    }

    searchBarIndex.focus();
});

searchBarIndex.oninput = function () {

    if(searchBarIndex.value == '') {
        searchSuggestions.children[0].innerHTML = '';
        searchSuggestions.classList.remove('active');
        return;
    }

    var tags = [];

    for(let i = 0; i < searchBarIndex.parentElement.childElementCount; i++) {
        
        if(searchBarIndex.parentElement.children[i].name == 'tags[]') {
            tags.push(searchBarIndex.parentElement.children[i].value); 
        }
    }

    console.log(tags);
    
    var data = {
        search: searchBarIndex.value,
        like: 2,
        tags: tags,
        json: true
    }

    $.ajax({
        type: 'GET',
        url: 'methodPhp/search.php',
        data:  data ,
        cache: false,
        success: function (data) {
            if(data != '') {
                searchSuggestions.classList.add('active');
                searchSuggestions.children[0].innerHTML = '';

                data = JSON.parse(data);

                for(var i in data) {
                    let it = document.createElement('LI');
                    it.innerHTML = data[i]['TenTruyen'];
                    searchSuggestions.children[0].appendChild(it);
                }
            } else {
                searchSuggestions.children[0].innerHTML = '';
                searchSuggestions.classList.remove('active');
            } 
        }
    });
}



