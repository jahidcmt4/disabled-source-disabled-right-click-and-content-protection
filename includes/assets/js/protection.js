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
function isCtrlOrCmd(e) {
   return e.ctrlKey || e.metaKey;
}

function notify() {
   if (
       jh_disabled_options_data.disabled_notifi_status == "1" &&
       jh_disabled_options_data.disabled_notifi_text !== ""
   ) {
       jQuery.notify(jh_disabled_options_data.disabled_notifi_text, {
           position: jh_disabled_options_data.disabled_notifi_position,
           className: 'error',
           showAnimation: 'fadeIn',
           hideAnimation: 'fadeOut',
           style: 'bootstrap'
       });
   }
}

document.addEventListener('keydown', function (e) {

   const key = e.key.toUpperCase();

   // F12
   if (jh_disabled_options_data.disabled_f12 == "1" && key === "F12") {
       notify();
       e.preventDefault();
       return false;
   }

   // Ctrl/Cmd + I  OR  Ctrl/Cmd + Shift + I
   if (jh_disabled_options_data.disabled_ctst_i == "1") {
       if (isCtrlOrCmd(e) && key === 'I') {
           notify();
           e.preventDefault();
           return false;
       }
   }

   // Ctrl/Cmd + C  OR  Ctrl/Cmd + Shift + C
   if (jh_disabled_options_data.disabled_ctst_c == "1") {
       if (isCtrlOrCmd(e) && key === 'C') {
           notify();
           e.preventDefault();
           return false;
       }
   }

   // Ctrl/Cmd + J  OR  Ctrl/Cmd + Shift + J
   if (jh_disabled_options_data.disabled_ctst_j == "1") {
       if (isCtrlOrCmd(e) && key === 'J') {
           notify();
           e.preventDefault();
           return false;
       }
   }

   // Ctrl/Cmd + U (View Source)
   if (jh_disabled_options_data.disabled_ct_u == "1") {
       if (isCtrlOrCmd(e) && key === 'U') {
           notify();
           e.preventDefault();
           return false;
       }
   }

   // Ctrl/Cmd + P (Print)
   if (jh_disabled_options_data.disabled_ct_p == "1") {
       if (isCtrlOrCmd(e) && key === 'P') {
           notify();
           e.preventDefault();
           return false;
       }
   }

   // Ctrl/Cmd + S (Save)
   if (jh_disabled_options_data.disabled_ct_s == "1") {
       if (isCtrlOrCmd(e) && key === 'S') {
           notify();
           e.preventDefault();
           return false;
       }
   }
});

document.onkeydown = function(e) {
   if (jh_disabled_options_data.disabled_ct_p == "1") {
      if (e.ctrlKey && e.keyCode == 'P'.charCodeAt(0)) {
         notify();
         return false;
      }
   }
}

if (jh_disabled_options_data.disabled_dragging_img == "1") {
   jQuery("img").mousedown(function(){
    return false;
   });
}