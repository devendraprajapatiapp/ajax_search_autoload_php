<!DOCTYPE html>
<html lang="en">
  	<head>
	    <meta charset="UTF-8" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
	    <title>AJAX SEARCH</title>
	    <link href="css/style.css" rel="stylesheet" />
	    <link href="fevicon.png" rel="icon" />
	    <link href="css/bootstrap.min.css" rel="stylesheet" />
	    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet" />
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet" />
  	</head>
  <body>
    <div class="tm-container">
      <div class="tm-text-white tm-page-header-container">
      	<img src="logo.png" height="100" width="100">
        <h1 class="tm-page-header">AJAX SEARCH</h1>
      </div>
      <div class="tm-main-content">
        <section class="tm-section">
        	<div class="card">
          		<div class="card-body search">
      				<div class="form-inline float-left">
      					<input type="checkbox" id="autoStartCheck" class="form-check-input">
      					<label for="autoStartCheck" class="header-tr" style="color: #fff">Auto Load</label>
      				</div>
      				<div class="form-inline float-right">
      				   <input type="text" name="searchText" id="searchText" onkeydown="searchData();" class="form-control" placeholder="Search here...">
      					<i class="fas fa-search" onclick="searchData();"></i>
      				</div>
          		</div>
          		<div class="card-body">
          			<section class="tm-section">
			          <h2 class="tm-section-header">Search Result</h2>
			          <div class="tm-responsive-table">
			            <table id="table">
			            	<thead>
			            		<tr class="header-tr">
					                <th></th>
					                <th> Segment </th>
					                <th> Country </th>
					                <th> Product </th>
					                <th> Discount Band </th>
					                <th> Unit Sold </th>
					                <th> Manf. Price </th>
					                <th> Gross Goal </th>
					                <th> Discount </th>
					                <th> Sales </th>
					                <th> COGS </th>
					                <th> Profit </th>
					                <th> Date </th>
					                <th> Month </th>
					                <th> Month Name </th>
					                <th> Year </th>
					            </tr>
			            	</thead>
			              	<tbody id="tbody"></tbody>			              
			            </table>
			          </div>
			        </section>
          		</div>
          		<div class="text-center">
          			<button onclick="LoadMore();" class="btn btn-danger">Load More</button>
          		</div>
          	</div>
        </section>        
    </div>
    <div id="scriptStore" style="display: none">
    	<input type="hidden" name="countRow" id="countRow" value="0">
    </div>
  </body>
	<script src="js/jquery-3.4.1.min.js"></script>
	<script>
	  $(window).scroll(function() {
	   if($(window).scrollTop() + $(window).height() == $(document).height()) {
	  		if(document.getElementById('autoStartCheck').checked == true) {
	       		LoadMore();
	  		}
	   }
	  });
	  function searchData() {
	  	$(document).ready(function() {
      		$('#countRow').val(0);
	      	$.ajax({
	      		url: "getQueryData.php",
	      		type: "post",
	      		data: {search:$('#searchText').val(),type:"Search",count:$('#countRow').val()},
	      		success: function(res) {
	      			a = JSON.parse(res);
      				document.getElementById('tbody').innerHTML = '';
      				$('#countRow').val(a[0]);
      				$('tbody').append(a[1]);	      			
	      		}
	      	});	      
	  	})	
	  }
	  searchData();
	  function LoadMore() {
	  	$(document).ready(function() {
	      	$.ajax({
	      		url: "getQueryData.php",
	      		type: "post",
	      		data: {search:$('#searchText').val(),type:"loadMore",count:$('#countRow').val()},
	      		success: function(res) {
	      			a = JSON.parse(res);
      				$('#countRow').val(a[0]);
      				$('tbody').append(a[1]);
	      			
	      		}
	      	});	      
	  	})	
	  }
</script>
</html>