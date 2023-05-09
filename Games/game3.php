<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/aldas/Viktorina.live/Games/gameStyle3.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Papildomas Klausimas</title>
  </head>




<body>
  <div class="container"> 
    <?php
      session_start();
      $name = $_GET['name'];
      echo "<div class='greeting-container'>Labas <span>$name</span> <br> Jūs gavote progą atsakyti į papildomą klausimą.</div>";
    ?>

    <header>
      <h2>Šiame žaidime gali laimėti nuo -100 Litų iki +300 Litų.</h2>
    </header>

    <main>
      <div id="question-container">
        <div id="question">Klausimas:</div>
        <div id="answer-asteriks"></div>
      </div>

      <div id="answer-container">
        <label for="answer-input">Atsakymas</label>
        <input type="text" id="answer-input" maxlength="50">
        <button id="submit-answer">Submit</button>
      </div>
    </main>

    <footer>
      <div id="winning-message"></div>
      <div id="negative-message" ></div>
      <div id="closeMessage" class="message-close"></div>
      <button onclick="closeGame()" class="close-Btn">Pabėgti?</button>
    </footer>
  </div>
</body>


<script>
$(document).ready(() => {
  $.get('http://localhost:7000/game3_server', data => {
    const actualAnswer = data.answer
    const serverAnswer = data.answer.toLowerCase();
    const words = serverAnswer.split(' ');
    let hiddenAnswer = '';
    for (let i = 0; i < words.length; i++) {
      hiddenAnswer += `${'*'.repeat(words[i].length)} `;
    }
    $('#question').html(`Klausimas: <span class="question-text">${data.question}</span>`);
    $('#answer-asteriks').text(hiddenAnswer.trim());
    $('#submit-answer').click(event => {
      event.preventDefault();
      
      const hasAnswered = localStorage.getItem('hasAnswered');
      if (hasAnswered && Date.now() - hasAnswered < 60 * 1000) { // Laikas 60 sekundziu kolkas paskui 300 bus. // Check if the user has already answered within the last minute
        alert("Galima atsakyti tik vieną kartą.");
        return;
      }
      
      const userAnswer = $('#answer-input').val().toLowerCase();
      if (checkLettersAndCompare(userAnswer, serverAnswer)) {
        const points = generatePoints();
        const message = showMessage(points, 'Lit');
        $('#winning-message').text(`Atsakymas teisingas! ${actualAnswer} Jums pervesta ${message}`);
        $('#answer-input').prop('disabled', true);
        $('#submit-answer').prop('disabled', true);
      
        const data = {
          user_id_name: "<?php echo $name; ?>",
          points: points
        };
        fetch('http://localhost:5000/playGame.js', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          mode: 'no-cors',
          body: JSON.stringify(data)
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.error(error);
        });
               
        localStorage.setItem('hasAnswered', Date.now());
        setTimeout(() => {
          localStorage.removeItem('hasAnswered');
        }, 60 * 1000);     // Laikas 60 sekundziu kolkas paskui 300 bus. // Set the hasAnswered flag in localStorage with an expiration time of 1 minute
      } 
      else {
        const negativePoints = generateMinusPoints();
        const negativeMessage = showMessage(negativePoints, 'Lit');
        $('#answer-input').prop('disabled', true);
        $('#submit-answer').prop('disabled', true);
  
        const data = {
          user_id_name: "<?php echo $name; ?>",
          points: negativePoints
        };
        fetch('http://localhost:5000/playGame.js', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          mode: 'no-cors',
          body: JSON.stringify(data)
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.error(error);
        });
        $('#winning-message').text(`Atsakymas ${userAnswer} yra neteisingas! Bandykite kitą kartą. Atsakymas buvo ${actualAnswer}. Jūs praradote ${negativeMessage}`);
        $('#answer-input').val('');

      }
    });
  });
});


const answerInput = document.getElementById("answer-input");
const submitButton = document.getElementById("submit-answer");

answerInput.addEventListener("keydown", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
    submitButton.click();
  }
});


function startClosePage() {
  let pageCloseCountdown = 200;  // Lango uzdarymo laikas
  let submitClicked = false;  // Has the submit button been clicked?
  
  $('#submit-answer').click(event => {
    submitClicked = true;
  });
  
  function countdown() {
    if (submitClicked) {
  if (pageCloseCountdown > 8) {
    pageCloseCountdown = 8;
    closeMessage.innerHTML = `Iki pasimatymo! Puslapis užsidaro už ${pageCloseCountdown} sekundžių.`;
  } else {
    pageCloseCountdown--;
    closeMessage.innerHTML = `Iki pasimatymo! Puslapis užsidaro už ${pageCloseCountdown} sekundžių.`;
  }
} else {
  pageCloseCountdown--;
  closeMessage.innerHTML = `Likęs laikas atsakymui ${pageCloseCountdown} sekundžių.`;
} 
    if (pageCloseCountdown > 0) {
      setTimeout(countdown, 1000);
    } else {
      window.close();
    }
  }
  
  countdown();
}
startClosePage();


function checkLettersAndCompare(str1, str2) {
  const letterMap = {
    ą: "a",
    č: "c",
    ę: "e",
    ė: "e",
    į: "i",
    š: "s",
    ų: "u",
    ū: "u",
    ž: "z"
  }
  // Replace accented letters with their ASCII equivalents
  const cleanStr1 = str1.replace(/[ąčęėįšųž]/gi, (match) => letterMap[match.toLowerCase()])
  const cleanStr2 = str2.replace(/[ąčęėįšųž]/gi, (match) => letterMap[match.toLowerCase()])

  return cleanStr1 === cleanStr2
}

function generatePoints() {
  return Math.floor(Math.random() * 251) + 50;
}

function generateMinusPoints() {
  return -Math.floor(Math.random() * 81 + 20);
}

function showMessage(points, word) {
  if (points % 10 === 1 && points % 100 !== 11) {
    // handles numbers that end with 1
    return `${points} ${word}ą.`;
  } else {
    // handles all other numbers
    return `${points} ${points % 10 === 0 || (points % 100 >= 11 && points % 100 <= 19) ? `${word}u` : `${word}us`}.`;
  }
}

window.onload = function() {
  document.getElementById("answer-input").focus();
};

function closeGame() {
  window.close();
};    

</script>

</html>

