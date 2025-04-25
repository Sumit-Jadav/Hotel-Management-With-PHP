let forgot_form = document.getElementById("forgot-form");
forgot_form.addEventListener("submit", (e) => {
  e.preventDefault();
  let data = new FormData();
  data.append("email", forgot_form.elements["email"].value);
  data.append("forgot_pass", "");
  let myModal = document.getElementById("forgotModal");
  let modal = bootstrap.Modal.getInstance(myModal);
  modal.hide();

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/login_register.php", true);

  xhr.onload = function () {
    console.log(this.responseText);

    if (this.responseText == "inv_email") {
      alert("danger", "Invalid Email!!");
    } else if (this.responseText == "not_verified") {
      alert("danger", "Email is not varified!!");
    } else if (this.responseText == "inactive") {
      alert("danger", "Account banned by admin!!");
    } else if (this.responseText == "mail_failed") {
      alert("danger", "Cannot send email!!");
    } else if (this.responseText == "upd_failed") {
      alert("danger", "Password reset failed!!Try again later.");
    } else {
      alert("success", "Password reset link send to email");
      forgot_form.reset();
    }
  };
  xhr.send(data);
});
