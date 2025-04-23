let add_room_form = document.getElementById("add_room_form");
let edit_room_form = document.getElementById("edit_room_form");
let add_image_form = document.getElementById("add_image_form");
add_room_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_room();
});
edit_room_form.addEventListener("submit", function (e) {
  e.preventDefault();
  submit_edit_room();
});
add_image_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_image();
});

function add_room() {
  let data = new FormData();
  data.append("name", add_room_form.elements["name"].value);
  data.append("area", add_room_form.elements["area"].value);
  data.append("price", add_room_form.elements["price"].value);
  data.append("quantity", add_room_form.elements["quantity"].value);
  data.append("adult", add_room_form.elements["adult"].value);
  data.append("children", add_room_form.elements["children"].value);
  data.append("desc", add_room_form.elements["desc"].value);
  let features = [];
  add_room_form.elements["features"].forEach((element) => {
    if (element.checked) {
      features.push(element.value);
    }
  });
  data.append("features", JSON.stringify(features));
  let facilities = [];
  add_room_form.elements["facilities"].forEach((element) => {
    if (element.checked) {
      facilities.push(element.value);
    }
  });
  data.append("facilities", JSON.stringify(facilities));
  data.append("add_room", "");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms_crud.php", true);

  xhr.onload = function () {
    let myModal = document.getElementById("add-room");
    let modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
    if (this.responseText == 1) {
      alert("success", "New Room Added");
      add_room_form.reset();
      get_all_rooms();
    } else {
      alert("danger", "Server Down");
    }

    console.log(this.responseText);
  };
  xhr.send(data);
}

function get_all_rooms() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("room-data").innerHTML = this.responseText;
  };
  xhr.send("get_all_rooms");
}

function edit_details(id) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms_crud.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    let data = JSON.parse(this.responseText);
    edit_room_form.elements["name"].value = data.roomdata.name;
    edit_room_form.elements["area"].value = data.roomdata.area;
    edit_room_form.elements["price"].value = data.roomdata.price;
    edit_room_form.elements["quantity"].value = data.roomdata.quantity;
    edit_room_form.elements["adult"].value = data.roomdata.adult;
    edit_room_form.elements["children"].value = data.roomdata.children;
    edit_room_form.elements["desc"].value = data.roomdata.description;
    edit_room_form.elements["room_id"].value = data.roomdata.id;
    edit_room_form.elements["facilities"].forEach((element) => {
      if (data.facilities.includes(Number(element.value))) {
        element.checked = true;
      }
    });
    edit_room_form.elements["features"].forEach((element) => {
      if (data.features.includes(Number(element.value))) {
        element.checked = true;
      }
    });
  };
  xhr.send("get_room=" + id);
}

function toggle_status(id, val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Status Toggled");
      get_all_rooms();
    } else {
      alert("danger", "Server Down");
    }
  };
  xhr.send("toggle_status=" + id + "&value=" + val);
}

function submit_edit_room() {
  let data = new FormData();
  data.append("edit_room", "");
  data.append("room_id", edit_room_form.elements["room_id"].value);
  data.append("name", edit_room_form.elements["name"].value);
  data.append("area", edit_room_form.elements["area"].value);
  data.append("price", edit_room_form.elements["price"].value);
  data.append("quantity", edit_room_form.elements["quantity"].value);
  edit_room_form;
  data.append("adult", edit_room_form.elements["adult"].value);
  data.append("children", edit_room_form.elements["children"].value);
  data.append("desc", edit_room_form.elements["desc"].value);
  let features = [];
  edit_room_form.elements["features"].forEach((element) => {
    if (element.checked) {
      features.push(element.value);
    }
  });
  data.append("features", JSON.stringify(features));
  let facilities = [];
  edit_room_form.elements["facilities"].forEach((element) => {
    if (element.checked) {
      facilities.push(element.value);
    }
  });
  data.append("facilities", JSON.stringify(facilities));

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms_crud.php", true);

  xhr.onload = function () {
    let myModal = document.getElementById("edit-room");
    let modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
    if (this.responseText == 1) {
      alert("success", " Room data edited");
      edit_room_form.reset();
      get_all_rooms();
    } else {
      alert("danger", "Server Down");
    }

    console.log(this.responseText);
  };
  xhr.send(data);
}

function add_image() {
  let data = new FormData();

  //  .files[0] will select only first file
  data.append("image", add_image_form.elements["image"].files[0]);
  data.append("room_id", add_image_form.elements["room_id"].value);
  data.append("add_image", "");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms_crud.php", true);

  xhr.onload = function () {
    if (this.responseText == "inv_img") {
      alert("danger", "Invalid Extension!!", "image-alert", "image-alert");
      get_general();
    } else if (this.responseText == "inv_size") {
      alert("danger", "Size should be less than 2MB!!", "image-alert");
    } else if (this.responseText == "upd_failed") {
      alert("danger", "Image Upload Failed", "image-alert");
    } else {
      alert("success", "New Image Added", "image-alert");
      let modalTitle = document.querySelector("#room-images .modal-title");
      rname = modalTitle.textContent;
      console.log(rname);

      room_images(add_image_form.elements["room_id"].value, rname);
      add_image_form.reset();
    }

    console.log(this.responseText);
  };
  xhr.send(data);
}

function room_images(id, rname) {
  add_image_form.elements["room_id"].value = id;
  let modalTitle = document.querySelector("#room-images .modal-title");
  modalTitle.textContent = rname;
  add_image_form.elements["image"].value = "";

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("room-image-data").innerHTML = this.responseText;
  };
  xhr.send("get_room_images=" + id);
}

function rem_image(image_id, room_id) {
  let data = new FormData();

  //  .files[0] will select only first file
  data.append("image_id", image_id);
  data.append("room_id", room_id);
  data.append("rem_image", "");
  let modalTitle = document.querySelector("#room-images .modal-title");
  rname = modalTitle.textContent;
  console.log(rname);
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms_crud.php", true);

  xhr.onload = function () {
    if (this.responseText == "1") {
      alert("success", "Image Removed!!", "image-alert");
      room_images(room_id, rname);
    } else {
      alert("danger", "Image removal failed", "image-alert");
    }
  };
  xhr.send(data);
}

function thumb_image(image_id, room_id) {
  let data = new FormData();

  //  .files[0] will select only first file
  data.append("image_id", image_id);
  data.append("room_id", room_id);
  data.append("thumb_image", "");
  let modalTitle = document.querySelector("#room-images .modal-title");
  rname = modalTitle.textContent;
  console.log(rname);
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/rooms_crud.php", true);

  xhr.onload = function () {
    if (this.responseText == "1") {
      alert("success", "Image Thumbnail Changed", "image-alert");
      room_images(room_id, rname);
    } else {
      alert("danger", "Thumbnail update failed", "image-alert");
    }
  };
  xhr.send(data);
}

function remove_room(room_id) {
  if (confirm("Are you sure,you want to delete this room ?")) {
    let data = new FormData();
    data.append("remove_room", "");
    data.append("room_id", room_id);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
      if (this.responseText == "1") {
        alert("success", "Room removed");
        get_all_rooms(room_id, rname);
      } else {
        alert("danger", "Room removal failed");
      }
    };
    xhr.send(data);
  }
}

window.onload = function () {
  get_all_rooms();
};
