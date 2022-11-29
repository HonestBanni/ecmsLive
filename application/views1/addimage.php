<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Restricted</title>
 
<body>
<div class="container_16">
  <div class="grid_6 prefix_5 suffix_5">
      <?php
      echo form_open_multipart('ReportsController/uplodImg');
      ?>
   	  <h1>Restricted</h1>
          <input type="file" name="imageName" >
          <input type="submit">
    	 <?php
      echo form_close();
      ?>
  </div>
</div>
<br clear="all" />
</body>
</html>
