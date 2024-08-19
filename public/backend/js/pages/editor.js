// //[editor Javascript]

// //Project:	Sunny Admin - Responsive Admin Template
// //Primary use:   Used only for the wysihtml5 Editor 


// //Add text editor
//     $(function () {
//     "use strict";

//     // Replace the <textarea id="editor1"> with a CKEditor
// 	// instance, using default configuration.
// 	CKEDITOR.replace('editor1')
// 	//bootstrap WYSIHTML5 - text editor
// 	$('.textarea').wysihtml5();		
	
//   });

//   $(function () {
//     "use strict";

//     // Replace the <textarea id="editor1"> with a CKEditor
// 	// instance, using default configuration.
// 	CKEDITOR.replace('editor2')
// 	//bootstrap WYSIHTML5 - text editor
// 	$('.textarea').wysihtml5();		
	
//   });


//   $(function () {
//     "use strict";

//     // Replace the <textarea id="editor1"> with a CKEditor
// 	// instance, using default configuration.
// 	CKEDITOR.replace('editor3')
// 	//bootstrap WYSIHTML5 - text editor
// 	$('.textarea').wysihtml5();		
	
//   });



//   $(function () {
//     "use strict";

//     // Replace the <textarea id="editor1"> with a CKEditor
// 	// instance, using default configuration.
// 	CKEDITOR.replace('editor4')
// 	//bootstrap WYSIHTML5 - text editor
// 	$('.textarea').wysihtml5();		
	
//   });




$(function () {
  "use strict";

  // Function to check if an element with a specific ID exists
  function elementExists(id) {
      return document.getElementById(id) !== null;
  }

  // Replace the <textarea id="editor1"> with a CKEditor instance, using default configuration.
  if (elementExists('editor1')) {
      CKEDITOR.replace('editor1');
      // Bootstrap WYSIHTML5 - text editor
      $('.textarea').wysihtml5();
  }

  // Repeat the same for other editors
  if (elementExists('editor2')) {
      CKEDITOR.replace('editor2');
      $('.textarea').wysihtml5();
  }

  if (elementExists('editor3')) {
      CKEDITOR.replace('editor3');
      $('.textarea').wysihtml5();
  }

  if (elementExists('editor4')) {
      CKEDITOR.replace('editor4');
      $('.textarea').wysihtml5();
  }
});
