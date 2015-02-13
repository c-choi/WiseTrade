$(document).ready(function(){

	$("#sitemapMenu").change(function(){
	  var id = $(this).find("option:selected").attr("id");

	  switch (id){

	  	case 'firstPage':
	  		window.location.href = '../../../index.html#firstPage';
		  break;
		  
	  	case 'secondPage':
	  		window.location.href = '../../../index.html#secondPage';
		  break;

		case 'secondPage/1':
		  window.location.href = '../../../index.html#secondPage/1';
		  break;

		case 'secondPage/2':
		  window.location.href = '../../../index.html#secondPage/2';
		  break;

		 case 'secondPage/3':
		  window.location.href = '../../../index.html#secondPage/3';
		  break;

		 case 'secondPage/4':
		  window.location.href = '../../../index.html#secondPage/4';
		  break;

		case '3rdPage':
		  window.location.href = '../../../index.html#3rdPage';
		  break;

		case '3rdPage/1':
		  window.location.href = '../../../index.html#3rdPage/1';
		  break;

		case '3rdPage/2':
		  window.location.href = '../../../index.html#3rdPage/2';
		  break;

		case '3rdPage/3':
		  window.location.href = '../../../index.html#3rdPage/3';
		  break;

	    case '4thPage':
	      window.location.href = '../../../index.html#4thPage';
	      break;

	    case '4thPage/1':
	      window.location.href = '../../../index.html#4thPage/1';
	      break;

		case '4thPage/2':
	      window.location.href = '../../../index.html#4thPage/2';
	      break;

		case '4thPage/3':
	      window.location.href = '../../../index.html#4thPage/3';
	      break;

	    case '5thPage':
	      window.location.href = '../../../index.html#5thPage';
	      break;

	    case '5thPage/1':
	      window.location.href = '../../../index.html#5thPage/1';
	      break;

	    case '5thPage/2':
	      window.location.href = '../../../index.html#5thPage/2';
	      break;

	    case '6thPage':
	    	window.location.href = '../../../index.html#6thPage';
	    	break;

	    case '6thPage/1':
	    	window.location.href = '../../../index.html#6thPage/1';
	    	break;

	    case '7thPage':
	    	window.location.href = '../../../index.html#7thPage';
	    	break;

	    case '7thPage/1':
	    	window.location.href = '../../../index.html#7thPage/1';
	    	break;

	    case '7thPage/2':
	    	window.location.href = '../../../index.html#7thPage/2';
	    	break;

	    case '7thPage/3':
	    	window.location.href = '../../../index.html#7thPage/3';
	    	break;
			
	    case '7thPage/4':
	    	window.location.href = '../../../index.html#7thPage/4';
	    	break;
	  }
	});

});