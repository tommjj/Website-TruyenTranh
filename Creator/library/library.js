const containerTable = document.querySelector('.comics tbody');

function creactRow(MaTruyen ,img, name, content, view, comment, like, date, tt) {
    var newRow = document.createElement('TR');
    var inner = `<td>
                    <div class="comic">
                        <div class="img">
                            <img src="${window.location.protocol+'//'+window.location.hostname+'/WEBTruynTranh/res/'+img}" alt="">
                        </div>
                    <div class="text">
                        <a href="">${name}</a>
                        <div class="content">${content}</div>
                    </div>
                    <div class="buttons">
                        <a title="chỉnh sửa"href=""><i class='bx bx-edit-alt'></i></a>
                        <a title="bình luận" href=""><i class='bx bx-comment'></i></a>
                    </div>
                </div>
            </td>
            <td>${tt}</td>
            <td>${date}</td>
            <td>${view}</td>
            <td>${comment}</td>
            <td>${like}</td>`;
    newRow.innerHTML = inner;
    
    return newRow;
}

const LoadLimit = 30;
var numitems = 0;
var checkAll = false;

function loadRow() {
    var data = {
          at: numitems,
          limit: LoadLimit 
    }

    $.ajax({
        type: 'GET',
        url: '../php/getComic.php',
        data: data,
        success: function (data) {      
            data = JSON.parse(data);
            containerTable.innerHTML = '';

            for(var i in data) {
                containerTable.appendChild(creactRow(data[i]['MaTruyen'] ,data[i]['AnhBia'], data[i]['TenTruyen'], data[i]['NoiDung'], data[i]['ls'], data[i]['sbl'], data[i]['slt'], data[i]['NgayTao'], data[i]['TenCD']));
            } 
            
            if(i < LoadLimit-1) {
                checkAll = true;
            }
            numitems += i;

        }
    });
}
loadRow();

document.querySelector('.next').onclick = function() {
    
    if(!checkAll) {
        loadRow();
    }
}

document.querySelector('.pre'). onclick = function() {
    if(numitems > LoadLimit) {
        numitems -= (LoadLimit * 2);
        loadRow();
    }
}