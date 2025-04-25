function get_users() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("users-data").innerHTML = this.responseText;
  };
  xhr.send("get_users");
}

function toggle_status(id, val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Status Toggled");
      get_users();
    } else {
      alert("danger", "Server Down");
    }
  };
  xhr.send("toggle_status=" + id + "&value=" + val);
}

function remove_user(user_id) {
  if (confirm("Are you sure,you want to delete this user ?")) {
    let data = new FormData();
    data.append("remove_user", "");
    data.append("user_id", user_id);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users_crud.php", true);

    xhr.onload = function () {
      if (this.responseText == "1") {
        alert("success", "User removed");
        get_users();
      } else {
        alert("danger", "User removal failed");
      }
    };
    xhr.send(data);
  }
}

function search_user(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/users_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("users-data").innerHTML = this.responseText;
  };
  xhr.send("search_user&name=" + val);
}

window.onload = function () {
  get_users();
};
