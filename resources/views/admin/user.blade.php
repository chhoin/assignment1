@extends('app')
@section('head')
<link rel="stylesheet" href="{{ asset('asset/jasny-bootstrap/css/jasny-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('asset/sweetalert/sweetalert.css') }}">
@stop
@section('body')
	<div class="container">
		  <ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#home">REGISTRATION</a></li>
		    <li><a data-toggle="tab" onclick="mystartListByAttendeeType(0);" href="#menu1">ADMIN</a></li>
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
								<select id="attendee_title" name="attendee_title" class="form-control" required="required">
								</select>							
								<small id="checkattendeetitle" class="msg" style="color:red"></small>
							</div>
						</div>
						
						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Extra Guest :</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="extra_guest" name="extra_guest" value="" placeholder="Extra guest">
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
								<input type="text" class="form-control" id="name" name="name" value="" placeholder="Name">
								<small id="checkname" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Address :</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="address" name="address" value="" placeholder="Address">
								<small id="checkaddress" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Phone number:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="phone" name="phone" value="" placeholder="Phone number">
								<small id="checkphone" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group">
							<label for="input-text" class="col-sm-2 control-label">Email address :</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="email" name="email" value="" placeholder="Email address">
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
		    <div id="menu1"  class="tab-pane fade"><br/>
		        <form action="" id="formstudent" enctype="multipart/form-data">
		        	<h3 style="color:green">Administrator Information:</h3><br/>
					<div class="form-horizontal">

						<div class="form-group" >
							<label for="input-text" class="col-sm-2 control-label">Attendee Types :</label>
							<div id="list" class="col-sm-4">
								<select class="form-control" id="attendeeType" onchange="changeType();" name="category">
									<option value="all">All Attendees</option>
									<option value="individual">Individual Attendees</option>
								</select>
								<small id="checkcategory" class="msg" style="color:red"></small>
							</div>
						</div>

						<div class="form-group" id="searchAll">
							<label for="input-text" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<div id="rdgroup"></div>
							</div>
						</div>

						<div class="form-group" id="searchName" style="display: none;">
							<div class="container">
								<div class="col-sm-12 pull-center">

									<label for="input-text" class="col-sm-12 control-label"></label>
									<div class="input-group">
										<input type="text" class="form-control" id="search" name="search" value="" placeholder="Search for..."> 
										<span class="input-group-btn"> 
											<input type="button"  onclick="Search();" value="search" class="btn btn-success">
										</span>
									</div>
									<small id="checksearch" class="msg" style="color:red"></small>	
								</div>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="panel panel-primary">
								<div class="panel-heading">
									Attendees List
								</div>
								<div class="panel-body">
									<table class="table table-condensed">
										<thead>
											<tr class="success">
												<th width="5%">No</th>
												<th width="20%">Name</th>
												<th width="20%">Phone</th>
												<th width="30%">Address</th>
												<th width="15%">Attendee Type</th>
												<th width="20%">Job Type</th>
											</tr>
										</thead>
									<tbody>

									</tbody>
									</table>

									<div class="text-center">
										<div id="pagination"></div>
									</div>
								</div>
								
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
	
	mystartListByAttendeeType(0);

	/*
	* Show Attendee type to Dropdown List #job_type
	* by Sotheara 2016-05-24
	*/
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
	            console.log("erorr:"+ data);
			}
	    });	   
	}
	/*
	* Show Job Type to Dropdown List #job_type
	* by Sotheara 2016-05-24 9:34PM
	*/
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
	            console.log("erorr:"+ data);
			}
	    });	  
	}
	/*
	* Show Attendee Type convert into Radio Button
	* Method Get from tbl_attendee_type
	* by Sotheara 2016-05-28 3:20PM
	*/
	showAttendeeTypeRadio();
	function showAttendeeTypeRadio(){
		$.ajax({
	    	url: url+'/attendeeall',
	        type: 'get',
	        contentType: 'application/json;charset=utf-8',
	        success: function(data) {
	        	if(data.STATUS == true) {
	           		var str="";
	           		str += "<label><input type='radio' id='rdAttendeeType' checked='checked' name='rdAttendeeType'  value='0'>"+"All Attentdees"+"</label>&nbsp&nbsp";
						for(var i=0; i<data.DATA.length; i++){
							str += "<label><input type='radio' id='rdAttendeeType' name='rdAttendeeType' value='"+data.DATA[i].attendee_id+"'>"+data.DATA[i].attendee_title+"</label>&nbsp&nbsp";
						}
			           	$("#rdgroup").html(str);
	        		}
	       		},
	        error: function(data) {
	            console.log("erorr:"+ data);
			}
	    });	
	}

	/*
	* Event Handler Click on Dynmaic Radio Button from DB
	* by Sotheara edited: by Chhoin 2016-05-27 10:48 PM
	*/
	$(document).on('click',"#rdAttendeeType", function(){
		var type_id = $('input[name=rdAttendeeType]:checked').val();
		mystartListByAttendeeType(type_id);
	});	
	
	/*
	* Start 
	*/
	function mystartListByAttendeeType(type_id) {
		limit=5;	
		//var x = $('input[name=rdAttendeeType]:checked').val();																					
		//alert(limit);
		$.ajax({   
		url: url+'/user/type/'+type_id+'/page/'+offset+'/item/'+limit,
		type: 'get',
		contentType: 'application/json;charset=utf-8',
		success: function(data) {
		//console.log(data);
		    if(data.STATUS == true) {
		        totalofrecord=data.PAGINATION.TOTALRECORD;
			    numofpage=data.PAGINATION.TOTALPAGE;
			    loadPaginationUserByAttendeeType();
			    showListUserByAttendeeType(1, type_id);
			   
			}
		},
		error: function(data) {
		    console.log("erorr:"+ data);
		}
		});	   
	}	
	
	/*
	* Query list user from DB and Display result to #tbody
	* by Sotheara Datetime: 2016-05-28 3:37 PM
	*/
	function showListUserByAttendeeType(offset, type_id){

		$.ajax({
	    	url: url+'/user/type/'+type_id+'/page/'+offset+'/item/'+limit,
	        type: 'get',
	        contentType: 'application/json;charset=utf-8',
	        success: function(data) {
	           	if(data.STATUS == true) {
	            	$("tbody").html(listUserDetail(data));
	            }
	        },
	        error: function(data) {
	           	console.log("erorr:"+ data);
	        }
	    });	 
	}	
	/*
	* bootpage show pagination
	*/
	function loadPaginationUserByAttendeeType() {
		var x = $('input[name=rdAttendeeType]:checked').val();	
		$('#pagination').bootpag({
		    total: numofpage,
		    maxVisible: 5,
		    leaps: true,
		    firstLastUse: true,
		    first: '&#8592;',
		    last: '&#8594;',
		    wrapClass: 'pagination',
		    activeClass: 'active',
		    disabledClass: 'disabled',
		    nextClass: 'next',
		    prevClass: 'prev',
		    lastClass: 'last',
		    firstClass: 'first'
			}).on("page", function(event, num) {
				showListUserByAttendeeType(num,x);
		}); 
	}
	/*
	* bootpage show pagination
	*/
	function loadPaginationUserBySearch() {
		//var x = $('input[name=rdAttendeeType]:checked').val();	
		$('#pagination').bootpag({
		    total: numofpage,
		    maxVisible: 5,
		    leaps: true,
		    firstLastUse: true,
		    first: '&#8592;',
		    last: '&#8594;',
		    wrapClass: 'pagination',
		    activeClass: 'active',
		    disabledClass: 'disabled',
		    nextClass: 'next',
		    prevClass: 'prev',
		    lastClass: 'last',
		    firstClass: 'first'
			}).on("page", function(event, num) {
				showListUserBySearch(num);
		}); 
	}				
	/*
	* Query list user from DB and Display result to #tbody
	* by Sotheara Datetime: 2016-05-28 3:37 PM
	*/
	function showListUserBySearch(offset){

		$.ajax({
	    	url: url+'/user/page/'+offset+'/item/'+limit,
	        type: 'get',
	        contentType: 'application/json;charset=utf-8',
	        success: function(data) {
	           	if(data.STATUS == true) {
	            	$("tbody").html(listUserDetail(data));
	            }
	        },
	        error: function(data) {
	           	console.log("erorr:"+ data);
	        }
	    });	 
	}	

	function listUserDetail(data){
		var str="";
			for(var i=0; i<data.DATA.length ; i++) {
				str +="<tr>"
					+"<td>"+data.DATA[i].id+"</td>"
					+"<td>"+data.DATA[i].name+"</td>"
					+"<td>"+data.DATA[i].phone+"</td>"
					+"<td>"+data.DATA[i].address+"</td>"
					+"<td>"+data.DATA[i].attendee_title+"</td>"
					+"<td>"+data.DATA[i].job_title+"</td>"						
					+"</tr>";
			}
		return str;
	}

	/*
	* Event Change Type All Attendee adn Indidual attendee
	*/
	function changeType() {
		var type = $("#attendeeType").val();
	
		if (type == "all") {
			$("#searchAll").show();
			$("#searchName").hide();
		}
		else {
			$("#searchAll").hide();
			$("#searchName").show();
			mystartListByAttendeeType(0);
		}
	}
	
	
	/*
	* Method Insert User 
	* by Sothera 2016-05-28 3:31 PM
	*/
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
			           	console.log("Register not completed.");
				    }
		        },
		        error: function(data){
		           	console.log("erorr:"+ data);
		        }
		    });	
		}    	
	}

	/*
	* Clear validation 
	*/
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


	/*
	* validation Attendee Title
	*/
	function validateAttendeeTitle(){
		var attendee_title= $("#attendee_title").val();
			
		    if(attendee_title == 0) {
			   	$("#attendee_title").css("border", "solid 2px red");
			   	$("#checkattendeetitle").text("Please choose Attendee Type!");
			   	$("#attendee_title").focus();
			   	return false;
			    
			}
			else{
			   	$("#attendee_title").css("border", "solid 2px green");
			   	$("#checkattendeetitle").text("");
			    return true;
			}
	}

	/*
	* validation Job Type
	*/
	function validateJobType(){
		var job_type= $("#job_type").val();
			
		    if(job_type == 0) {
			   	$("#job_type").css("border", "solid 2px red");
			   	$("#checkjobtype").text("Please choose Job name!");
			   	$("#job_type").focus();
			   	return false;
			    
			}
			else{
			   	$("#job_type").css("border", "solid 2px green");
			   	$("#checkjobtype").text("");
			    return true;
			}
	}

	/*
	* validation user name
	*/
	function validateName(){
		var name= $("#name").val();
		var characterReg = /^[\sa-zA-Z0-9!@#$%^&*()-_=+\[\]{}|\\:?/.,]{3,255}$/;
	    if(!characterReg.test(name)) {
			$("#name").css("border", "solid 2px red");
			$("#checkname").text("Please fill your name! and must be more than 3 characters.");
			$("#name").focus();
			return false;
		}
		else{
			$("#name").css("border", "solid 2px green");
			$("#checkname").text("");
			return true;
		}
	}

	/*
	* validation Phone number
	*/
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

	/*
	* validation Email Address
	*/
	function valideEmail(){
		var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		var name= $("#email").val();
			if(name == "" || name === null) {
			    $("#email").css("border", "solid 2px red");
			    $("#checkemail").text("Email field require!");
			    $("#email").focus();
			    return false;
			} 
			if(!emailReg.test(name)){
				$("#email").css("border", "solid 2px red");
			    $("#checkemail").text("Email is not completed.!");
			    $("#email").focus();
			    return false;
			}
			else{
			   	$("#email").css("border", "solid 2px green");
			    $("#checkemail").text("");
			    return true;
			}
	}

	/**
	* Search Attendee
	**/
	function Search() {
		var key =$("#search").val();
		var characterReg = /^[\ba-zA-Z0-9\s-_.]+$/;
			
		if(key.length >= 1 && characterReg.test(key)) {
				
			$("#search").css("border", "solid 2px green");
			$("#checksearch").text("");
				
			$.ajax({ 
				url: url+'/user/page/'+offset+'/item/'+limit+'/'+key,
				type: 'get',
				contentType: 'application/json;charset=utf-8',
				success: function(data) {
					if(data.STATUS == true) {
					            	//alert(data.PAGINATION.TOTALRECORD);
					            	//alert(data.PAGINATION.TOTALPAGE);
						totalofrecord = data.PAGINATION.TOTALRECORD;
					    numofpage = data.PAGINATION.TOTALPAGE;
					    loadPaginationUserBySearch();
				        $("tbody").html(listUserDetail(data));
				        //alert("search");
				    }
				    else {
				        swal("Search Not Found");
					}
				},
				error: function(data) {
					console.log("erorr:"+ data);
				}
			}); 
		}
		else{
			$("#search").css("border", "solid 2px red");
			$("#checksearch").text("Require, at least 2, less than 100, not allow special symbol");
		}
	}
</script>
@stop
