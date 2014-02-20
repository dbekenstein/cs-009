<? 
include ("top.php"); 
?>
<article id="main">
<form action="<? print $phpSelf; ?>" 
      method="post"
      id="frmRegister">
			
<fieldset class="wrapper">
  <legend>Register Today</legend>
  <p>Please fill out the following registration form. <span class='required'></span>.</p>

<fieldset class="intro">
<legend>Please complete the following form</legend>

<fieldset class="contact">
    <legend>Contact Information</legend>
    
	<label for="txtFirstName" class="required">First Name
  	<input type="text" id="txtFirstName" name="txtFirstName" 
               value=""
               tabindex="100" maxlength="25" placeholder="enter your first name" 
               autofocus onfocus="this.select()" required>
	</label>
        <!-- note for last name i did not use the required attribute, this is 
             only for demonstration purposes. -->
        <label for="txtLastName" class="required">Last Name
  	<input type="text" id="txtLastName" name="txtLastName" 
               value=""
               tabindex="110" maxlength="25" placeholder="enter your last name" 
               autofocus onfocus="this.select()">
        </label>
	<label for="txtEmail" class="required">Email
  	<input type="email" id="txtEmail" name="txtEmail" 
               value=""
               tabindex="120" maxlength="45" placeholder="enter a valid email address" 
               onfocus="this.select()" required >
        </label>
</fieldset>					

<fieldset class="checkbox">
	<legend>Do you like (check all that apply):</legend>
  	
        <label><input type="checkbox" id="chkHiking" name="chkHiking" 
                      value="Hiking" tabindex="200"> Hiking</label>
            
	<label><input type="checkbox" id="chkKayaking" name="chkKayaking" 
                      value="Kayaking" tabindex="210"> Kayaking</label>
</fieldset>

<fieldset class="radio">
	<legend>What is your gender?</legend>
	<label><input type="radio" id="radGenderMale" name="radGender"
                      value="Male" tabindex="300">Male</label>
            
	<label><input type="radio" id="radGenderFemale" name="radGender"		
                      value="Female" tabindex="310">Female</label>
</fieldset>

<fieldset class="lists">	
	<legend>What is your Favorite Mountain</legend>
	<select id="lstMountains" name="lstMountains" tabindex="400" size="1">
		<option value="Haystack Mountain">Haystack Mountain</option>
		<option value="Camels Hump">Camels Hump</option>
		<option value="Laraway Mountain">Laraway Mountain</option>
	</select>
</fieldset>

<fieldset class="buttons">
	<legend></legend>				
	<input type="submit" id="btnSubmit" name="btnSubmit" value="Register" tabindex="900" class="button">
</fieldset>					

</fieldset>
</fieldset>
</form>
    
<?php include "footer.php"; ?>
</body>
</html>