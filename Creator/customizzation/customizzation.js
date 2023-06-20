const form = document.querySelector('form.change-info-form');
const luu = document.querySelector('.buttons .save')

console.log(form);
console.log(luu);

luu.onclick = function() {
    var formData = new FormData(form);

    $.ajax({
        type: 'POST',
        url: '../php/update-info.php',
        processData: false,
        contentType: false,
        data: formData,
        success : function(data) {
            console.log(data);
            if(data == 'true') {
                alert('sua Thanh cong!');
            } else {
                alert('khong Thanh cong!');
            }
        }
    });
}