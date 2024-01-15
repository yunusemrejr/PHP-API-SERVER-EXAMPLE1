
 
/**
 * Copyright (c) 2024 by YUNUS EMRE VURGUN
 * Programmed in January 2024, this is the GITHUB FREE EDITION of this software, some parts are modified.
 */
function logoShift(){
    setTimeout(()=>{
        document.querySelector('header img').setAttribute('src',"../assets/logo.png");

    },15000);
}
document.addEventListener('DOMContentLoaded',logoShift);

window.addEventListener('load', () => {
    setTimeout(function() {
        document.getElementById("loading-screen").style.display = "none";
        document.body.style.overflow = "auto";
    }, 3000);  
});

function display_error(){
    let errmsg = document.createElement('div');
            errmsg.innerHTML = 'Oh no! Wrong credentials!';
            errmsg.id = 'wrongpass';
            document.body.appendChild(errmsg);
            //delete
            setTimeout(()=>{document.querySelector('#wrongpass').remove()},9000);
        }

        function enableForm(){
            
           document.querySelector('.login-container').innerHTML+=`<form method="POST">
           <label for="username"><i class="fa-solid fa-user"></i> Username:</label>
           <input type="text" id="username" name="username" required="">
           
           <label for="password"><i class="fa-solid fa-key"></i> Password:</label>
           <input type="password" id="password" name="password" required="">
           
           <button type="submit"><i class="fas fa-door-open"></i> Login</button>
           </form>
 `       ;

        }

        document.addEventListener('DOMContentLoaded',()=>{
            enableForm();
        });