function get_bookings(search = "") {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/refund_bookings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("table-data").innerHTML = this.responseText;
  };
  console.log("Send");
  xhr.send("get_bookings&search=" + search);
}

let assign_room_form = document.getElementById("assign_room_form");

function refund_booking(id) {
  if (confirm("Are you sure,you want to cancle booking ?")) {
    let data = new FormData();
    data.append("booking_id", id);
    data.append("refund_booking", "");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/refund_bookings_crud.php", true);

    xhr.onload = function () {
      if (this.responseText == "1") {
        alert("success", "Money Refunded");
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
