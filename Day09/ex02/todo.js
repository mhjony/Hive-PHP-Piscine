// deletion of todo
function delete_todo(param) {
    if (confirm('Are you sure to delete this?')) {
        let task = document.getElementById('ft_list');
        task.removeChild(param);
        setCookie(param.getAttribute("name").trim(), encodeURIComponent(param.innerHTML), -1);
    }
}

function getRndInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function setCookie(cname, cvalue, exdays) {
    let d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

window.onload = function () {
    // Load todos from coockie
    let coo = document.cookie.split(';');

    // Put todos -> DOM
    if (coo[0]) {
        let ft_list = document.getElementById('ft_list');
        let arr;
        let i = coo.length - 1;
        let kalle;
        for (i; i >= 0; i--) {
            arr = coo[i].split('=');
            ft_list.innerHTML += '<div name="' + arr[0] + '"class="to_do" onclick="delete_todo(this)"style="text-align:center; border-style: inset; height: 3em;">' + decodeURIComponent(arr[1]) + '</div>';
        }
    }

    // adding new to_do
    document.getElementById('new_todo').onclick = function () {
        let todo_str = prompt('Add a list to your app!', '');
        if (todo_str == null || todo_str == false) {
            return;
        }
        let ft_list = document.getElementById('ft_list');
        let todos = document.getElementsByClassName("to_do");

        if (todos) {
            let new_todo = document.createElement('div');
            let text_node = document.createTextNode(todo_str);
            new_todo.appendChild(text_node);
            new_todo.classList.add('to_do');
            new_todo.setAttribute('onclick', 'delete_todo(this)');
            ft_list.insertBefore(new_todo, todos[0]);
            if (!(location.hostname == ''))
                location.reload();
        }
        else {
            ft_list.innerHTML += '<div class="to_do" onclick="delete_todo(this)">' + todo_str + '</div>';
        }

        // Save changes to coockie
        let fist = document.getElementById('ft_list').children;
        setCookie(getRndInteger(0, 100000), encodeURIComponent(fist[0].innerHTML), 2);
    }
    console.log(this.location);
}