<?php 

/**
 * Page template
 *
 */

include("./head.inc"); 

?>


<div class="row">



<?php




if($input->post->login_submit) {
	// process submitted login form
	$name = $sanitizer->username($input->post->login_name);
	$pass = $input->post->login_pass;
	if($session->login($name, $pass)) $session->redirect($config->urls->root."admin/");
		else echo "<h2>Login failed, please try again.</h2>";
}

if($user->isLoggedin()) {
	// redirect to client page, if it exists
	$session->redirect($config->urls->root."admin/");
} else {
	// display the login form
	include("./login-form.inc");
}


/*
if($user->isSuperuser()) {
	// display links to all the client pages
	echo $page->children()->render();

} else if($user->isLoggedin()) {
	// redirect to client page, if it exists
	$private = $pages->get("/processwire/members/$user->name/");
	if($private->id) $session->redirect($private->url);
		else echo "<p>Your page is not yet setup.</p>";
} else {
	// display the login form
	include("./login-form.inc");
}

*/
?>
</div>

<?php
include("./foot.inc");

