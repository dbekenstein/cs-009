<?php
include ("top.php");

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// 
// Initialize variables
//  
//  Here we set the default values that we want our form to display

$debug = false;

if(isset($_GET["debug"])){ // this just helps me out if you have it
    $debug = true;
}

if ($debug) print "<p>DEBUG MODE IS ON</p>";

//
//  CHANGES NEEDED: create variable for each form element
//                  to set your default values. in the example i set them to me

$firstName="Bob";
$lastName="Erickson";
$email="rerickso@uvm.edu";
$hiking = true;
$kayaking = false;
$gender = "Male";
$mountain="Haystack Mountain";

// this would be the full url of your form
// See top.php for variable declartions
$yourURL =  $domain . $phpSelf;

//initialize flags for errors, one for each item
$firstNameERROR = false;
$lastNameERROR = false;
$emailERROR = false;

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// 
// This if statement is how we can check to see if the form has been submitted
// 
// NO CHANGES: but VERFIY your forms submit button is named btnSubmit

if (isset($_POST["btnSubmit"])){

    //******************************************************************
    // is the refeering web page the one we want or is someone trying 
    // to hack in. this is not 100% reliable but ok for our purposes   */
    //
    // Security check block one, no changes needed
    if(!securityCheck()){
        $msg= "<p>Sorry you cannot access this page. ";
        $msg.= "Security breach detected and reported</p>";
        die($msg);
    }
    
    //check for errors
    include ("lib/validation_functions.php"); // you need to create this file (see link in lecture notes)
    $errorMsg=array();
    //#######################################################
    // we are going to put our forms data into this array so we can save it
    // NO CHANGES NEEDED
    $dataRecord=array();  
    
    
    //************************************************************
    // we need to make sure there is no malicious code so we do 
    // this for each element we pass in. Be sure your names match
    // your objects
    // 
    // Security check block two
    // 
    // What this does is take things like <script> and replace it
    // with &lt;script&gt; so that hackers cannot send malicous 
    // code to you.
    //   
    // You will notice i have set radio buttons, list box and the 
    // check boxes just in case someone tries something funky.
    // 
    // CHANGES NEEDED: match PHP variables with form elements
    // 
    // */
    
    $firstName = htmlentities($_POST["txtFirstName"],ENT_QUOTES,"UTF-8");
    $lastName = htmlentities($_POST["txtLastName"],ENT_QUOTES,"UTF-8");
    $email = htmlentities($_POST["txtEmail"],ENT_QUOTES,"UTF-8");
    
    if(isset($_POST["chkHiking"])) {
        $hiking  = true;
    }else{
        $hiking  = false;
    }
    
    if(isset($_POST["chkKayaking"])) {
        $kayaking  = true;
    }else{
        $kayaking  = false;
    }
    
    $gender = htmlentities($_POST["radGender"],ENT_QUOTES,"UTF-8");
    
    $mountain = htmlentities($_POST["lstMountains"],ENT_QUOTES,"UTF-8");
    
    
    // Test first name for empty and valid characters and save into dataRecord array
    // YOU NEED TO DO THIS
    
    
    
    // Test last name for empty and valid characters and save into dataRecord array
    // YOU NEED TO DO THIS
   
    
    // test email for empty and valid format and save into dataRecord array
    //
    // NOTE: i removed required attribute and set this input type=text instead 
    // of type=email so i can check my php code.
     if($email==""){
        $errorMsg[]="Please enter your email address";
        $emailERROR = true;
     }elseif(!verifyEmail){ 
        $errorMsg[]="Your email address appears to be incorrect.";
        $emailERROR = true;
     }
   
    // we are going to put our forms data into this array so we can save it
    $dataRecord[]=$email;
    
    
    // Test anything else and save into dataRecord array
    // YOU NEED TO DO THIS
 
     
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    // 
    // our form data is valid at this point so we can process the data
    if(!$errorMsg){	
        if ($debug) print "<p>Form is valid</p>";

        //########################################################
        // Begin processing data

        //########################################################
        // Save Forms data to a csv file on the cloud

        // NOTE: When you save the forms information to a file, the file 
        // permissions can cause problems

        //NOTE: my file is in a folder called data

        // Step one in netbeans create new file, name it formData.csv
        // Step two delete the contents of this csv file and save it
        // Step three use fugu or winscp to set the permissions on this
        //            file to 666 (rw-  for everyone)
        // Now try your form and see if it saves.

        $fileExt=".csv";

        $myFileName="data/registration";

        $filename = $myFileName . $fileExt;

        if ($debug) print "\n\n<p>filename is " . $filename;

        // now we just open the file for append
        $file = fopen($filename, 'a');    

        // write the forms informations
        fputcsv($file, $dataRecord);

        // close the file
        fclose($file);

        //####################################################################


        //************************************************************
        //
        //  In this block I am just putting all the forms information
        //  into a variable so I can print it out on the screen
        //
        //  the substr function removes the 3 letter prefix
        //  preg_split('/(?=[A-Z])/',$str) add a space for the camel case
        //  see: http://stackoverflow.com/questions/4519739/split-camelcase-word-into-words-with-php-preg-match-regular-expression
        //
        //  CHANGES: first message line. foreach no changes needed

        $message  = '<h2>Your information.</h2>';

        foreach ($_POST as $key => $value){

            $message .= "<p>"; 

            $camelCase = preg_split('/(?=[A-Z])/',substr($key,3));

            foreach ($camelCase as $one){
                $message .= $one . " ";
            }
            $message .= " = " . htmlentities($value,ENT_QUOTES,"UTF-8") . "</p>";
        }
        
        //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
        //
        // mail the forms information to the person who filled it out
        // if you want a copy you need to add yourself to the bcc
        // in mailMessage.php
        //
        include_once('mailMessage.php');
        $mailed = sendMail($email, $message);
        
    } // ends form is valid
    
} // ends if form was submitted. We will be adding more information ABOVE this

?>
<article id="main">
    
<? 
//*****************************************************************************
//
//  In this block  display the information that was submitted and do not 
//  display the form.
//  
//  NO CHANGES NEEDED
//
if (isset($_POST["btnSubmit"]) AND empty($errorMsg)){  // closing of if marked with: end body submit
    //$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
    print "<h1>Your Request has ";

    if (!$mailed) {
        echo "not ";
    }
    
    echo "been processed</h1>";

    print "<p>A copy of this message has ";
    if (!$mailed) {
        echo "not ";
    }
    print "been sent</p>";
    print "<p>To: " . $email . "</p>";
    print "<p>Mail Message:</p>";
    echo $message;
} else {

// display the form, notice the closing } bracket at the end just before the 
// closing body tag

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// Here we display any errors that were on the form
//
    
print '<div id="errors">';

if($errorMsg){
    echo "<ol>\n";
    foreach($errorMsg as $err){
        echo "<li>" . $err . "</li>\n";
    }
    echo "</ol>\n";
} 

print '</div>';

?>
   
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
               value="<?php echo $firstName; ?>"
               tabindex="100" maxlength="25" placeholder="enter your first name" 
               autofocus onfocus="this.select()" required>
	</label>
        <!-- note for last name i did not use the required attribute, this is 
             only for demonstration purposes. -->
        <label for="txtLastName" class="required">Last Name
  	<input type="text" id="txtLastName" name="txtLastName" 
               value="<?php echo $lastName; ?>"
               tabindex="110" maxlength="25" placeholder="enter your last name" 
               onfocus="this.select()">
        </label>
	<label for="txtEmail" class="required">Email
  	<input type="email" id="txtEmail" name="txtEmail" 
               value="<?php echo $email; ?>"
               tabindex="120" maxlength="45" placeholder="enter a valid email address"
               <?php if($emailERROR) echo 'class="mistake"'; ?>
               onfocus="this.select()" >
        </label>
</fieldset>					

<fieldset class="checkbox">
	<legend>Do you like (check all that apply):</legend>
  	
        <label><input type="checkbox" id="chkHiking" name="chkHiking" 
                      <?php if($hiking) echo ' checked="checked" ';?>
                      value="Hiking" tabindex="200"> Hiking</label>
            
	<label><input type="checkbox" id="chkKayaking" name="chkKayaking" 
                      <?php if($kayaking) echo ' checked="checked" ';?>
                      value="Kayaking" tabindex="210"> Kayaking</label>
</fieldset>

<fieldset class="radio">
	<legend>What is your gender?</legend>
	<label><input type="radio" id="radGenderMale" name="radGender"
                      <?php if($gender=="Male") echo ' checked="checked" ';?>
                      value="Male" tabindex="300">Male</label>
            
	<label><input type="radio" id="radGenderFemale" name="radGender"
                      <?php if($gender=="Female") echo ' checked="checked" ';?>
                      value="Female" tabindex="310">Female</label>
</fieldset>

<fieldset class="lists">	
	<legend>What is your Favorite Mountain</legend>
	<select id="lstMountains" name="lstMountains" tabindex="400" size="1">
		<option <?php if($mountain=="Haystack Mountain") echo ' selected="selected" ';?>
                    value="Haystack Mountain">Haystack Mountain</option>
		<option <?php if($mountain=="Camels Hump") echo ' selected="selected" ';?>
                    value="Camels Hump">Camels Hump</option>
		<option <?php if($mountain=="Laraway Mountain") echo ' selected="selected" ';?>
                    value="Laraway Mountain">Laraway Mountain</option>
	</select>
</fieldset>

<fieldset class="buttons">
	<legend></legend>				
	<input type="submit" id="btnSubmit" name="btnSubmit" value="Register" tabindex="900" class="button">
</fieldset>					

</fieldset>
</fieldset>
</form>
  
<?php 
} // end body submit NO CHANGE NEEDED
if ($debug) print "<p>END OF PROCESSING</p>";

print "</article>";
include "footer.php"; 

?>
</body>
</html>
