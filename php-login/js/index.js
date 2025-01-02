// Select the elements
const side1 = document.querySelector('.side-1');
const side2 = document.querySelector('.side-2');
const signInF = document.querySelector('.sign-in fieldset');
const signUpF = document.querySelector('.sign-up fieldset');
const toggleLogButtons = document.querySelectorAll('.toggle-log');

// Helper functions for modifying styles and attributes
function setStyles(element, styles) {
  for (const property in styles) {
    element.style[property] = styles[property];
  }
}

function setAttribute(element, attribute, value) {
  element.setAttribute(attribute, value);
}

function removeAttribute(element, attribute) {
  element.removeAttribute(attribute);
}

function addClass(element, className) {
  element.classList.add(className);
}

function removeClass(element, className) {
  element.classList.remove(className);
}

// Add event listeners
toggleLogButtons.forEach((button) => {
  button.addEventListener('click', () => {
    if (button.closest('.side-1')) {
      // Logic for "SIGN UP" button
      setStyles(side1, {
        transform: 'rotateY(180deg)',
        backgroundPosition: '100%',
      });
      setStyles(side2, {
        transform: 'rotateY(0deg)',
        backgroundPosition: '100%',
      });
      setAttribute(signInF, 'disabled', 'disable');
      addClass(signInF, 'block');
      removeAttribute(signUpF, 'disabled');
      removeClass(signUpF, 'block');
    } else if (button.closest('.side-2')) {
      // Logic for "SIGN IN" button
      setStyles(side1, {
        transform: 'rotateY(0deg)',
        backgroundPosition: '0%',
      });
      setStyles(side2, {
        transform: 'rotateY(-180deg)',
        backgroundPosition: '0%',
      });
      removeAttribute(signInF, 'disabled');
      removeClass(signInF, 'block');
      setAttribute(signUpF, 'disabled', 'disable');
      addClass(signUpF, 'block');
    }
  });
});
