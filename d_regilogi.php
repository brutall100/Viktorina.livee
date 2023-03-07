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
        <div class="form-group">
        <label for="gender-select">Lytis:</label>
        <select id="gender-select" name="gender">
          <option value="Nepasirinkta">Pasirinkite savo lytį</option>
          <option value="Vyras">Vyras</option>
          <option value="Moteris">Moteris</option>
          <option value="Abinary">Abinary</option>
          <option value="Agender">Agender</option>
          <option value="Androgyne">Androgyne</option>
          <option value="Androgynous">Androgynous</option>
          <option value="Aporagender">Aporagender</option>
          <option value="Bakla">Bakla</option>
          <option value="Bigender">Bigender</option>
          <option value="Binary">Binary</option>
          <option value="Bissu">Bissu</option>
          <option value="Butch">Butch</option>
          <option value="Calalai">Calalai</option>
          <option value="Cis">Cis</option>
          <option value="Cisgender">Cisgender</option>
          <option value="Cis-female">Cis female</option>
          <option value="Cis-male">Cis male</option>
          <option value="Cis-man">Cis man</option>
          <option value="Cis-woman">Cis woman</option>
          <option value="Demi-boy">Demi-boy</option>
          <option value="Demiflux">Demiflux</option>
          <option value="Demigender">Demigender</option>
          <option value="Demi-girl">Demi-girl</option>
          <option value="Demi-guy">Demi-guy</option>
          <option value="Demi-man">Demi-man</option>
          <option value="Dual-gender">Dual gender</option>
          <option value="Demi-woman">Demi-woman</option>
          <option value="Endosex">Endosex</option>
          <option value="Female-to-male">Female to male</option>
          <option value="Femme">Femme</option>
          <option value="Ftm">FTM</option>
          <option value="Gender-bender">Gender bender</option>
          <option value="Gender-diverse">Gender Diverse</option>
          <option value="Gender-gifted">Gender gifted</option>
          <option value="Genderfluid">Genderfluid</option>
          <option value="Genderflux">Genderflux</option>
          <option value="Genderfuck">Genderfuck</option>
          <option value="Genderless">Genderless</option>
          <option value="Gender-nonconforming">Gender nonconforming</option>
          <option value="Genderqueer">Genderqueer</option>
          <option value="Gender-questioning">Gender questioning</option>
          <option value="Gender-variant">Gender variant</option>
          <option value="Graygender">Graygender</option>
          <option value="Hijra">Hijra</option>
          <option value="Intergender">Intergender</option>
          <option value="Intersex">Intersex</option>
          <option value="Kathoey">Kathoey</option>
          <option value="Male to female">Male to female</option>
          <option value="Man">Man</option>
          <option value="Man of trans experience">Man of trans experience</option>
          <option value="Maverique">Maverique</option>
          <option value="MTF">MTF</option>
          <option value="Multigender">Multigender</option>
          <option value="Muxe">Muxe</option>
          <option value="Neither">Neither</option>
          <option value="Neurogender">Neurogender</option>
          <option value="Neutrois">Neutrois</option>
          <option value="Non-binary">Non-binary</option>
          <option value="Non-binary transgender">Non-binary transgender</option>
          <option value="Omnigender">Omnigender</option>
          <option value="Pangender">Pangender</option>
          <option value="Polygender">Polygender</option>
          <option value="Person of transgendered experience">Person of transgendered experience</option>
          <option value="Third gender">Third gender</option>
          <option value="Trans">Trans</option>
          <option value="Trans female">Trans female</option>
          <option value="Trans male">Trans male</option>
          <option value="Trans man">Trans man</option>
          <option value="Trans person">Trans person</option>
          <option value="Trans woman">Trans woman</option>
          <option value="Transgender">Transgender</option>
          <option value="Transgender female">Transgender female</option>
          <option value="Transgender male">Transgender male</option>
          <option value="Transgender man">Transgender man</option>
          <option value="Transgender person">Transgender person</option>
          <option value="Transgender woman">Transgender woman</option>
          <option value="Transfeminine">Transfeminine</option>
          <option value="Transmasculine">Transmasculine</option>
          <option value="Transsexual">Transsexual</option>
          <option value="Transsexual female">Transsexual female</option>
          <option value="Transsexual male">Transsexual male</option>
          <option value="Transsexual man">Transsexual man</option>
          <option value="Transsexual person">Transsexual person</option>
          <option value="Transsexual woman">Transsexual woman</option>
          <option value="Travesti">Travesti</option>
          <option value="Trigender">Trigender</option>
          <option value="Two spirit">Two spirit</option>
          <option value="Vakasalewalewa">Vakasalewalewa</option>
          <option value="Woman">Woman</option>
          <option value="Woman of trans experience">Woman of trans experience</option>
          <option value="X-gender">X-gender</option> 
          <option value="Xenogender">Xenogender</option>
          <option value="Other">Other</option>
        </select>
        <div id="other-gender-container" style="display:none;">
          <label for="other-gender-input">Įrašykite savąją lytį :</label>
          <input type="text" id="other-gender-input" name="other_gender">
        </div>
      </div>
      <script>
      document.getElementById('gender-select').addEventListener('change', function() {
        if (this.value === 'Other') {
          document.getElementById('other-gender-container').style.display = 'block';
        } else {
          document.getElementById('other-gender-container').style.display = 'none';
        }
      });
      </script>

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
