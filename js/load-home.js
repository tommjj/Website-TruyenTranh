
//*********************** */
const container = document.getElementById('container');
const body = document.getElementById('body');

var loadAll = false;
var nuberItems = 0;
var limitLoad = 25;

function loadItem() {
    if (loadAll) {
        return;
    }

    if (!(container === null)) {
        console.log(loadAll);
        var data = {
            search: '',
            like: 3,
            json: true,
            at: nuberItems,
            limit: limitLoad
        }

        console.log(nuberItems);

        $.ajax({
            type: 'GET',
            url: window.location.protocol + '//' + window.location.hostname + '/WEBTruynTranh/methodPhp/search.php',
            data: data,
            success: function (data) {
                console.log(data)
                if (data != '') {
                    data = JSON.parse(data);

                    
                    for (var i in data) {
                        container.appendChild(creatItem(data[i].AnhBia, data[i].TenTruyen, data[i].NoiDung, data[i].MaTruyen));
                    }
                    nuberItems +=  Number(i)+1;
                    if (Number(i)+1 < limitLoad) loadAll = true;
                }
            }
        });
    }
}

function scrollContainer(event) {

    if (!(container === null)) {
        var offset = (container.offsetHeight + container.offsetTop) - window.pageYOffset - body.offsetHeight;

        if (offset < 50) {
            loadItem();
        }
    }
}



function setLoad () {
    loadItem();
    document.addEventListener('scroll', scrollContainer);
}





