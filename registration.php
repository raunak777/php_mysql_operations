<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<style>

  #otpfield
  {
    display: none;
  }
</style>
<body>
  <?php include 'config.php'; 
  include 'connection.php';
  ?>
  <script type="text/javascript">
    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
      }
      return true;
    }
  </script>
  <div class="div1">
    <h1>Preschool Package Registration</h1><hr>
    <label for="pname">Parent(s) Name(s)</label>
    <input type="text" id="pname" name="pname" >

    <label for="email">Email Address</label>
    <input type="email" id="email" name="email" placeholder="email">
    <input class="btn btn-danger" name="otpbtn" id="otpbtn" type="button" value="Get OTP">
    <input type="text" id="otpfield" name="otpfield"  placeholder="Enter otp.."><br>
    <label for="sname">Student's Name</label>
    <input type="text" id="sname" name="sname" >
    <label>Student Gender</label><br>
    <input type="radio" name="gender" id="gender" value="male" >
    <label>Male</label><br>
    <input type="radio" name="gender" id="gender" value="female">
    <label>Female</label><br><br>
    <label for="mob">Student's Birthday</label>
    <input type="date" id="birthday" name="birth" >
    <label for="mob">Contact number</label>
    <input type="text" id="mobile" onkeypress="return isNumber(event)" maxlength="10" name="mobile" >
    <label>Do you received Text at this number?</label><br>
    <input type="radio" name="text" id="text" value="yes" >
    <label>Yes</label><br>
    <input type="radio" name="text" id="text" value="no">
    <label>No</label><br><br>

    <label for="address">Address</label>
    <input type="text" id="address" name="address" >
    <label for="city">City</label>
    <input type="text" id="city" name="city" >
    <label for="code">Zip code</label>
    <input type="number" id="code" name="code" onKeyPress="if(this.value.length==6) return false;" >
    <input type="submit" name="register" id="register" value="Submit">
  </div>
</div>

<script type="text/javascript">
  $(function(){
    $("#otpbtn").on("click",function(){
      var email = $("#email").val();
      if (email == '') {
        alert("Enter email");
      }
      else{
        $("#otpfield").show();
        $.ajax({
          type: "POST",
          url: "mailer.php",
          data: {email : email},
          success: function(data){
            alert(data);
          }
        });
      }
    });

    $("#register").on("click", function(){
      var parents = $("#pname").val();
      var email = $("#email").val();
      var sname = $("#sname").val();
      var gender = $("#gender").val();
      var birthday = $("#birthday").val();
      var mobile = $("#mobile").val();
      var text = $("#text").val();
      var address = $("#address").val();
      var city = $("#city").val();
      var code = $("#code").val();
      var otpfield = $("#otpfield").val();

      if (parents == '' || email== '' || sname== '' || gender=='' || birthday=='' || mobile== ''|| text== ''|| address=='' || city =='' || code== '') {
        alert("All field required!");
      }
      else if(otpfield == '')
      {
        alert("Pls enter otp.");
      }
      else{
        $.ajax({
          type: "POST",
          url: "registrationform.php",
          data: { parents: parents, email : email, sname : sname, gender : gender, birthday : birthday, mobile : mobile, text : text, address : address, city : city,  code : code, otpfield : otpfield },
          success: function(data)
          {
            console.log(data);
            if(data == 1)
            {
              alert("Otp verified successfully and data inserted");
              location.replace('index.php');
            }
            else{
              alert("OTP incorrect");
            }
          }
        });
      }
    });
  });

</script>

</body>
</html>

