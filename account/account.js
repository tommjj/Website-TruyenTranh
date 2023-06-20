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


//load item

function creatItem(img, name, content, id) {

    var newItem = document.createElement('div');
    newItem.classList.add('item');
    var inner = `<a href=\"${window.location.protocol+'//'+window.location.hostname+"/WEBTruynTranh/comic/?MaTruyen="+id+"\""}\" class=\"\" ><img src=\"${window.location.protocol+'\/\/'+window.location.hostname}/WEBtruynTranh/res/${img}\" alt=\"\"><div class=\"text\"><div class=\"name\">${name}</div><div class=\"content\">${content}</div></div><div class=\"icon\"><i class=\'bx bx-right-arrow-alt\'></i></div></a><div class=\"show-overlay\"></div><div class='save-button bx bx-bookmark'></div>`;
    
    newItem.innerHTML = inner;
    newItem.setAttribute("MaTruyen", id);

    var data = {
        MaTruyen: id
    }

    $.ajax({
        type: 'POST',
        url: window.location.protocol+'//'+window.location.hostname+'/WEBTruynTranh/methodPhp/check-save.php',
        data: data,
        success: function (data) {
            console.log(data);
            if(data == 'true') {
                newItem.children[2].classList.add('bxs-bookmark');
            }
        }
    });   
    
    return newItem;
}

const items = document.querySelector('div.items');

function loadComic(id) {
    var data = {
        id: id
    }

    $.ajax({
        type: 'GET',
        url: '../methodPhp/getComic.php',
        data: data,
        success: function (data) {
            data = JSON.parse(data);

            for(var i in data) {
                items.appendChild(creatItem(data[i].AnhBia, data[i].TenTruyen, data[i].NoiDung, data[i].MaTruyen));
            }
        }
    });
}

//follow
const followbutton = document.querySelector('#follow-button');
const numFollower = document.querySelector('.info-account .text p span');

followbutton.onclick = () => {
    var data = {
        id: accID
    }

    $.ajax({
        type: 'POST',
        url: '../methodPhp/follow.php',
        data: data,
        success: function (data) {
            console.log(data);
            if(data == 'unfollow') {
                followbutton.classList.toggle('follow');
                followbutton.classList.toggle('followed');

                numFollower.innerHTML = parseInt(numFollower.innerHTML) - 1; 
            } else if(data == 'followed'){
                followbutton.classList.toggle('follow');
                followbutton.classList.toggle('followed');

                numFollower.innerHTML = parseInt(numFollower.innerHTML) + 1; 
            } else {
                if(confirm('Đăng nhập?')) {
                    window.location = "../signin-signup/"
                }
            }
        }
    });
}



