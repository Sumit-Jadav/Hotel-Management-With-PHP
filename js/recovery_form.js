let recovery_form = document.getElementById("recovery-form");
recovery_form.addEventListener("submit", (e) => {
  e.preventDefault();
  let data = new FormData();
  data.append("email", recovery_form.elements["email"].value);
  data.append("token", recovery_form.elements["token"].value);
  data.append("pass", recovery_form.elements["newPass"].value);
  data.append("recover_user", "");
  let myModal = document.getElementById("recoveryModal");
  let modal = bootstrap.Modal.getInstance(myModal);
  modal.hide();

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/login_register.php", true);

  xhr.onload = function () {
    console.log(this.responseText);

    if (this.responseText == "failed") {
      alert("danger", "Password reset failed!!");
    } else {
      alert("success", "Password successfully changed");
      forgot_form.reset();
    }
  };
  xhr.send(data);
});
