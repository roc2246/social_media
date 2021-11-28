// eslint exceptions:
/* eslint no-plusplus: ["error", { "allowForLoopAfterthoughts": true }] */

// Sets up the arrays with regex and textfields
let inputs = [];
let regex = [];

// eslint-disable-next-line no-unused-vars
function txtBoxes(form) {
  const txtBoxInputs = {
    /* inset textboxes as properties here with 'form' as
    the parameter */
  };

  // eslint-disable-next-line no-empty-pattern
  const { /* insert properties from 'txtBoxInputs' here */ } = txtBoxInputs;

  inputs.push();
  return inputs;
}

// eslint-disable-next-line no-useless-escape
// regex variables

function regexAssign() {
  regex.push();
  return regex;
}

// Displays loading message whn email is sending
function loadMssg() {
  const status = document.createElement('h4');
  status.id = 'sendMssg';
  // eslint-disable-next-line prefer-template
  document.getElementById('sendMssg').style.marginTop = 15 + 'px';
  document.getElementsByTagName('form')[0].appendChild(status);
  if (document.readyState !== 'loading') {
    document.getElementById('sendMssg').innerHTML = 'Sending...';
  } else {
    document.getElementById('sendMssg').style.visibility = 'hidden';
  }

  if (document.getElementById('sent')) {
    document.getElementById('sent').remove();
  }
}

/// ///////Checks for errors upon submission///////////////////
// eslint-disable-next-line no-unused-vars
function submitForm(form, refreshTo) {
  const regexTest = [];
  txtBoxes(form);
  regexAssign();
  function everyOne() {
    for (let i = 0; i < inputs.length; i++) {
      if (regex[i].test(inputs[i].value) === true) {
        regexTest.push(regex[i].test(inputs[i].value));
      } else {
        // eslint-disable-next-line no-continue
        continue;
      }
    }
  }

  everyOne();

  if (regexTest.length === inputs.length) {
    if (typeof regexEmail !== 'undefined') loadMssg();
    form.setAttribute('action', refreshTo);
    form.setAttribute('onsubmit', 'return true;');
  } else {
    for (let i = 0; i < inputs.length; i++) {
      if (!regex[i].test(inputs[i].value)) {
        // eslint-disable-next-line no-alert
        alert(`Please fill out a valid ${inputs[i].getAttribute('name')}.`);
        inputs[i].focus();
        inputs[i].select();
      }
    }
    form.setAttribute('action', '');
    form.setAttribute('onsubmit', 'return false;');
    inputs = [];
    regex = [];
  }
}
