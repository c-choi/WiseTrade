 if (isset($_POST[Input01])) {
		
	if (is_uploaded_file($_FILES["upfile01"]["tmp_name"])) {
    
	if (move_uploaded_file($_FILES["upfile01"]["tmp_name"], UPLOAD_TRANSPORT_CSV_DIR . UPLOAD_TRANSPORT_CSV)) {
   
    chmod(UPLOAD_TRANSPORT_CSV_DIR . UPLOAD_TRANSPORT_CSV, 0644);
	
	$templateFile = TEMPLATE_LORRYS_HTML_B;
    
	        }
        }
    } 
	

    if (isset($_POST[Input02])) {
		
	if (is_uploaded_file($_FILES["upfile02"]["tmp_name"])) {
    
	if (move_uploaded_file($_FILES["upfile02"]["tmp_name"], UPLOAD_LUGGAGE_CSV_DIR . UPLOAD_LUGGAGE_CSV)) {
   
    chmod(UPLOAD_LUGGAGE_CSV_DIR . UPLOAD_LUGGAGE_CSV, 0644);
	
	$templateFile = TEMPLATE_LORRYS_HTML_C;
    
	    }
    }
    } 
	
	if  {
	
	$templateFile = TEMPLATE_LORRYS_HTML_A;

    }