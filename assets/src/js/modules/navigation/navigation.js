// Keep the instance (Singleton).
let instance = null;
let isDisplayed = false;

function createNewInstance() {

  function open() {
    if (! isDisplayed) {
      console.log('Open nav');
      isDisplayed = true;
    }
  }

  function close() {
    if (isDisplayed) {
      console.log('Close nav');
      isDisplayed = false;
    }
  }

  function toggle() {
    if (isDisplayed) {
      close();
    } else {
      open();
    }
  }

  return {
    isActive: () => (isDisplayed),
    open,
    close,
    toggle
  };
}

/**
 * Initialize the navigation
 * and returns the instance.
 * @params {Object} params Parameters.
 * @returns {NavigationInstance}
 */
function initialize() {
  instance = (instance !== null) ? instance : createNewInstance();
  return instance;
}

export default initialize;
