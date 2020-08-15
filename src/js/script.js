window.addEventListener('DOMContentLoaded', () => {
    let newTaskBtn = document.querySelector('#addNewTask'),
        newTaskBlock = document.querySelector('#newTaskBlock'),
        sortBy = document.querySelector('#sortBy'),
        selectSort = document.querySelector('#selectSort');


    console.log(newTaskBlock);
    console.log(newTaskBtn);

    newTaskBtn.addEventListener('click', () => {
        if (newTaskBlock.style.display === 'block') {
            newTaskBlock.style.display = 'none';
        } else {
            newTaskBlock.style.display = 'block';
        }
    });

    selectSort.addEventListener('change', (event) => {
        console.log(event.target.value);
    });

    sortBy.addEventListener('click', () => {
        console.log(sortBy.src.indexOf('public/img/icons/sort/sort_asc.png'));
        if (sortBy.src.indexOf('public/img/icons/sort/sort_desc.png') > 0) {
            sortBy.classList.value = 'select__block-imgUp';
        } else {
            sortBy.classList.value = 'select__block-imgDown';
        }
    })
});