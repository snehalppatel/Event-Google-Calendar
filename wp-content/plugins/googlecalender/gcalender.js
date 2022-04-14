jQuery(document).ready( function() {

    jQuery(".g_cal").click( function(e) {
       e.preventDefault(); 
       jQuery.ajax({
          type : "get",
          dataType : "json",
          url : "/wordpress/wp-admin/admin-ajax.php",
          data : {action: "my_google_calender",title: jQuery("input#title_data").val(), date: jQuery("input#date_data").val()},
          success: function(response) {
             console.log(response);
          }
       })   
 
    });
 
 })