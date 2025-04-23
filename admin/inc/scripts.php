<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"
></script>

<script>
  function alert(type,message,position='body'){
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div')
    element.innerHTML = `
      <div class="alert ${bs_class} custome-alert alert-dismissible fade show" role="alert">
        <strong class="me-3">${message}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `
    if (position == 'body') {
      
      document.body.append(element);
      element.classList.add("custome-alert");
    }
    else{
      document.getElementById(position).appendChild(element);
      
    }
    setTimeout(remAlert,2000);
  }

  function remAlert() {
    document.getElementsByClassName("alert")[0].remove();
  }
</script>


<script>
  function setActive(params) {
    let navbar = document.getElementById("dashboard-menu");
    let a_tag = navbar.getElementsByTagName("a");
    for(i=0;i<a_tag.length;i++){
      let file = a_tag[i].href.split("/").pop();
      let file_name = file.split(".")[0];
      if(document.location.href.indexOf(file_name) >= 0){
        a_tag[i].classList.add("active");
      }
    }
  }
  setActive();
</script>