/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function(config) {
// ...
   config.filebrowserBrowseUrl = 'kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl = 'kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = 'kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl = 'kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = 'kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl = 'kcfinder/upload.php?type=flash';
   config.autoParagraph = false;
// ...
};
      CKEDITOR.plugins.addExternal('fmath_formula', 'plugins/fmath_formula/', 'plugin.js');
   
      CKEDITOR.editorConfig = function( config )
      {
             // Declare the additional plugin 

         config.extraPlugins = 'fmath_formula';
   
    // Add the button to toolbar
	config.toolbar =	[
	{ name: 'document', items : [ 'Source','-','Save','DocProps','Preview','Print','-','Templates' ] },
	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
	{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
	{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
        'HiddenField' ] },
	{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
			'/',
	{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
	{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] },

	{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
	{ name: 'colors', items : [ 'TextColor','BGColor' ] },
	'/',
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
	'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl','fmath_formula' ] },

];
         /*config.toolbar = [ 
         ['Templates', 'Styles','Format','Font','FontSize','TextColor','BGColor','Maximize','Image'], 
         ['Source'], 
         ['Bold','Italic','Underline','Strike','-','Subscript','Superscript','-','fmath_formula'], 
         ['Table','HorizontalRule'], 
         ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote']
          ] */
      };
