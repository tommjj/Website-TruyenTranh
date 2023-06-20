
//*********************** */
const container = document.getElementById('container');
const body = document.getElementById('body');

var loadAll = false;
var nuberItems = 0;
var limitLoad = 20;

function loadItem() {
    if (loadAll) {
        return;
    }

    if (!(container === null)) {
        var data = {
            search: '',
            like: 3,
            json: true,
            at: nuberItems,
            limit: limitLoad
        }

        console.log('s');

        $.ajax({
            type: 'GET',
            url: window.location.protocol + '//' + window.location.hostname + '/WEBTruynTranh/methodPhp/search.php',
            data: data,
            cache: false,
            success: function (data) {
                if (data != '') {
                    data = JSON.parse(data);

                    for (var i in data) {
                        container.appendChild(creatItem(data[i].AnhBia, data[i].TenTruyen, data[i].NoiDung, data[i].MaTruyen));
                    }
                    nuberItems += i + 1;
                    if (i < limitLoad-1) loadAll = true;
                }
            }
        });
    }
}

function scrollContainer(event) {

    if (!(container === null)) {
        var offset = (container.offsetHeight + container.offsetTop) - window.pageYOffset - body.offsetHeight;

        if (offset < 20) {
            loadItem();
        }
    }
}



function setLoad () {
    loadItem();
    document.addEventListener('scroll', scrollContainer);
}





