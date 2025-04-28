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
