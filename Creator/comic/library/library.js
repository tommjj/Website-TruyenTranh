const containerTable = document.querySelector('.chapters tbody');

containerTable.addEventListener('click', (e) => {
    if(e.target.classList.contains('bx-trash-alt')) {
        
        if(!confirm('Bạn có muốn xoá?')) {
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

function creactRow(MaTap, tapSo, name, view, date, tt) {
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
                        <a title="chỉnh sửa"href="${window.location.protocol + '//' + window.location.hostname +"/WEBTruynTranh/Creator/comic/edit-ep?MaTap="+MaTap}"><i class='bx bx-edit-alt'></i></a>
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

const LoadLimit = 30;
var numitems = 0;
var checkAll = false;
var MaTruyen = null;

function setMaTruyen(value) {
    MaTruyen = value;
}

function loadRow() {
    var data = {
        MaTruyen: MaTruyen,
        at: numitems,
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
                containerTable.appendChild(creactRow(data[i]['MaTap'], data[i]['TapSo'], data[i]['TenTap'], data[i]['LuocXem'], data[i]['NgayDang'], data[i]['TenCD']));
            }

            if (i < LoadLimit - 1) {
                checkAll = true;
            }
            numitems += i;
        }
    });
}



document.querySelector('.next').onclick = function () {
    if (!checkAll) {
        loadRow();
    }
}

document.querySelector('.pre').onclick = function () {
    if (numitems > LoadLimit) {
        numitems -= (LoadLimit * 2);
        loadRow();
    }
}

function resetLoad() {
    numitems = 0;
    loadRow();
}

//////////////////

const createEP = document.querySelector('.createEP');
const close = document.querySelector('.createEP .head div');
const createEPButton = document.querySelector('.createEP form .create-bt');
const showBt = document.querySelector('.head-bar div');

close.onclick = function() {
    createEP.classList.add('hidden');
}

showBt.onclick = function() {
    createEP.classList.remove('hidden');
}

createEPButton.onclick = function() {
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

