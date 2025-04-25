let login_form = document.getElementById("login-form");
login_form.addEventListener("submit", (e) => {
  e.preventDefault();
  let data = new FormData();
  data.append("email_mob", login_form.elements["email_mob"].value);
  data.append("pass", login_form.elements["pass"].value);
  data.append("login", "");
  let myModal = document.getElementById("loginModal");
  let modal = bootstrap.Modal.getInstance(myModal);
  modal.hide();

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/login_register.php", true);

  xhr.onload = function () {
    console.log(this.responseText);

    if (this.responseText == "inv_email_mob") {
      alert("danger", "Invalid Mobile or Email!!");
    } else if (this.responseText == "not_verified") {
      alert("danger", "Email is not varified!!");
    } else if (this.responseText == "inactive") {
      alert("danger", "Account banned by admin!!");
    } else if (this.responseText == "invalid_pass") {
      alert("danger", "Invalid Password!!");
    } else {
      let fileurl = window.location.href.split("/").pop().split("?").shift();
      if (fileurl == "room_details.php") {
        window.location = window.location.href;
      } else {
        window.location = window.location.pathname;
      }
    }
  };
  xhr.send(data);
});
