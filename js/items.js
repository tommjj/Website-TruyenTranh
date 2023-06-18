function creatItem(img, name, content, tag, link) {
    var newItem = document.createElement('div');
    newItem.classList.add('item');
    var inner = `<a href=\"${link}\" class=\"\" ><img src=\"${window.location.protocol+'//'+window.location.hostname}/WEBtruynTranh/res/${img}\" alt=\"\"><div class=\"text\"><div class=\"name\">${name}</div><div class=\"content\">${content}</div></div><div class=\"icon\"><i class=\'bx bx-right-arrow-alt\'></i></div></a><div class=\"show-overlay\"></div>`;
    newItem.innerHTML = inner;
    return newItem;
}

function showItems(container, data) {
    if(data == ' ') return;
    data = JSON.parse(data);

    for(var i in data) {
        container.appendChild(creatItem(data[i].AnhBia, data[i].TenTruyen, data[i].NoiDung, '', ''));
    }
}