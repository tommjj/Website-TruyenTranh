const selectFile = document.querySelector('.select-img');
const avt = document.querySelector('.avt-image img');

console.log(avt);

const validImageTypes = ['image/gif', 'image/jpeg', 'image/png']

selectFile.addEventListener('change', (e) => {
    const files = e.target.files
    const file = files[0]
    const fileType = file['type']

    if (!validImageTypes.includes(fileType)) {
        
        return;      
    }

    const fileReader = new FileReader();
    fileReader.readAsDataURL(file);


    fileReader.onload = function() {
        const url = fileReader.result;
    
        const htmlString = `<img src="${url}" alt="${file.name}" class="img-thumbnail preview-img" />`;
        avt.src = url;
      }
});