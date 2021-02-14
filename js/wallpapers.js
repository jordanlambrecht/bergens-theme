/**
 * File wallpapers.js.
 *
 * Handles the wallpapers CPT
 */

// inject the checked value
const currentValue = document.querySelector('.currentValue');
const wallpaper_border = document.querySelector('.width-adjusting-to-height .content .border2');

const form = document.forms.colorpicker;
const radios = form.elements.color;
const border_black = "https://assets.codepen.io/1274185/bergenborders.png";
const bergen_image = "https://assets.codepen.io/1274185/bergen+%281%29.jpg";


mergeImages([bergen_image, border_black])
  .then(b64 => document.querySelector('.test').src = b64);
  // data:image/png;base64,iVBORw0KGgoAA...


// show selected on page load
// currentValue.innerText = radios.value;
wallpaper_border.style.borderColor = radios.value;

// convert the RadioNodeList to an Array and using [].find() to get the element
console.log(Array.from(form.elements.color).find(radio => radio.checked));

// show latest value when radio checked changes
radios.forEach(radio => {
  radio.addEventListener('change', () => {
		// currentValue.innerText = radios.value;
		wallpaper_border.style.backgroundColor = radios.value;
  });
});
