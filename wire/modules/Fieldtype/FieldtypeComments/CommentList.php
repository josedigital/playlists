<?php

/**
 * ProcessWire CommentListInterface and CommentList
 *
 * CommentListInterface defines an interface for CommentLists.
 * CommentList provides the default implementation of this interface. 
 *
 * Use of these is not required. These are just here to provide output for a FieldtypeComments field. 
 * Typically you would iterate through the field and generate your own output. But if you just need
 * something simple, or are testing, then this may fit your needs. 
 * 
 * ProcessWire 2.x 
 * Copyright (C) 2010 by Ryan Cramer 
 * Licensed under GNU/GPL v2, see LICENSE.TXT
 * 
 * http://www.processwire.com
 * http://www.ryancramer.com
 *
 */

/*
 * CommentListInterface defines an interface for CommentLists.
 *
 */
interface CommentListInterface {
	public function __construct(CommentArray $comments, $options = array()); 
	public function render();
	public function renderItem(Comment $comment);
}

/**
 * CommentList provides the default implementation of the CommentListInterface interface. 
 *
 */
class CommentList extends Wire implements CommentListInterface {

	/**
	 * Reference to CommentsArray provided in constructor
	 *
	 */
	protected $comments = null;

	/**
	 * Default options that may be overridden from constructor
	 *
	 */
	protected $options = array(
		'headline' => '<h3>Comments</h3>', 
		'commentHeader' => 'Posted by {cite} on {created}',
		'dateFormat' => 'm/d/y g:ia', 
		'encoding' => 'UTF-8', 
		'admin' => false, // shows unapproved comments if true
		); 

	/**
	 * Construct the CommentList
	 *
	 * @param CommentArray $comments 
	 * @param array $options Options that may override those provided with the class (see CommentList::$options)
	 *
	 */
	public function __construct(CommentArray $comments, $options = array()) {
		$this->comments = $comments; 
		$this->options = array_merge($this->options, $options); 
	}

	/**
	 * Rendering of comments for API demonstration and testing purposes (or feel free to use for production if suitable)
	 *
	 * @see Comment::render()
	 * @return string or blank if no comments
	 *
	 */
	public function render() {

		$out = '';

		foreach($this->comments as $comment) {
			if(!$this->options['admin']) if($comment->status != Comment::statusApproved) continue; 
			$out .= $this->renderItem($comment); 
		}

		if($out) $out = 
			"\n" . $this->options['headline'] . 
			"\n<ul class='CommentList'>$out\n</ul><!--/CommentList-->";

		return $out;
	}

	/**
	 * Render the comment
	 *
	 * This is the default rendering for development/testing/demonstration purposes
	 *
	 * It may be used for production, but only if it meets your needs already. Typically you'll want to render the comments
	 * using your own code in your templates. 
	 *
	 * @see CommentArray::render()
	 * @return string 
	 *
	 */
	public function renderItem(Comment $comment) {

		$text = htmlentities(trim($comment->text), ENT_QUOTES, $this->options['encoding']);
		$text = str_replace("\n\n", "</p><p>", $text); 
		$text = str_replace("\n", "<br />", $text); 

		$cite = htmlentities(trim($comment->cite), ENT_QUOTES, $this->options['encoding']); 
		$created = date($this->options['dateFormat'], $comment->created); 

		$header = str_replace(array('{cite}', '{created}'), array($cite, $created), $this->options['commentHeader']); 
		
		$out = 	"\n\t<li class='CommentListItem'>" . 
			"\n\t\t<p class='CommentHeader'>$header</p>" . 
			"\n\t\t<div class='CommentText'>" . 
			"\n\t\t\t<p>$text</p>" . 
			"\n\t\t</div>" . 
			"\n\t</li>";
	
		return $out; 	
	}


}

