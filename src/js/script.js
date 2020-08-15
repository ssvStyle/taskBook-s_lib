window.addEventListener('DOMContentLoaded', () => {
    let newTaskBtn = document.querySelector('#addNewTask'),
        newTaskBlock = document.querySelector('#newTaskBlock'),
        sort = document.querySelector('#sort'),
        sortBy = document.querySelector('#sortBy'),
        url = window.location.href;

    if (url.indexOf('sort/asc') > 0) {
        sort.src = 'public/img/icons/sort/sort_asc.png';
    }

    if (url.indexOf('field/') > 0) {
        let opts = sortBy.options;
        for (let opt, j = 0; opt = opts[j]; j++) {
            if (opt.value == url.match(/(?<=(field\/))[A-Za-z1-9]*(?<!\/sort)/)[0]) {
                sortBy.selectedIndex = j;
                break;
            }
        }
    }

    newTaskBtn.addEventListener('click', () => {
        if (newTaskBlock.style.display === 'block') {
            newTaskBlock.style.display = 'none';
        } else {
            newTaskBlock.style.display = 'block';
        }
    });

    sortBy.addEventListener('change', (event) => {
        let re = /(?<=(field\/))[A-Za-z1-9]*(?<!\/sort)/;
        window.location.href = url.replace(re, event.target.value);
    });

});