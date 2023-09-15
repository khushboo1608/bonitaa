/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.enterMode = 2;
	    config.language = 'en';
    config.resize_enabled = true;
	config.allowedContent = true;
    config.removePlugins = 'elementspath';
	
	config.toolbar_Large = [
		['Source', '-', 'Bold', 'Italic', 'Underline', 'Superscript', 'Subscript', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Image', 'SpecialChar', 'Mathjax', 'Symbol', 'mathedit', 'EqnEditor', '-', 'Table', 'Templates', 'HorizontalRule',  'PasteText', 'PasteFromWord', '-', 'TextColor', 'BGColor', 'Find', 'Maximize']
	];
    config.toolbar = config.toolbar_Large;

	filebrowserBrowseUrl = 'ckfinder/ckfinder.html';
	filebrowserImageBrowseUrl = 'ckfinder/ckfinder.html?type=Images';
	filebrowserFlashBrowseUrl = 'ckfinder/ckfinder.html?type=Flash';
	filebrowserUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	filebrowserImageUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	filebrowserFlashUploadUrl = 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
