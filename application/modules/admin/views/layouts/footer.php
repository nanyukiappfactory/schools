<script src="<?php echo base_url(); ?>assets/themes/custom/js/jquery-3.3.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>assets/themes/custom/js/dashboard.js"></script>
<script defer src="<?php echo base_url(); ?>assets/vendor/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			tinymce.init({
				selector: "textarea",
				plugins: "textcolor code emoticons image imagetools insertdatetime link advlist media paste searchreplace spellchecker table wordcount",
				font_formats: 'Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats',
				fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
				toolbar: ["bold italic underline strikethrough alignleft aligncenter alignright alignjustify fontselect fontsizeselect cut copy paste bullist numlist outdent indent blockquote undo redo removeformat",
				"subscript superscript undo redo | forecolor backcolor emoticons image insertdatetime link media paste searchreplace spellchecker table code"],
			});
		});
	</script>


        
        
