<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
	<div class="container">
	  <div class="row">
	    <div class="col-5">
				<form id="form" method="post" autocomplete="on">
			  <div class="form-group">
			  	<br><h4>Database 1</h4><br>
    			<h5>Database Username :</h5>
    			<input type="text" class="form-control" name="user1" value="<?php echo $_SESSION['user1']; ?>">
  			</div>
  			<div class="form-group">
    			<h5>Database Password :</h5>
    			<input type="text" class="form-control" name="password1" value="<?php echo $_SESSION['password1']; ?>">
  			</div>
  			<div class="form-group">
    			<h5>Database Name :</h5>
    			<input type="text" class="form-control" name="dbname1" value="<?php echo $_SESSION['dbname1']; ?>">
  			</div>
  			<div class="form-group">
    			<h5>Database Host :</h5>
    			<input type="text" class="form-control" name="host1" value="<?php echo $_SESSION['host1']; ?>">
  			</div>
			</div>
			<div class="col-2">
			</div>
	    <div class="col-5">
				<div class="form-group">
			  	<br><h4>Database 2</h4><br>
    			<h5>Database Username :</h5>
    			<input type="text" class="form-control" name="user2" value="<?php echo $_SESSION['user2']; ?>">
  			</div>
  			<div class="form-group">
    			<h5>Database Password :</h5>
    			<input type="text" class="form-control" name="password2" value="<?php echo $_SESSION['password2']; ?>">
  			</div>
  			<div class="form-group">
    			<h5>Database Name :</h5>
    			<input type="text" class="form-control" name="dbname2" value="<?php echo $_SESSION['dbname2']; ?>">
  			</div>
  			<div class="form-group">
    			<h5>Database Host :</h5>
    			<input type="text" class="form-control" name="host2" value="<?php echo $_SESSION['host2']; ?>">
  			</div>
			</div>
			  <button
			  	type="submit"
			  	class="btn btn-secondary btn-lg btn-block"
			  	onclick="submitForm('dbDiff.php')"
			  	value="Table-Diff">
		  		Table-Diff
			  </button>
			  <button
				  	type="submit"
				  	name="submit"
				  	class="btn btn-primary btn-lg btn-block"
				  	onclick="submitForm('columnDiff.php')"
				  	value="Column-Diff">
			  		Column-Diff
			  </button>
			</form>
	  </div>
	</div>
  <center>
    <img src="https://www.vairosoft.com/assets/public/img/botlogo.png" style="margin-top: 50px;">
  </center>
</body>
<script type="text/javascript">
  function submitForm(action)
  {
    var form = document.getElementById('form');
    form.action = action;
    form.submit();
  }
</script>
</html>