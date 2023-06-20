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
            if(data == 'true') {
                newItem.children[2].classList.add('bxs-bookmark');
            }
        }
    });   
    
    return newItem;
}

function showItems(container, data) {
    if(data == ' ') return;
    data = JSON.parse(data);

    for(var i in data) {
        container.appendChild(creatItem(data[i].AnhBia, data[i].TenTruyen, data[i].NoiDung, data[i].MaTruyen));
    }
}
