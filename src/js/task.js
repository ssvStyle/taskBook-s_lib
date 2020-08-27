window.addEventListener('DOMContentLoaded', () => {
    let status = document.getElementsByName('status');

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