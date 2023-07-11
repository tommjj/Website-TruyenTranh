const containerTable = document.querySelector('.chapters tbody');

containerTable.addEventListener('click', (e) => {
    if (e.target.classList.contains('bx-trash-alt')) {

        if (!confirm('Bạn có muốn xoá?')) {
            return;
        }

        var data = {
            MaTap: e.target.getAttribute('MaTap')
        }

        $.ajax({
            type: 'POST',
            url: '../php/deleteEP.php',
            data: data,
            success: function (data) {
                resetLoad();
            }
        });
    }
});

function createRow(MaTap, tapSo, name, view, date, tt) {
    var newRow = document.createElement('TR');
    var inner = `<td>
                    ${tapSo}
                </td>
                <td>
                    <div class="chapter">
                        <div class="text">
                            <a href="">${name}</a>
                        </div>
                    <div class="buttons">
                        <a title="chỉnh sửa"href="${window.location.protocol + '//' + window.location.hostname + "/WEBTruynTranh/Creator/comic/edit-ep?MaTap=" + MaTap}"><i class='bx bx-edit-alt'></i></a>
                        <a title="Xoá" MaTap="${MaTap}" class="bx bx-trash-alt"></a>
                    </div>
                </div>
                </td>
                <td>${tt}</td>
                <td>${date}</td>
                <td>${view}</td>`;
    newRow.innerHTML = inner;

    return newRow;
}

const LoadLimit = 2;
var page = 0;
var checkAll = false;
var MaTruyen = null;

function loadRow() {
    var data = {
        MaTruyen: MaTruyen,
        at: page * LoadLimit,
        limit: LoadLimit
    }

    $.ajax({
        type: 'GET',
        url: '../php/GetEP.php',
        data: data,
        success: function (data) {

            data = JSON.parse(data);
            containerTable.innerHTML = '';

            for (var i in data) {
                containerTable.appendChild(createRow(data[i]['MaTap'], data[i]['TapSo'], data[i]['TenTap'], data[i]['LuocXem'], data[i]['NgayDang'], data[i]['TenCD']));
            }

            var response = {
                html: containerTable.innerHTML,
                pageTitle: `Creator`,
                page: (page+1),
                checkAll: checkAll
            }
            
            processAjaxData(response, `?MaTruyen=${MaTruyen}&page=${page+1}`);
            

            if (Number(i) + 1 < LoadLimit) {
                checkAll = true;
            }
            page++; 
        }
    });
}

function setUp() {
    console.log(urlSearchPath = window.location.search);
    var urlParams = new URLSearchParams(urlSearchPath); 
    console.log();
    MaTruyen = urlParams.get('MaTruyen');
    page = Number(urlParams.get('page') != null ? urlParams.get('page')-1: 0);
}

function processAjaxData(response, urlPath){
    window.history.pushState({"html":response.html,"pageTitle":response.pageTitle, page: response.page},"", urlPath);
}

window.onpopstate = function(e){
    if(e.state){
        containerTable.innerHTML = e.state.html;
        //document.title = e.state.pageTitle;
        page = e.state.page;
        checkAll = e.state.checkAll;
        console.log(e.state.page);
    }
};

document.querySelector('.next').onclick = function () {
    if (!checkAll) {
        loadRow();
    }
}

document.querySelector('.pre').onclick = function () {
    if (page > 1) {
        page -= 2;
        loadRow();
        checkAll = false;
    }
}

function resetLoad() {
    page = 0;
    loadRow();
}

//////////////////

const createEP = document.querySelector('.createEP');
const close = document.querySelector('.createEP .head div');
const createEPButton = document.querySelector('.createEP form .create-bt');
const showBt = document.querySelector('.head-bar div');

close.onclick = function () {
    createEP.classList.add('hidden');
}

showBt.onclick = function () {
    createEP.classList.remove('hidden');
}

createEPButton.onclick = function () {
    var formData = new FormData(document.querySelector('.createEP form'));

    $.ajax({
        type: 'POST',
        url: '../php/createEP.php',
        processData: false,
        contentType: false,
        data: formData,
        success: function (data) {
            close.onclick();
            resetLoad();
        }
    });
}

//

setUp();
loadRow();
