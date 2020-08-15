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
        console.log(sortBy.src.indexOf('public/img/icons/sort/sort.png'));
        if (sortBy.src === '/public/img/icons/sort/sort_active.png') {
            sortBy.classList.value = 'select__block-imgUp';
        } else {
            sortBy.classList.value = 'select__block-imgDown';
        }
    })
});