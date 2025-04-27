function get_bookings(search = "") {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/new_bookings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("table-data").innerHTML = this.responseText;
  };
  console.log("Send");
  xhr.send("get_bookings&search=" + search);
}

let assign_room_form = document.getElementById("assign_room_form");

function assign_room(id) {
  assign_room_form.elements["booking_id"].value = id;
}

assign_room_form.addEventListener("submit", (e) => {
  e.preventDefault();

  let data = new FormData();
  data.append("room_no", assign_room_form.elements["room_no"].value);
  data.append("booking_id", assign_room_form.elements["booking_id"].value);
  data.append("assign_room", "");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/new_bookings_crud.php", true);

  xhr.onload = function () {
    let myModal = document.getElementById("assign-room");
    let modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if (this.responseText == 1) {
      alert("success", "Room number allocated.");
      assign_room_form.reset();
      get_bookings();
    } else {
      alert("danger", "Can't asign room number");
    }

    console.log(this.responseText);
  };
  xhr.send(data);
});

function cancle_booking(id) {
  if (confirm("Are you sure,you want to cancle booking ?")) {
    let data = new FormData();
    data.append("booking_id", id);
    data.append("cancle_booking", "");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/new_bookings_crud.php", true);

    xhr.onload = function () {
      if (this.responseText == "1") {
        alert("success", "Bookking Canclled");
        get_bookings();
      } else {
        alert("danger", "Server Down!!");
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
  get_bookings();
};
