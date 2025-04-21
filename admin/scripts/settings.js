let general_data;
let siteTitle = document.getElementById("site_title");
let siteAbout = document.getElementById("site_about");
let siteTitleInp = document.getElementById("site_title_inp");
let siteAboutInp = document.getElementById("site_about_inp");
let shutdown_toggle = document.getElementById("shutdown-toggle");
let general_s_form = document.getElementById("general-s-form");

// Contacts Details
let contact_data;
let contact_ids = [
  "address",
  "gmap",
  "pn1",
  "pn2",
  "email",
  "fb",
  "insta",
  "tw",
];
let iframe = document.getElementById("iframe");
let contact_form = document.getElementById("contacts_s_form");

// Team Member Section
let team_s_form = document.getElementById("team_s_form");
let member_name = document.getElementById("member_name_inp");
let member_picture = document.getElementById("member_picture_inp");
//  Event Listners
general_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  upd_general(siteTitleInp.value, siteAboutInp.value);
});
contact_form.addEventListener("submit", function (e) {
  e.preventDefault();
  upd_contacts();
});
team_s_form.addEventListener("submit", function (e) {
  e.preventDefault();
  add_member();
});
// Functions for general settings
function get_general() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    general_data = JSON.parse(this.responseText);
    console.log(general_data);
    siteTitle.innerText = general_data.site_title;
    siteAbout.innerText = general_data.site_about;
    siteTitleInp.value = general_data.site_title;
    siteAboutInp.value = general_data.site_about;
    if (general_data.shutdown == 0) {
      shutdown_toggle.checked = false;
      shutdown_toggle.value = 0;
    } else {
      shutdown_toggle.checked = true;
      shutdown_toggle.value = 1;
    }
  };
  xhr.send("get_general");
}

function upd_general(title, about) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    let myModal = document.getElementById("general-s");
    let modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
    if (this.responseText == 1) {
      alert("success", "Changes Saved!!");
      get_general();
    } else {
      alert("danger", "No Changes Made!!");
    }
    console.log(this.responseText);
  };
  // console.log(title + " , " + about);
  xhr.send("site_title=" + title + "&site_about=" + about + "&upd_general");
}

function upd_shutdown(val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    // Here responseText will always return 1 because 1 row is always affected so to check if previous shutdown is 0 then shutdown site.
    if (this.responseText == 1 && general_data.shutdown == 0) {
      alert("success", "Site has been shutdown");
    } else {
      alert("success", "Shutdown mode off!!");
    }
    get_general();
  };
  xhr.send("upd_shutdown=" + val);
}

// Functions for Contact details
function get_contacts() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    contact_data = JSON.parse(this.responseText);
    contact_data = Object.values(contact_data);
    console.log(contact_data);
    for (i = 0; i < contact_ids.length; i++) {
      document.getElementById(contact_ids[i]).innerText = contact_data[i + 1];
    }
    iframe.src = contact_data[contact_data.length - 1];
    contact_inp(contact_data);
  };
  xhr.send("get_contacts");
}

function contact_inp(data) {
  let contact_inp_id = [
    "address_inp",
    "gmap_inp",
    "pn1_inp",
    "pn2_inp",
    "email_inp",
    "fb_inp",
    "insta_inp",
    "tw_inp",
    "iframe_inp",
  ];
  for (let i = 0; i < contact_inp_id.length; i++) {
    document.getElementById(contact_inp_id[i]).value = data[i + 1];
  }
}

function upd_contacts() {
  let index = [
    "address",
    "gmap",
    "pn1",
    "pn2",
    "email",
    "fb",
    "insta",
    "tw",
    "iframe",
  ];
  let contacts_inp_id = [
    "address_inp",
    "gmap_inp",
    "pn1_inp",
    "pn2_inp",
    "email_inp",
    "fb_inp",
    "insta_inp",
    "tw_inp",
    "iframe_inp",
  ];
  let data_str = "";
  for (i = 0; i < index.length; i++) {
    data_str +=
      index[i] + "=" + document.getElementById(contacts_inp_id[i]).value + "&";
  }
  console.log(data_str);
  console.log(data_str.split("&"));
  data_str += "upd_contacts";
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    let mymodal = document.getElementById("contact-s");
    let modal = bootstrap.Modal.getInstance(mymodal);
    modal.hide();
    if (this.responseText == 1) {
      alert("success", "Changes Saved");
      get_contacts();
    } else {
      alert("danger", "No Changes Made");
    }
  };
  xhr.send(data_str);
}

// Team Member Add section

function add_member() {
  let data = new FormData();
  data.append("name", member_name.value);
  //  .files[0] will select only first file
  data.append("picture", member_picture.files[0]);
  data.append("add_member", "");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);

  xhr.onload = function () {
    let myModal = document.getElementById("team-s");
    let modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();
    if (this.responseText == "inv_img") {
      alert("danger", "Invalid Extension!!");
      get_general();
    } else if (this.responseText == "inv_size") {
      alert("danger", "Size should be less than 2MB!!");
    } else if (this.responseText == "upd_failed") {
      alert("danger", "Image Upload Failed");
    } else {
      alert("success", "New Member Added");
      member_name.value = "";
      member_picture.value = "";
      get_members();
    }

    console.log(this.responseText);
  };
  xhr.send(data);
}

function get_members() {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    document.getElementById("team-data").innerHTML = this.responseText;
  };
  xhr.send("get_members");
}

function rem_member($val) {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "ajax/settings_crud.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.responseText == 1) {
      alert("success", "Member Remove");
      get_members();
    } else {
      alert("danger", "Server Down");
    }
  };
  xhr.send("rem_member=" + $val);
}
window.onload = function () {
  get_general();
  get_contacts();
  get_members();
};
