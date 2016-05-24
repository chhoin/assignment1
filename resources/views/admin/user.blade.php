@extends('app')
@section('head')
@stop
@section('body')
	
	<div class="container">
		  <ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#home">Registation Information</a></li>
		    <li><a data-toggle="tab" href="#menu1">Admin</a></li>
		  </ul>

		  <div class="tab-content">
		  	<!-- Sign up Form-->
		    <div id="home" class="tab-pane fade in active">
		    <br/>
		      <form action="" id="formstudent" enctype="multipart/form-data">
					<div class="form-horizontal">

						<div class="form-group" >
							<label for="input-text" class="col-sm-2 control-label">Attendee Type :</label>
							<div id="list" class="col-sm-10">
								<select class="form-control" id="category" name="category">
										<option value="">11</option>
										<option value="">22</option>
								</select>
								<small id="checkcategory" class="msg" style="color:red"></small>
							</div>
						</div>
						
						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Extra Guest :</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="title" name="title" value=""  required="required">
								<small id="checktitle" class="msg" style="color:red"></small>
							</div>
						</div>
						
						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Attednding Dinner :</label>
							<div class="col-sm-1">
								<input type="checkbox" class="form-control" id="title" name="title" value=""  required="required">
								<small id="checktitle" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Recieve Papper :</label>
							<div class="col-sm-1">
								<input type="checkbox" class="form-control" id="title" name="title" value=""  required="required">
								<small id="checktitle" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Name :</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="title" name="title" value=""  required="required">
								<small id="checktitle" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Address :</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="title" name="title" value=""  required="required">
								<small id="checktitle" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Phone :</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="title" name="title" value=""  required="required">
								<small id="checktitle" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Extra Guest :</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="title" name="title" value=""  required="required">
								<small id="checktitle" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group" >
							<label for="input-text" class="col-sm-2 control-label">Job Type :</label>
							<div id="list" class="col-sm-10">
								<select class="form-control" id="category" name="category">
										<option value="">11</option>
										<option value="">22</option>
								</select>
								<small id="checkcategory" class="msg" style="color:red"></small>
							</div>
						</div>
						
					</div>
				</form>
		    </div>

		    <!-- admin action-->
		    <div id="menu1" class="tab-pane fade">
		      	<br/>
		        <form action="" id="formstudent" enctype="multipart/form-data">
					<div class="form-horizontal">

						<div class="form-group" >
							<label for="input-text" class="col-sm-2 control-label">Attendee Type :</label>
							<div id="list" class="col-sm-4">
								<select class="form-control" id="attendeeType" onchange="changeType();" name="category">
										<option value="all">All Attendees</option>
										<option value="individual">Individual Attendee</option>
								</select>
								<small id="checkcategory" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group" id="searchAll">
							<label for="input-text" class="col-sm-2 control-label"></label>
							<div  class="col-sm-10">
								<label><input type="radio" checked name="searchAll" value="1">All Research</label>
								<label><input type="radio" name="searchAll" value="2">All Student</label>
								<label><input type="radio" name="searchAll" value="3">All Attentdees</label>
								<small id="checkcategory" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group" id="searchName" style="display: none;">
							<label for="input-text" class="col-sm-2 control-label"></label>
							<div class="input-group  " >
								<input type="text" class="form-control" id="search" name="search" value="" placeholder="Search for..."> 
									<span class="input-group-btn"> 
										<input type="button"  onclick="SearchArticle();" value="search" class="btn btn-success">
									</span>
							</div>
							
						</div>
					</div>
				</form>

		    </div>

		</div>
	</div>
@stop

@section('foot')
<script type="text/javascript">
	function changeType() {
		var type = $("#attendeeType").val();
	
		if (type == "all") {
			$("#searchAll").show();
			$("#searchName").hide();
		}
		else {
			$("#searchAll").hide();
			$("#searchName").show();
		}
	}

	$(document).ready(function() {
		$('input[type=radio][name=searchAll]').change(function() {
		    if (this.value == '1') {
		        alert("All Research");
		    }
		    else if (this.value == '2') {
		        alert("All Student");
		    }
		    else if (this.value == '3') {
		        alert("All Attentdees");
		    }
		});
	});
</script>
@stop
