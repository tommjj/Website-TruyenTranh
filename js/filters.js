const searchBar = document.querySelector('#header .search form');
const filters = document.querySelector('.filters');
const filtersButton = document.querySelector('.filters .bar .button');
const tags = document.querySelector('.filters .tags')

filtersButton.onclick = ()=> {
    filters.classList.toggle('active');
}

tags.addEventListener('click', (e) => {
    if(e.target.tagName == 'LI') {
        if(!e.target.classList.contains('active')) {
            var val = e.target.getAttribute('ma');
    
            var newIn = document.createElement("input");
            newIn.type = "hidden";
            newIn.name = "tags[]";
            newIn.value = val;

            searchBar.appendChild(newIn);
            e.target.classList.add('active');
        } else {
            var val = e.target.getAttribute('ma');

            for (let child of searchBar.children) {
                if(child.tagName == 'INPUT') {
                    if(child.value == val && child.type == 'hidden') {
                        searchBar.removeChild(child);
                        break;
                    }
                }
            }
    
            e.target.classList.remove('active');
        }
    }
});
