function cancel_booking(id) {
  if (confirm("Are you sure you want to cancel booking?")) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/cancel_booking_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      console.log(typeof this.responseText);
      if (this.responseText == 1) {
        console.log("called");
        window.location.href = "bookings.php?cancel_status=true";
      } else {
        alert("danger", "Cancellation failed");
      }
    };
    xhr.send("cancel_booking&id=" + id);
  }
}

let review_form = document.getElementById("review-form");
function review_room(bid, rid) {
  review_form.elements["booking_id"].value = bid;
  review_form.elements["room_id"].value = rid;
}

review_form.addEventListener("submit", (e) => {
  e.preventDefault();
  let data = new FormData();
  data.append("review_form", "");
  data.append("rating", review_form.elements["rating"].value);
  data.append("review", review_form.elements["review"].value);
  data.append("booking_id", review_form.elements["booking_id"].value);
  data.append("room_id", review_form.elements["room_id"].value);

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/review_booking_crud.php", true);
  xhr.onload = function () {
    if (this.responseText == 0) {
      let myModal = document.getElementById("reviewModal");
      let modal = bootstrap.Modal.getInstance(myModal);
      modal.hide();
      alert("danger", "Rating & Review Failed!!");
    } else {
      window.location.href = "bookings.php?review_status=true";
    }
  };
  xhr.send(data);
});
