// const container = document.querySelector('').parentElement;

function setUpFollowMethed(container) {
    container.addEventListener('click', (e) => {
        if(e.target.classList.contains('save-button')) {
            console.log('save');
            var data = {
                MaTruyen: e.target.parentElement.getAttribute('MaTruyen')
            }
        
            $.ajax({
                type: 'POST',
                url: window.location.protocol+'//'+window.location.hostname+'/WEBTruynTranh/methodPhp/save-comic.php',
                data: data,
                success: function (data) {
                    console.log(data);
                    if(data == 'remove') {
                        e.target.classList.remove('bxs-bookmark');
                    } else if(data == 'saved'){
                        e.target.classList.add('bxs-bookmark');
                    } else {
                        if(confirm('Đăng nhập?')) {
                            window.location = "../signin-signup/"
                        }
                    }
                }
            });
        }
    });
}

//container.parentElement