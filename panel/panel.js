
 
/**
 * Copyright (c) 2024 by YUNUS EMRE VURGUN
 * Programmed in January 2024, this is the GITHUB FREE EDITION of this software, some parts are modified.
 */

window.addEventListener('load', () => {
  setTimeout(function() {
      document.getElementById("loading-screen").remove();
      document.body.style.overflow = "auto";
  }, 3000);  
});


let fast=0;
//FAST UPDATE ON OFF
document.addEventListener('DOMContentLoaded', () => {
  const checkbox = document.getElementById("toggle-checkbox");
  const toggleSwitch = document.querySelector(".toggle-switch");
  checkbox.checked = true; //true means OFF, false means ON
  checkbox.addEventListener("change", () => {
      if (checkbox.checked) {
          toggleSwitch.style.transform = "translateX(-30px)";
          toggleSwitch.style.backgroundColor = "#4a4a4a";
          // is switched off
          fast=0;
          console.log(fast);
      } else {
          toggleSwitch.style.transform = "translateX(0)";
          toggleSwitch.style.backgroundColor = "#6db84d";
          fast=1;
          console.log(fast);
       }
  });
});



//API ON OFF
document.addEventListener('DOMContentLoaded', () => {

  const checkbox = document.getElementById("toggle-checkbox2");
  const toggleSwitch = document.querySelectorAll(".toggle-switch")[1];
  checkbox.checked = true; //true means OFF, false means ON
  checkbox.addEventListener("change", () => {
      let output=  document.querySelector('#url-output');
       if (checkbox.checked) {
          toggleSwitch.style.transform = "translateX(-30px)";
          toggleSwitch.style.backgroundColor = "#4a4a4a";
          //  logic   when the toggle is switched on
         output.style.visibility='hidden';
      } else {
          toggleSwitch.style.transform = "translateX(0)";
          toggleSwitch.style.backgroundColor = "#6db84d";
          // You can add custom logic here when the toggle is switched off
          output.style.visibility='visible';

      }

      if(!checkbox.checked){ //IF ON aka. checkbox =false
          const textarea = document.querySelector('textarea');
          let uniqueString='';
          const randomNumber = (length) => {
              return Math.floor(Math.random() * length);
            };            const letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];          
            for (let i = 0; i < letters.length; ++i) {
              const randomIndex = randomNumber(letters.length);
              uniqueString += letters[randomIndex];
            }
            var currentURL = new URL(window.location.href);
            var domain = currentURL.hostname;
            let finalurl=domain+'/industroserve/api/endpoint.php?id='+uniqueString;
            let tofetchurl=domain+'/industroserve/api/api_requester.php?id='+uniqueString;
            textarea.value=finalurl;
            let slug=uniqueString;
            let fast_update=fast;

//data type find start
var radioButtons = document.getElementsByName("options");
var selectedRadioButton;
for (var i = 0; i < radioButtons.length; i++) {
  if (radioButtons[i].checked) {
      selectedRadioButton = radioButtons[i];
      break;  
  }
}

let data_type;

if (selectedRadioButton) {
  data_type=  selectedRadioButton.id;
} else {

data_type=radioButtons[0];
}
//data type find end
 createAPI(tofetchurl,fast_update,data_type,slug);
       }
  });
});

function copyText() {
  
  // Get references to the textarea and copy button
  const textarea = document.querySelector('textarea');
  const copyButton = document.querySelector('.copy-button');

  // add a click event listener to the copy button
  
      
 for(let i=0;i<2;i++){
       // select the text inside the textarea
       textarea.select();

       try {
         // use the Clipboard API to copy the text
         navigator.clipboard.writeText(textarea.value).then(function() {
           console.log("Text successfully copied to clipboard");
         }).catch(function(err) {
           console.error("Could not copy text: ", err);
         });
       } catch (err) {
         // handle errors, if any
         alert('Unable to copy text to clipboard');
       }
 }
  

  document.querySelector('.copy-button').innerText='Copied!';
  document.querySelector('.copy-button').style.backgroundColor='#669c60';


}


function createAPI(tofetchurl,fast_update,data_type,slug){

let url = tofetchurl;
if(url.includes('localhost')){
url=url.replace('localhost','http://localhost');
}
const data = {
speed:fast_update,
content: data_type,
targetUrl: tofetchurl,
slug: slug
};

const jsonData = JSON.stringify(data);

const headers = {
'Content-Type': 'application/json'
};

fetch(url, {
method: 'POST',
headers: headers,
body: jsonData
})
.then(response => {
if (!response.ok) {
  throw new Error('Network response was not ok');
}
return response.json(); 
})
.then(data => {
 console.log(data);
})
.catch(error => {
 console.error('There was a problem with the fetch operation:', error);
});
}