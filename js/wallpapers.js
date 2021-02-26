/*jshint esversion: 6 */

/**
 * File wallpapers.js.
 *
 * Handles the wallpapers CPT
 */
// flickity
let laptopBackground = document.querySelector(".main-carousel");
var flkty = new Flickity( laptopBackground, {
  // options
  lazyLoad: true,
  wrapAround: true,
  cellAlign: 'left',
  contain: true,
  prevNextButtons: false,
  pageDots: false
});
// previous
let previousButton = document.querySelector( '.wp-nav-button-left' );
previousButton.addEventListener( 'click', function() {
	flkty.previous();
});
// next
var nextButton = document.querySelector('.wp-nav-button-right');
nextButton.addEventListener( 'click', function() {
  flkty.next();
});

// inject the checked value
const currentValue = document.querySelector('.currentValue');
const wallpaper_border =  document.querySelector('.border-2');

const colorPicker_form = document.forms.colorpicker;
const colorPicker_radios = colorPicker_form.elements.color;

const deviceToggle_form = document.forms.deviceToggle;
const deviceToggle_radios = deviceToggle_form.elements.dt;
const border_black = "https://assets.codepen.io/1274185/bergenborders.png";
const bergen_image = "https://assets.codepen.io/1274185/bergen+%281%29.jpg";
const transparent_radio =  document.getElementById("transparent");
const colorpicker_tl = gsap.timeline({});

colorpicker_tl.from( ".colorpicker form label", {
  y: 33,
  opacity: 0,
  stagger: 0.033,
  ease: "back.inOut",
});

deviceToggle_radios.addEventListener('change', () => {
   // Checked means Mobile, unchecked means Desktop.
   if(deviceToggle_radios.checked){
     console.log("checked");
     transparent_radio.checked = true;
     updateColorPicker();
     colorpicker_tl.reverse();
   }
   else{
     console.log("unchecked");
     colorpicker_tl.play();
   }


});

wallpaper_border.style.backgroundColor = colorPicker_radios.value;
console.log(colorPicker_radios.value);
// convert the RadioNodeList to an Array and using [].find() to get the element
console.log(Array.from(colorPicker_form.elements.color).find(colorPicker_radio => colorPicker_radio.checked));

// show latest value when radio checked changes
colorPicker_radios.forEach(colorPicker_radio => {
  colorPicker_radio.addEventListener('change', () => {
		 // currentValue.innerText = radios.value;
     console.log("changed");
		updateColorPicker();
  });
});
function updateColorPicker(){
  wallpaper_border.style.backgroundColor = colorPicker_radios.value;
}
