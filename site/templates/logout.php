<?php
	$session->logout();
	$session->redirect($config->urls->root . 'login');
