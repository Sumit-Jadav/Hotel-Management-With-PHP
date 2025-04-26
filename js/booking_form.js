let booking_form = document.getElementById("booking_form");
let info_loader = document.getElementById("info_loader");
let pay_info = document.getElementById("pay_info");

function check_availability() {
  let checkin_val = booking_form.elements["checkin"].value;
  let checkout_val = booking_form.elements["checkout"].value;
  booking_form.elements["pay_now"].setAttribute("disabled", true);
  if (checkin_val != "" && checkout_val != "") {
    pay_info.classList.add("d-none");
    pay_info.classList.replace("text-dark", "text-danger");
    info_loader.classList.remove("d-none");

    let data = new FormData();
    data.append("check_availibility", "");
    data.append("check_in", checkin_val);
    data.append("check_out", checkout_val);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/confirm_booking.php", true);

    xhr.onload = function () {
      let data = JSON.parse(this.responseText);
      if (data.status == "check_in_out_equal") {
        pay_info.innerText = "You cannot checkout on same day!";
      } else if (data.status == "check_out_earlier") {
        pay_info.innerText = "Check out date is earlier than check in!";
      } else if (data.status == "check_in_earlier") {
        pay_info.innerText = "Check-in date is earlier than today's date !";
      } else if (data.status == "unavailable") {
        pay_info.innerText = "Room not available for this date!";
      } else {
        pay_info.innerHTML =
          "No. of Days :" +
          data.days +
          "<br>Total Amount to Pay :&#8377;" +
          data.payment;
        pay_info.classList.replace("text-danger", "text-dark");
        booking_form.elements["pay_now"].removeAttribute("disabled");
      }
      pay_info.classList.remove("d-none");
      info_loader.classList.add("d-none");
    };
    xhr.send(data);
  }
}
