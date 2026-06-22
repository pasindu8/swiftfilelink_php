function myFunction() {
      setTimeout(() => {
        document.getElementById("loader").style.display = "none"; 
        document.getElementById("myDiv").style.display = "flex";
        document.body.style.overflowY = "auto";
      }, 2000);
    }