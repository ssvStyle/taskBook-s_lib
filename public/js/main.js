window.addEventListener('DOMContentLoaded', () => {
    let newTaskBtn = document.querySelector('#addNewTask'),
        newTaskBlock = document.querySelector('#newTaskBlock'),
        sort = document.querySelector('#sort'),
        sortBy = document.querySelector('#sortBy'),
        url = window.location.href,
        taskBlockStatus = document.querySelectorAll('.task__block-status');

    if (sort.parentNode.href.indexOf('sort/desc') > 0) {
        sort.src = 'public/img/icons/sort/sort_desc.png';
        sort.parentNode.href = sort.parentNode.href.replace(/desc/, 'asc');
    } else {
        sort.src = 'public/img/icons/sort/sort_asc.png';
        sort.parentNode.href = sort.parentNode.href.replace(/asc/, 'desc');
    }

    if (url.search(/(?!(field\/))[a-zA-Z0-9]*(?=\/sort)/) > 0) {
        let opts = sortBy.options;
        for (let opt, j = 0; opt = opts[j]; j++) {
            console.log(url.indexOf(opt.value));
            if (url.indexOf(opt.value) > 0) {
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
        window.location.href = event.target.value;
    });

    function changeTaskStyle() {
        taskBlockStatus.forEach(function(obj) {
                if (obj.innerText == 'Не выполнено. Отредактировано администратором.') {
                    obj.parentNode.parentNode.classList.toggle('task__blockDoneAdminEdit');
                }

                if (obj.innerText == 'Выполнено.') {
                    obj.parentNode.parentNode.classList.toggle('task__blockDone');
                }
            });
    }

    changeTaskStyle();
});