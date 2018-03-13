<?
//index.php - main page with article and comments

$db = SafeMySQL::getInstance();
//one article with id=1;
list( $name, $article ) = $db->get_row( "SELECT name, article FROM tt_articles WHERE id = 1" );
?>

<div class="container" style="margin-top:40px; margin-bottom:100px;">
<h1><?=$name;?></h1>
<br/>
<?=$article;?>
<div class="alert alert-info" role="alert">
  <strong>Comments...</strong> 
</div>
<div class="comments"></div>
	<form id="form-comment" action="javascript:void(null);" onsubmit="call();">
	  <div class="form-group">
		<label for="nameInput">Your Name</label>
		<input type="text" class="form-control reg_input" data-validation="text" id="nameInput" placeholder="Surname Name">
	  </div>
	  <div class="form-group">
		<label for="emailInput">Your Email Address</label>
		<input type="email" class="form-control reg_input" id="emailInput" data-validation="email" placeholder="name@example.com">
	  </div>
	  <div class="form-group">
		<label for="comment">Your Comment</label>
		<textarea class="form-control reg_input" name="comment" id="comment" rows="3" data-validation="text" placeholder="Text..."></textarea>
	  </div>
	  <button id="form-submit" class="btn btn-primary" disabled="disabled">Submit</button>
	</form>
</div>



<script>
$(document).ready(function(){
	

	$('#form-comment').each(function(){

		// variables (form and submit button)
		var form = $(this),
		btn = form.find('#form-submit');

		// Function of check'n'validate of fields of a form
		function checkInput(){
			form.find('.reg_input').each(function(){
				
				if($(this).val() == '' && $(this).data('validation')!=''){
					// If a required field is empty add a class instruction
					$(this).addClass('is_invalid');
				}
			
				if($(this).val() != ''){
		
					if($(this).data('validation')=='text'){
						if($(this).val().length >3){
							// If a field is valid we delete a class instruction
								$(this).removeClass('is-invalid');
								$(this).addClass('is-valid');
							if(isValidInput($(this).val())){
									$(this).removeClass('is-valid');
									$(this).removeClass('is-invalid');
									$(this).addClass('is-invalid');
									}
							} else {
									$(this).removeClass('is-invalid');
									$(this).removeClass('is-valid');
									$(this).addClass('is-invalid');
								
							}
						
					}
					if($(this).data('validation')=='email'){
						if(isValidEmailAddress($(this).val())){
								$(this).removeClass('is-invalid');
								$(this).addClass('is-valid');
								
						} else {
								$(this).removeClass('is-invalid');
								$(this).addClass('is-invalid');
						}
					}
				}
			});
		}
		
		function isValidInput(text_string){
			var result = false;
			var iChars = "!#$%^&*()+=[]\\\';,/{}|\":<>?";
			for (var i = 0; i < text_string.length; i++) {
				if (iChars.indexOf(text_string.charAt(i)) != -1) {
					result = true;
				}
			}
			return result;
		}
		

		function isValidEmailAddress(emailAddress) {
			var pattern = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
			return pattern.test(emailAddress);
		}

		// Check in realtime mode
		setInterval(function(){
			// start function of check of fields on fullness
			checkInput();
			// consider quantity of the blank fields
			var sizeEmpty = form.find('.is-valid').size();
			// hang up a condition-triger on the button of sending a form
			if(sizeEmpty < 3){
					btn.attr('disabled', true)
			} else {
				btn.attr('disabled', false)
			}
		},500);

		// By the button to proceed a click event
		btn.click(function(){
			if($(this).hasClass('disabled')){
				return false
			} else {
			// Everything is good, everything is filled, we send a form
				//form.submit();
			}
		});
	});
});

 function getXmlHttp(){
  var xmlhttp;
  try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
    try {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
      xmlhttp = false;
    }
  }
  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
    xmlhttp = new XMLHttpRequest();
  }
  return xmlhttp;
}

//Ajax upload a comment to databse
function call() {
	var req = getXmlHttp();
	//var msg   = $('#form-comment').serialize();
	var params = 'name=' + encodeURIComponent($('#nameInput').val()) + '&email=' + encodeURIComponent($('#emailInput').val()) + '&comment=' + encodeURIComponent($('#comment').val());
	req.open('POST', '/ajax/upload_comment.php', true); 
	req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	req.onreadystatechange = function() {
	  if (req.readyState == 4) {
		 if(req.status == 200) {
		   //alert(req.responseText);
		   $( ".comments" ).append(req.responseText);
		 }
	  }
	};
	req.send(params); 
}  


//Ajax download all comments from database
function loadComments() {
	var req = getXmlHttp();
	req.open('GET', '/ajax/download_comments.php', true); 
	req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	req.onreadystatechange = function() {
	  if (req.readyState == 4) {
		 if(req.status == 200) {
		   //alert(req.responseText);
		   $( ".comments" ).append(req.responseText);
		 }
	  }
	};
	req.send(null); 
} 

loadComments();
</script>