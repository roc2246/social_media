// eslint exceptions:
/* eslint no-plusplus: ["error", { "allowForLoopAfterthoughts": true }] */

// Sets up the arrays with regex and textfields
let inputs = [];
let regex = [];

function txtBoxes(form) {
  if (form === 'login') {
    const txtBoxInputs = {
      username: document.login.user,
      password: document.login.password,
    };

    const { username, password } = txtBoxInputs;

    inputs.push(username, password);
  } else if (form === 'newUser') {
    const txtBoxInputs = {
      email: document.newUser.email,
      username: document.newUser.user,
      password: document.newUser.password,
    };

    const { email, username, password } = txtBoxInputs;

    inputs.push(email, username, password);
  }
  return inputs;
}

// eslint-disable-next-line no-useless-escape
// regex variables

function regexAssign(form) {
  if (form === 'login') {
    const regexUsername = /^(?!\s*$).+/;
    const regexPassword = /^(?!\s*$).+/;

    regex.push(regexUsername, regexPassword);
  } else if (form === 'newUser') {
    // eslint-disable-next-line no-useless-escape
    const regexEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const regexUsername = /^(?!\s*$).+/;
    const regexPassword = /^(?!\s*$).+/;

    regex.push(regexEmail, regexUsername, regexPassword);
  }
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
  regexAssign(form);
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
    document.getElementsByName(form)[0].setAttribute('action', refreshTo);
    document.getElementsByName(form)[0].setAttribute('onsubmit', 'return true;');
  } else {
    for (let i = 0; i < inputs.length; i++) {
      if (!regex[i].test(inputs[i].value)) {
        // eslint-disable-next-line no-alert
        alert(`Please fill out a valid ${inputs[i].getAttribute('name')}.`);
        inputs[i].focus();
        inputs[i].select();
      }
    }
    document.getElementsByName(form)[0].setAttribute('action', '');
    document.getElementsByName(form)[0].setAttribute('onsubmit', 'return false;');
    inputs = [];
    regex = [];
  }
}
