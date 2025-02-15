// value filled and active 
const setActive = (el, active) => {
    const formField = el.parentNode
    if (active) {
      formField.classList.add('field_active')
    } else {
      formField.classList.remove('field_active')
      el.value === '' ? 
        formField.classList.remove('field_filled') : 
        formField.classList.add('field_filled')
    }
  }

  [].forEach.call(
    document.querySelectorAll('.form-control'),
    (el) => {
      el.onblur = () => {
        setActive(el, false)
      }
      el.onfocus = () => {
        setActive(el, true)
      }
    }
  )
// reset field
function resetcode()  
{
    var element = document.getElementByClass("resetdata");
    element.reset();
}


// hide-show password
jQuery(".toggle-hide-show").click(function() {
    jQuery(this).toggleClass("fa-eye fa-eye-slash");
    input = jQuery(this).parent().find("input");
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

// inputel
// const input = document.querySelector("#phone");
//   window.intlTelInput(input, {    
//     separateDialCode: 'true',
//     utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",    
// });