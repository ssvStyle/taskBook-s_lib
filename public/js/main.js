window.addEventListener('DOMContentLoaded', () => {
    let newTaskBtn = document.querySelector('#addNewTask'),
        newTaskBlock = document.querySelector('#newTaskBlock'),
        sort = document.querySelector('#sort'),
        sortBy = document.querySelector('#sortBy'),
        url = window.location.href,
        status = document.getElementsByName('status'),
        taskBlockStatus = document.querySelectorAll('.task__block-status');



    if (url.indexOf('sort/asc') > 0) {
        sort.src = 'public/img/icons/sort/sort_asc.png';
        sort.parentNode.href = url.replace(/asc/, 'desc');
    }

    if (url.indexOf('sort/desc') > 0) {
        sort.src = 'public/img/icons/sort/sort_desc.png';
        sort.parentNode.href = url.replace(/desc/, 'asc');
    }

    if (url.indexOf('field/') > 0) {
        let opts = sortBy.options;
        for (let opt, j = 0; opt = opts[j]; j++) {
            if (opt.value == url) {
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


    //console.log(window.location.href);

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

    for (var i = 0; i < status.length; i++) {
        status[i].onclick = function() {
            localStorage.setItem('status', this.value);
        }
    }
    if(localStorage.getItem('status')) {
        let localStatus = localStorage.getItem('status');
        document.querySelector('input[name="status"][value="' + localStatus + '"]').setAttribute('checked','checked');
    }
});