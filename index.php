<?php
  session_start(); 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grab Excel Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mb-5">
      <h1 class="text-center m-5">Grab Excel Data</h1>
      <?php
        if(isset($_SESSION['success'])){
        ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['success']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
       
       <?php 
       }
        unset($_SESSION['success']);
        
      ?>
      <?php
        if(isset($_SESSION['error'])){
        ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
       
       <?php 
       }
         unset($_SESSION['error']);
      ?>

      <!-- Buttons to show form -->
      <div class="row">
        <button class="btn btn-primary m-2" onclick="showForm('form1')">CLICK HERE FOR UPLOAD GST KARZA  EXCEL FILE</button>
        <button class="btn btn-primary m-2" onclick="showForm('form2')">CLICK HERE FOR UPLOAD BANKING NOVEL</button>
        <button class="btn btn-primary m-2" onclick="showForm('form3')">CLICK HERE FOR UPLOAD CUSTOMER DATA</button>
      </div>

      <!-- Form 1 -->
      <form id="form1" action="gstr1_periodical_summary.php" method="POST" enctype="multipart/form-data" style="display: none;">
        <div class="row">
          <div class="input-group mb-3">
            <input type="file" name="excel_file" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
          </div>
          <input type="submit" name="submit" class="btn btn-success" value="Submit Gst Karza File">
        </div>
      </form>

      <!-- Form 2 -->
      <form id="form2" action="analysisprocess.php" method="POST" enctype="multipart/form-data" style="display: none;">
      <div class="row">
          <div class="input-group mb-3">
            <input type="file" name="excel_file" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
          </div>
          <input type="submit" name="submit" class="btn btn-success" value="Submit Banking Novel ">
        </div>
      </form>

      <!-- Form 3 -->
      <form id="form3" action="cust_details.php" method="POST" enctype="multipart/form-data" style="display: none;">
        <div class="row">
          <div class="input-group mb-3">
            <input type="file" name="excel_file" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
          </div>
          <input type="submit" name="submit" class="btn btn-success" value="Submit Customer Data">
        </div>
      </form>

    </div>



    <div class="container">
      <div class="row mt-5 text-center" style="margin-top: 300px !important;">
        <h2 class="mt-5">Please Upload file and complete the above section then with bellow</h2>
        <div class="col-3">
          <form action="derived_gst.php" method="POST">
            <button type="submit" class="btn btn-primary">Derived GST Periodical Summary</button>
          </form>
        </div>
        <div class="col-3">
          <form action="derived_gst.php" method="POST">
            <button type="submit" class="btn btn-primary">Derived GST Periodical Summary</button>
          </form>
        </div>
        <div class="col-3">
          <form action="derived_gst.php" method="POST">
            <button type="submit" class="btn btn-primary">Derived GST Periodical Summary</button>
          </form>
        </div>
        <div class="col-3">
          <form action="derived_gst.php" method="POST">
            <button type="submit" class="btn btn-primary">Derived GST Periodical Summary</button>
          </form>
        </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
      function showForm(formId) {
        // Hide all forms
        document.querySelectorAll('form').forEach(form => form.style.display = 'none');
        // Show the selected form
        document.getElementById(formId).style.display = 'block';
      }
    </script>
  </body>
</html>
