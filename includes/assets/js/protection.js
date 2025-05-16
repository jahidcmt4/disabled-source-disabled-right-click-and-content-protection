if (jh_disabled_options_data.disabled_click == "1") {
   document.addEventListener('contextmenu', function(e) {
      if(jh_disabled_options_data.disabled_notifi_status=="1" && jh_disabled_options_data.disabled_notifi_text!=""){
         jQuery.notify(jh_disabled_options_data.disabled_notifi_text,
            {
            position: jh_disabled_options_data.disabled_notifi_position,
            className: 'error',  
            showAnimation: 'fadeIn', 
            hideAnimation: 'fadeOut', 
            style: 'bootstrap'
            }
         );
      }
      e.preventDefault();
   });
}

document.onkeydown = function(e) {
   if (jh_disabled_options_data.disabled_f12 == "1") {
      if (event.keyCode == 123) {
         if(jh_disabled_options_data.disabled_notifi_status=="1" && jh_disabled_options_data.disabled_notifi_text!=""){
            jQuery.notify(jh_disabled_options_data.disabled_notifi_text,
               {
               position: jh_disabled_options_data.disabled_notifi_position,
               className: 'error',  
               showAnimation: 'fadeIn', 
               hideAnimation: 'fadeOut', 
               style: 'bootstrap'
               }
            );
         }
         return false;
      }
   }
   if (jh_disabled_options_data.disabled_ctst_i == "1") {
      if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
         if(jh_disabled_options_data.disabled_notifi_status=="1" && jh_disabled_options_data.disabled_notifi_text!=""){
            jQuery.notify(jh_disabled_options_data.disabled_notifi_text,
               {
               position: jh_disabled_options_data.disabled_notifi_position,
               className: 'error',  
               showAnimation: 'fadeIn', 
               hideAnimation: 'fadeOut', 
               style: 'bootstrap'
               }
            );
         }
         return false;
      }
      if (e.ctrlKey && e.keyCode == 'I'.charCodeAt(0)) {
         if(jh_disabled_options_data.disabled_notifi_status=="1" && jh_disabled_options_data.disabled_notifi_text!=""){
            jQuery.notify(jh_disabled_options_data.disabled_notifi_text,
               {
               position: jh_disabled_options_data.disabled_notifi_position,
               className: 'error',  
               showAnimation: 'fadeIn', 
               hideAnimation: 'fadeOut', 
               style: 'bootstrap'
               }
            );
         }
         return false;
      }
   }
   if (jh_disabled_options_data.disabled_ctst_c == "1") {
      if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
         if(jh_disabled_options_data.disabled_notifi_status=="1" && jh_disabled_options_data.disabled_notifi_text!=""){
            jQuery.notify(jh_disabled_options_data.disabled_notifi_text,
               {
               position: jh_disabled_options_data.disabled_notifi_position,
               className: 'error',  
               showAnimation: 'fadeIn', 
               hideAnimation: 'fadeOut', 
               style: 'bootstrap'
               }
            );
         }
         return false;
      }
      if (e.ctrlKey && e.keyCode == 'C'.charCodeAt(0)) {
         if(jh_disabled_options_data.disabled_notifi_status=="1" && jh_disabled_options_data.disabled_notifi_text!=""){
            jQuery.notify(jh_disabled_options_data.disabled_notifi_text,
               {
               position: jh_disabled_options_data.disabled_notifi_position,
               className: 'error',  
               showAnimation: 'fadeIn', 
               hideAnimation: 'fadeOut', 
               style: 'bootstrap'
               }
            );
         }
         return false;
      }
   }
   if (jh_disabled_options_data.disabled_ctst_j == "1") {
      if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
         if(jh_disabled_options_data.disabled_notifi_status=="1" && jh_disabled_options_data.disabled_notifi_text!=""){
            jQuery.notify(jh_disabled_options_data.disabled_notifi_text,
               {
               position: jh_disabled_options_data.disabled_notifi_position,
               className: 'error',  
               showAnimation: 'fadeIn', 
               hideAnimation: 'fadeOut', 
               style: 'bootstrap'
               }
            );
         }
         return false;
      }
      if (e.ctrlKey && e.keyCode == 'J'.charCodeAt(0)) {
         if(jh_disabled_options_data.disabled_notifi_status=="1" && jh_disabled_options_data.disabled_notifi_text!=""){
            jQuery.notify(jh_disabled_options_data.disabled_notifi_text,
               {
               position: jh_disabled_options_data.disabled_notifi_position,
               className: 'error',  
               showAnimation: 'fadeIn', 
               hideAnimation: 'fadeOut', 
               style: 'bootstrap'
               }
            );
         }
         return false;
      }
   }
   if (jh_disabled_options_data.disabled_ct_u == "1") {
      if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
         if(jh_disabled_options_data.disabled_notifi_status=="1" && jh_disabled_options_data.disabled_notifi_text!=""){
            jQuery.notify(jh_disabled_options_data.disabled_notifi_text,
               {
               position: jh_disabled_options_data.disabled_notifi_position,
               className: 'error',  
               showAnimation: 'fadeIn', 
               hideAnimation: 'fadeOut', 
               style: 'bootstrap'
               }
            );
         }
         return false;
      }
   }
   if (jh_disabled_options_data.disabled_ct_p == "1") {
      if (e.ctrlKey && e.keyCode == 'P'.charCodeAt(0)) {
         if(jh_disabled_options_data.disabled_notifi_status=="1" && jh_disabled_options_data.disabled_notifi_text!=""){
            jQuery.notify(jh_disabled_options_data.disabled_notifi_text,
               {
               position: jh_disabled_options_data.disabled_notifi_position,
               className: 'error',  
               showAnimation: 'fadeIn', 
               hideAnimation: 'fadeOut', 
               style: 'bootstrap'
               }
            );
         }
         return false;
      }
   }
   if (jh_disabled_options_data.disabled_ct_s == "1") {
      if (e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)) {
         if(jh_disabled_options_data.disabled_notifi_status=="1" && jh_disabled_options_data.disabled_notifi_text!=""){
            jQuery.notify(jh_disabled_options_data.disabled_notifi_text,
               {
               position: jh_disabled_options_data.disabled_notifi_position,
               className: 'error',  
               showAnimation: 'fadeIn', 
               hideAnimation: 'fadeOut', 
               style: 'bootstrap'
               }
            );
         }
         return false;
      }
   }
}

if (jh_disabled_options_data.disabled_dragging_img == "1") {
   jQuery("img").mousedown(function(){
    return false;
   });
}