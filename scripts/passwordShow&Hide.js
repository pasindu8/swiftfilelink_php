    var a = 0;
    var b = 0;
    function pass() {
      if(a == 1) {
        document.getElementById('password').type = 'password';
        document.getElementById('pass-icon').className ='pass-icon far fa-eye-slash';
        a = 0;
      } else {
        document.getElementById('password').type = 'text';
        document.getElementById('pass-icon').className ='pass-icon far fa-eye';
        a = 1;
      }
    }
    
    function passcon() {
      if(b == 1) {
        document.getElementById('conpassword').type = 'password';
        document.getElementById('conpass-icon').className ='pass-icon far fa-eye-slash';
        b = 0;
      } else {
        document.getElementById('conpassword').type = 'text';
        document.getElementById('conpass-icon').className ='pass-icon far fa-eye';
        b = 1;
      }
    }