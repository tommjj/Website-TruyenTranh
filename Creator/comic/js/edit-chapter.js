const pageChapterContainer = document.querySelector('.page-chapter-container');

var indexAdd = -1;

pageChapterContainer.addEventListener('click', (e) => {
    
    if (e.target.parentElement.classList.contains('up')) {
        var index = [...e.target.parentElement.parentElement.parentElement.parentElement.parentElement.children].indexOf(e.target.parentElement.parentElement.parentElement.parentElement);
        if (index > 0 && pageChapterContainer.childElementCount > 1) {

            scroll(0, pageChapterContainer.children[index - 1].offsetTop);

            pageChapterContainer.insertBefore(pageChapterContainer.children[index], pageChapterContainer.children[index-1])
            setIndex();
        }
    }

    if (e.target.parentElement.classList.contains('down')) {
        var index = [...e.target.parentElement.parentElement.parentElement.parentElement.parentElement.children].indexOf(e.target.parentElement.parentElement.parentElement.parentElement);
        if (index <= (pageChapterContainer.childElementCount - 2)) {
 
            scroll(0, pageChapterContainer.children[index + 1].offsetTop);

            pageChapterContainer.insertBefore(pageChapterContainer.children[index+1], pageChapterContainer.children[index])
            setIndex();
        }
    }

    if (e.target.parentElement.classList.contains('add')) {
        var index = [...e.target.parentElement.parentElement.parentElement.parentElement.parentElement.children].indexOf(e.target.parentElement.parentElement.parentElement.parentElement);
        
        indexAdd = index;
        $('.add-img input').click();
        
        setIndex();

    }

    if (e.target.parentElement.classList.contains('delete')) {
        var index = [...e.target.parentElement.parentElement.parentElement.parentElement.parentElement.children].indexOf(e.target.parentElement.parentElement.parentElement.parentElement);
        var idimg = pageChapterContainer.children[index].getAttribute('idimg');

        pageChapterContainer.removeChild(pageChapterContainer.children[index]);
        setIndex();
        console.log(idimg);

    }
}, false);

const AddImg = document.querySelector(".add-img");
const inputAddImg = document.querySelector(".add-img input");

const validImageTypes = ['image/gif', 'image/jpeg', 'image/png']

function createPage(imgUrl, imgid, nuber) {
    var val = `<img src="${imgUrl}" alt="">
                    <div class="page-bar">
                        <div class="page-ctrl">
                            <div class="up"><i class='bx bx-chevron-up'></i></div>
                            <p>${nuber}</p>
                            <div class="down"><i class='bx bx-chevron-down' ></i></div>
                            <button class="add"><i class='bx bx-add-to-queue'></i></button>
                            <button class="delete"><i class='bx bx-trash-alt'></i></button>
                        </div>               
                    </div>`;

    var page = document.createElement('DIV');
    page.classList.add('page-chapter');
    page.setAttribute("idimg", imgid);
    page.innerHTML = val;
    return page;
}

inputAddImg.addEventListener('change', (e) => {
    var formData = new FormData($('.add-img')[0]);
    console.log($('.add-img'));

    $.ajax({
        type: 'POST',
        url: 'js/edit.php',
        processData: false,
        contentType: false,
        data: formData,
        success: function (data) {
            const files = e.target.files
            const file = files[0]
            const fileType = file['type']

            if (!validImageTypes.includes(fileType)) {
                return;
            }

            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);


            fileReader.onload = function () {
                const url = fileReader.result;
                if(indexAdd == -1) {
                    pageChapterContainer.appendChild(createPage(url, data, pageChapterContainer.childElementCount + 1));
                    scroll(0, pageChapterContainer.children[pageChapterContainer.childElementCount - 1].offsetTop);
                } else {

                    pageChapterContainer.insertBefore(createPage(url, data, pageChapterContainer.childElementCount + 1), pageChapterContainer.children[indexAdd+1]);
                    scroll(0, pageChapterContainer.children[indexAdd+1].offsetTop);
                    indexAdd = -1;
                }
                
            }
            setIndex();

        }
    });
});

function setIndex() {
    for (let i = 0; i < pageChapterContainer.childElementCount; i++) {
        pageChapterContainer.children[i].children[1].children[0].children[1].innerHTML = i + 1;
    }
}

setIndex();


function getIdimg() {
    var val = [];
    for (let i = 0; i < pageChapterContainer.childElementCount; i++) {
        val[i] = pageChapterContainer.children[i].getAttribute('idimg');
    }
    return val;
}

$(".save").click(() => {
    getIdimg();
    console.log(getIdimg());
});



