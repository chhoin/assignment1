@extends('app')
@section('head')
<link rel="stylesheet" href="{{ asset('asset/jasny-bootstrap/css/jasny-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('asset/sweetalert/sweetalert.css') }}">
@stop
@section('body')
	<div class="container">
		  <ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#home">REGISTRATION</a></li>
		    <li><a data-toggle="tab" href="#menu1">ADMIN</a></li>
		  </ul>

		  <div class="tab-content">
		  	<!-- Sign up Form-->
		    <div id="home" class="tab-pane fade in active">
		    <br/>
		      <form action="" id="formstudent" enctype="multipart/form-data">
					<div class="form-horizontal">
						<h3 style="color:green">Registration Information:</h3><br/>
						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Attendee Type :</label>
							<div id="list" class="col-sm-10">
								<select id="attendee_title" name="attendee_title" class="form-control">
								</select>							
								<small id="checkattendeetitle" class="msg" style="color:red"></small>
							</div>
						</div>
						
						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Extra Guest :</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="extra_guest" name="extra_guest" value="">
								<small id="checkextra_guest" class="msg" style="color:red"></small>
							</div>
						</div>
						
						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Attending Dinner :</label>
							<div class="col-sm-5">
								<input type="checkbox" class="form-control" id="dinner" name="dinner" value="" >
								<small id="checkdinner" class="msg" style="color:red"></small>
								
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Recieve Papper :</label>
							<div class="col-sm-5">
								<input type="checkbox" class="form-control" id="paper" name="paper" value="">
								<small id="checkpaper" class="msg" style="color:red"></small>
							</div>
						</div>
						<h3 style="color:green">Personal Information:</h3><br/>
						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Name :</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="name" name="name" value="">
								<small id="checkname" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Address :</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="address" name="address" value="">
								<small id="checkaddress" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Phone :</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="phone" name="phone" value="">
								<small id="checkphone" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Email :</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="email" name="email" value="">
								<small id="checkemail" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group" >
							<label for="input-text" class="col-sm-2 control-label">Job Type :</label>
							<div id="list" class="col-sm-10">
								<select id="job_type" name="job_type" class="form-control">
								</select>
								<small id="checkjobtype" class="msg" style="color:red"></small>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
								<div class="col-sm-5">
									<button type="button" id="btnInsertUser" onclick="InsertUser();" class="btn btn-success">Confirm</button>
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
										<input type="button"  onclick="" value="search" class="btn btn-success">
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
<script src="{{ asset('asset/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>
<script src="{{ asset('asset/js/bootpage.js') }}"></script>
<script src="{{ asset('asset/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript">
	var limit=0;
	var offset=1;
	var totalofrecord =0;
	var numofpage=1;
	var url="{{ URL::to('/') }}";


	showAttendeeType(); // call function Show Attendee Type into Select Dropdown List
	function showAttendeeType(){
		$.ajax({
	    	url: url+'/attendeeall',
	        type: 'get',
	        contentType: 'application/json;charset=utf-8',
	        success: function(data) {
	        if(data.STATUS == true) {
	           	var str="";
	           	str+="<option value='0' selected>"+"---Choose Attendee Type--"+"</option>";
					for(var i=0; i<data.DATA.length ; i++){
						str += "<option value='"+data.DATA[i].attendee_id+"'>"+data.DATA[i].attendee_title+"</option>";
					}
		           	$("#attendee_title").html(str);
	        	}
	       	},
	        error: function(data) {
	            alert("listAll() unseccess data");
			}
	    });	  
	    
	}
	showJobType();
	function showJobType(){
		$.ajax({
	    	url: url+'/joball',
	        type: 'get',
	        contentType: 'application/json;charset=utf-8',
	        success: function(data) {
	        if(data.STATUS == true) {
	           	var str="";
	           		str+="<option value='0' selected>"+"---Choose Job Type---"+"</option>";
					for(var i=0; i<data.DATA.length; i++){
						str += "<option value='"+data.DATA[i].job_id+"'>"+data.DATA[i].job_title+"</option>";
					}
		           	$("#job_type").html(str);
	        	}
	       	},
	        error: function(data) {
	            alert("List Job Type() unseccess data");
			}
	    });	  
	}
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
	
	function InsertUser(){
		//Register Information
		var attendee_title = $("#attendee_title").val();
		var extra_guest = $("#extra_guest").val();
		var dinner = document.getElementById("dinner").checked;
		var paper = document.getElementById("paper").checked;
		// Personal Information
		var name = $("#name").val();
		var address = $("#address").val();
		var email = document.getElementById("email").value;
		var phone = $("#phone").val();
		var job_type = $("#job_type").val();
		
		if(validateAttendeeTitle() && validateName() &&  validatePhone() && valideEmail() && validateJobType()){
			$.ajax({
		       	url: url+'/user?attendee_id_for='+attendee_title+'&extra_guest='+extra_guest+'&dinner='+dinner+'&paper='+paper+'&name='+name+'&address='+address+'&phone='+phone+'&email='+email+'&job_id_for='+job_type,
		        type: 'post',
		        contentType: false,
		        contentType: 'application/json;charset=utf-8',
		        //data: JSON.stringify(JSONObject),
		        success: function(data) {
			        if(data.STATUS == true){
			           	swal("User has been registered.", "", "success");
				        myClear();	
			        }
			        else if(data.STATUS == false) {
			           	$("#checkname").text(data.ERROR.name);
			           	$("#checkemail").text(data.ERROR.email);
			           	$("#checkphone").text(data.ERROR.phone);
			           	$("#checkjobtype").text(data.ERROR.job_id_for);
			           	$("#checkattendeetitle").text(data.ERROR.attendee_id_for);
				    }
				    else{
			           	alert("insert error check url");
				    }
		        },
		        error: function(data){
		           	alert("Create User unseccess data.");
		        }
		    });	
		}    	
	}
	function myClear() {
		$("#name").val("");
		$("#title").val("");
		$("#address").val("");
		$("#extra_guest").val("");
		$("#phone").val("");
		$("#email").val("");
		var d = document.getElementById("dinner");d.checked=false;
		var p = document.getElementById("paper");p.checked=false;
		$("#attendee_title").css("border", "solid 2px #ccc");
		$("#checkattendeetitle").text("");
		$("#job_type").css("border", "solid 2px #ccc");
	  	$("#checkjobtype").text("");
	  	$("#name").css("border", "solid 2px #ccc");
		$("#checkname").text("");
		$("#phone").css("border", "solid 2px #ccc");
		$("#checkphone").text("");
		$("#email").css("border", "solid 2px #ccc");
		$("#checkemail").text("");
		$("select#attendee_title").val("0");
		$("select#job_type").val("0");
	}

	function validateAttendeeTitle(){
		var attendee_title= $("#attendee_title").val();
			
		    if(attendee_title == 0) {
			   	$("#attendee_title").css("border", "solid 2px red");
			   	$("#checkattendeetitle").text("Please choose Attendee Type!");
			   	return false;
			    
			}
			else{
			   	$("#attendee_title").css("border", "solid 2px green");
			   	$("#checkattendeetitle").text("");
			    return true;
			}
	}
	function validateJobType(){
		var job_type= $("#job_type").val();
			
		    if(job_type == 0) {
			   	$("#job_type").css("border", "solid 2px red");
			   	$("#checkjobtype").text("Please choose Job Type!");
			   	return false;
			    
			}
			else{
			   	$("#job_type").css("border", "solid 2px green");
			   	$("#checkjobtype").text("");
			    return true;
			}
	}

	function validateName(){
		var name= $("#name").val();
		var characterReg = /^[\sa-zA-Z0-9!@#$%^&*()-_=+\[\]{}|\\:?/.,]{3,255}$/;
	    if(!characterReg.test(name)) {
			$("#name").css("border", "solid 2px red");
			$("#checkname").text("Please fill your name!");
			return false;
		}
		else{
			$("#name").css("border", "solid 2px green");
			$("#checkname").text("");
			return true;
		}
	}
	function validatePhone(){
			var name= $("#phone").val();
			var characterReg = /^[\s0-9$]{1,100}$/;
			    if(!characterReg.test(name)) {
			    	$("#phone").css("border", "solid 2px red");
			    	$("#checkphone").text("Phone require number only!");
			    	   return false;
			    
			    }else{
			    	$("#phone").css("border", "solid 2px green");
			    	$("#checkphone").text("");
			    	return true;
			    }
		}
		function valideEmail(){
			var name= $("#email").val();
			    if(name == "" || name === null) {
			    	$("#email").css("border", "solid 2px red");
			    	$("#checkemail").text("Email require!");
			    	   return false;
			    
			    }else{
			    	$("#email").css("border", "solid 2px green");
			    	$("#checkemail").text("");
			    	return true;
			    }
		}
</script>
@stop
