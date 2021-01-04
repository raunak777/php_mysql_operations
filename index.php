<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<?php include 'config.php'; 
include 'connection.php';
?>
<body>
<div class="p-4 bg-secondary text-white text-center"><h1><b>PHP MYSQL</b></h1>
    </div>
    <div class="p-4 bg-info text-center">
      <a href="registration.php"><button class="btn btn-danger"> Registration Form</button></a>
      <a href="login.php"><button class="btn btn-danger"> Login</button></a>
    </div>
    
      <div class="p-3 text-white bg-warning mb-2"><input style="width: 50%" type="text" class="srch ml-5" name="search" placeholder="Search..">
        
        <div class="float-right  mr-5">
          <label style="font-weight: 900" >Select column:</label>
          <select class="form-control" id="column">
             <option value="id">STD ID</option>
             <option value="email">Email</option>
             <option value="sname">sname</option>
             <option value="sgender">Gender</option>
             <option value="sbirthday">Birthday</option>
             <option value="contact">Contact</option>
             <option value="address">Address</option>
             <option value="city">City</option>
             <option value="zipcode">Zipcode</option>
          </select>
        </div>
        <div class="float-right  mr-5">
          <label style="font-weight: 900" >Sorting:</label>
          <select class="form-control" id="sort">
             <option value="asc">Ascending</option>
             <option value="desc">Descending</option>
          </select>
        </div>
      </div>
    <div id="datashow" class="container-fluid text-center pb-5"></div>
    
    <script type="text/javascript">
      $(function(){
        //data load
        function loadData(){
          $.ajax({
            type: "POST",
            url: "dataload.php",
            data: {'data':"yes"},
            success: function(data)
            {
              $("#datashow").html(data);
            }
          });
        }
        loadData();
        //data deleted
        $(document).on("click", ".del-btn", function(){
          if(confirm("Do you really want to delete this?")){
          var currentid= $(this).data("did");
          //alert(currentid);

          $.ajax({
            type: "POST",
            url: "delete.php",
            data: { crid : currentid },
            success: function(data)
            {
              if (data == 1) {
                alert("Data deleted");
                 loadData();
              }
              else{
                alert("Can't deleted");
              }
            }
          });
        }
        });
        //Data update
        $(document).on("click",".edit-btn", function(){
          var currentid= $(this).data("eid");
          //alert(currentid);
          location.replace("updateform.php?id="+currentid);
        });
        // Live search or filter
        $(".srch").on("keyup", function(){
          var search=$(this).val();
          $.ajax({
            type: "POST",
            url: "dataload.php",
            data: {"data" : "filter"  ,livesearch: search},
            success: function(data){
              $("#datashow").html(data);
            }
          });
        });
        // order by columns name
        $("#sort, #column").change(function(){
          var sort=$("#sort").val();
          var column=$("#column").val();
          console.log(sort+ ""+ column);
        $.ajax({
            type: "POST",
            url: "dataload.php",
            data: {'data':"no", sort : sort, column : column},
            success: function(data)
            {
              $("#datashow").html(data);
            }
          });
         });
      });
    </script>
</body>
</html>