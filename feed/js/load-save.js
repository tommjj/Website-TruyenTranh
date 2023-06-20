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
            at: nuberItems,
            limit: limitLoad
        }

        $.ajax({
            type: 'GET',
            url: window.location.protocol + '//' + window.location.hostname + '/WEBTruynTranh/feed/php/getSave.php',
            data: data,
            cache: false,
            success: function (data) {
                console.log(data);
                if (data != '') {
                    data = JSON.parse(data);

                    for (var i in data) {
                        container.appendChild(creatItem(data[i].AnhBia, data[i].TenTruyen, data[i].NoiDung, data[i].MaTruyen));
                    }
                    nuberItems += i;
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





