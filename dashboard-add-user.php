<?php
session_start();
if (!$_SESSION['logged_in']) {
    header('location: dashboard-login');
}

  $title = "Add Users";
  $metaD = "Admin dashboard page, add users";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
?>

  <h1>Add New User</h1>


<?php
// array with values for each form field, most empty
$fval = array('fname'=>'', 'femail'=>'', 'fgen'=>'', 'fgenm'=>'male', 'fgenf'=>'female', 'ffood'=>'', 'fmess'=>'');

// a variable for errors, initially empty
$ferror = '';

// if there is data submited from form,
if(isset($_POST['fsubmit'])) {
  $fval = array_replace($fval, $_POST);      // add $_POST data in $fval to replace the initial values

  // validate the fields and add the errors in $ferror variable
  if(strlen($_POST['fname'])<3) $ferror .= '- The Name must contains at least 3 characters <br/>';
  if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $_POST['femail'])) {
    $ferror .= '- Add a valid e-mail address <br/>';
  }
  if(!isset($_POST['fgen'])) $ferror .= '- Select a Gender <br/>';
  if($_POST['ffood']=='--' or $_POST['ffood']=='') $ferror .= '- Select a Food preference <br/>';

  // if there is no errors ($ferror is empty) sets a $confirm
  if($ferror==='') $confirm = '<h3>The data was successfully added</h3>';
}

          /* Now define the Form */

// array with values for Select dropdown list
$select_food = array('fruits', 'vegetables', 'cereals', 'dairy', 'cakes');

// sets the <option> tags for Select list
$ffood = '<option>--</option>';
for($i=0; $i<count($select_food); $i++) {
  // sets selected attribute
  $selattr = ($select_food[$i]==$fval['ffood']) ? ' selected="selected"' : '';

  $ffood .= '<option value="'. $select_food[$i]. '"'. $selattr. '>'. $select_food[$i]. '</option>';
}

// define the checked attribute for radio buttons, according to the value of 'fgen'
$fgenm_check = ($fval['fgen']==$fval['fgenm']) ? ' checked="checked"' : '';
$fgenf_check = ($fval['fgen']==$fval['fgenf']) ? ' checked="checked"' : '';

// sets a variable with the HTML code for form
$form = '<form action="" method="post">
 Name: <input type="text" name="fname" id="fname" value="'. $fval['fname']. '" /><br/>
 E-mail: <input type="text" name="femail" id="femail" value="'. $fval['femail']. '" /><br/>
 Gender: <input type="radio" name="fgen" id="fgenm" value="'. $fval['fgenm']. '"'. $fgenm_check. ' />Male
 <input type="radio" name="fgen" id="fgenf" value="'. $fval['fgenf']. '"'. $fgenf_check. ' />Female<br/>
 Food preference: <select id="ffood" name="ffood">'. $ffood. '</select><br/>
 Message (<i>optional</i>):<br/>
 <textarea name="fmess" id="fmess" rows="5", cols="30">'. $fval['fmess']. '</textarea><br/>
 <input type="submit" name="fsubmit" id="fsubmit" value="Submit" /><br/>
</form>';

// if $confirm is set, display it, else, display $ferror and $form
if(isset($confirm)) echo $confirm;
else echo '<div style="color:red;">'. $ferror. '</div><br/>'. $form;
?>



<?php
include 'includes/dashboard-footer.php';
?>
