<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="http://localhost/aldas/Viktorina.live/d_regilogi.css" />

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <title>Registracija ir Prisijungimas</title>
    
    <!-- <meta http-equiv="refresh" content="60"> -->

  </head>
  <body>
    <div class="container-generator">
      <div class="generate-butons">
        <h2 class="randomized" id="random-name"></h2>
        <button class="generate-btn" id="generuoti-varda">
          Generuoti vardą
        </button>
      </div>
      <div class="generate-butons">
        <h2 class="randomized" id="password"></h2>
        <button class="generate-btn" id="generate-pasword">
          Generuoti slaptažodį
        </button>
      </div>
    </div>


  <div class="container" id="container">
      <!-- Registracija -->
      <div class="form-container sign-up-container">
      <form method="POST" action="http://localhost:4000/register" id="register-form">
        <h1>Registracija</h1>
        <span>or use your email for registration</span>
        <div class="form-group">
          <input type="text" placeholder="Vardas" id="name-input" name="nick_name" required/>
          <span id="name-error"></span>
        </div>
        <div class="form-group">
          <input type="email" placeholder="@" id="user-email" name="user_email" required/>
          <span id="email-error"></span>
        </div>
        <div class="form-group">
          <input type="password" placeholder="Slaptažodis" id="password-input" name="user_password" required/>
          <span id="password-error"></span>
        </div>
        <button type="submit" name="submitBtnReg" value="Reginam" id="submitButtonReg">Register</button>
      </form>

      
      </div>

      <!-- Prisijungimas -->
      <div class="form-container sign-in-container">
      <form method="POST" action="http://localhost:4000/login">      
        <h1>Prisijungti</h1>
        <span>or use your account</span>
        <input type="text" placeholder="Name" name="nick_name" required/>
        <input type="password" placeholder="Password" name="user_password" required/>
        <a href="#">Forgot your password?</a>
        <button type="submit" name="submitBtnLog" value="Loginam" id="submitButtonLog">Login</button>
      </form>

    </div>

      <div class="overlay-container">
        <div class="overlay">
          <div class="overlay-panel overlay-left">
            <h1>Welcome Back!</h1>
            <p>To keep connected with us please login with your personal info</p>
            <button class="ghost" id="signIn">Sign In</button>
          </div>
          <div class="overlay-panel overlay-right">
            <h1>Hello, Friend!</h1>
            <p>Enter your personal details and start journey with us</p>
            <button class="ghost" id="signUp">Sign Up</button>
          </div>
        </div>
      </div>
  </div>



    <!-- <script src="http://localhost/aldas/Viktorina.live/d_server.js"></script> -->
    <script src="http://localhost/aldas/Viktorina.live/d_regilogi.js"></script>
    <script src="http://localhost/aldas/Viktorina.live/d_regilogi_nameGenerator.js"></script>
    <footer></footer>
  </body>
</html>
