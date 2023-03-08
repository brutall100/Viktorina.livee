let data;
async function fetchData() {
  try {
    const response = await axios.get('http://localhost:3000/data');
    return response.data;
  } catch (error) {
    console.error(error);
  }
}

(async function() {
  const data = await fetchData();
  console.log('Data:', data);
  console.log('Question:', data.data.question);
  console.log('ID:', data.data.id);
  console.log('Answer:', data.data.answer); 
  console.log('Litan:', data.data.lita);
  console.log('Bonus:', data.data.bonusLita);
  const dataContainer = document.getElementById("dataContainer");
  dataContainer.innerHTML = JSON.stringify(data);
  displayQuestion(data);
  generateAndDisplayRandomPoint(data.data.lita);
  generateBonusPoints(data.data.bonusLita);

  lita = data.data.lita;
  const litaContainer = document.getElementById("lita");
  litaContainer.innerHTML = lita;

  const bonusLitaContainer = document.getElementById("lita-bonus");
  bonusLitaContainer.innerHTML = data.data.bonusLita;
  
})();


                      // Rodyti klausima
async function displayQuestion(data) {
  const questionElement = document.getElementById("question");
  questionElement.innerText = data.data.question;
  
  const answersElement = document.getElementById("answer");
  answersElement.innerHTML = "";
  
  const dotsElement = document.getElementById("dot-answer");
  dotsElement.innerHTML = "";
  
  const lenghtElement = document.getElementById("dot-answer-lenght");
  lenghtElement.innerText = data.data.answer.length;
  
  const words = data.data.answer.split(" ");
  const underscore = "_";
  
  for (let i = 0; i < words.length; i++) {
    for (let j = 0; j < words[i].length; j++) {
      dotsElement.innerHTML += " &#x2B1C; ";
    }
    if (i < words.length - 1) {
      dotsElement.innerHTML += `${underscore}`;
    }
  }
    displayLettersWithDelay(answersElement, data.data.answer, 3000);
}
async function displayLettersWithDelay(element, string, delay) {
  for (let i = 0; i < 4; i++) {
    await new Promise((resolve) => setTimeout(resolve, 5000 + delay * i));
    element.innerHTML += string[i];
  }
}



//                    LITAI
const generateAndDisplayRandomPoint = async (lita) => {
  litoVerte = "";
  imageSrc = "";
  const litaiImg = document.getElementById("litai-img");

  if (lita === 1) {
    litoVerte = "Litas";
    imageSrc = "http://localhost/aldas/Viktorina.live/images/ImgLitai/1Lt.png";
  } else if (lita === 2) {
    litoVerte = "Litai";
    imageSrc = "http://localhost/aldas/Viktorina.live/images/ImgLitai/1Lt.png";
    displayImage(imageSrc, litaiImg, "on-off-litai1");
    imageSrc = "http://localhost/aldas/Viktorina.live/images/ImgLitai/1Lt.png";
  } else if (lita === 3) {
    litoVerte = "Litai";
    imageSrc = "http://localhost/aldas/Viktorina.live/images/ImgLitai/1Lt.png";
    displayImage(imageSrc, litaiImg, "on-off-litai");
    imageSrc = "http://localhost/aldas/Viktorina.live/images/ImgLitai/2Lt.png";
  } else if (lita === 4) {
    litoVerte = "Litai";
    imageSrc = "http://localhost/aldas/Viktorina.live/images/ImgLitai/2Lt.png";
    displayImage(imageSrc, litaiImg, "on-off-litai");
    imageSrc = "http://localhost/aldas/Viktorina.live/images/ImgLitai/2Lt.png";
  } else if (lita === 5) {
    litoVerte = "Litai";
    imageSrc = "http://localhost/aldas/Viktorina.live/images/ImgLitai/5Lt.png";
  } else {
    litoVerte = "";
    imageSrc = "";
  }
  
  displayImage(imageSrc, litaiImg, "new-class1");
  document.getElementById("points").innerHTML = `Verte: ${lita} ${litoVerte}&nbsp;  `;
};
  
  const displayImage = (src, parent, className) => {
  const imageElement = document.createElement("img");
  imageElement.src = src;
  imageElement.alt = `${lita} Litai`;
  imageElement.classList.add(className);
  parent.appendChild(imageElement);
};



//                BONUS-LITAI
function generateBonusPoints(bonusLita) {
 
const pointsElement = document.getElementById('bonus-points')
const imageElement = document.getElementById('litai-img-bonus')

if (bonusLita > 0) {
  pointsElement.innerText= ` + Bonus: ${bonusLita}`
  let images = "";
  if(bonusLita === 10 || bonusLita === 20 || bonusLita === 50) {
      images += `<img src="http://localhost/aldas/Viktorina.live/images/ImgLitai/${bonusLita}Lt.png" alt="${bonusLita} Litų">`
  }else if(bonusLita === 30) {
       {
        images += `<img src="http://localhost/aldas/Viktorina.live/images/ImgLitai/10Lt.png" alt="Dešimt litų">`
        images += `<img src="http://localhost/aldas/Viktorina.live/images/ImgLitai/20Lt.png" alt="Dvidešimt litų">`
      }
  }else if(bonusLita === 40) {
      for (let i = 0; i < 2; i++) {
        images += `<img src="http://localhost/aldas/Viktorina.live/images/ImgLitai/20Lt.png" alt="Dvidešimt litų">`
      }
  }
  imageElement.innerHTML = images
} else {
  pointsElement.style.display = "none"
}

}


                  //Atsakymas
const userData = {
  name: '',
  level: '',
  points: ''
};

const populateUserData = () => {
  const userDataElement = document.getElementById('user-data');
  userData.name = userDataElement.dataset.name;
  userData.level = userDataElement.dataset.level;
  userData.points = userDataElement.dataset.points;
}

populateUserData();

const answerForm = document.getElementById('answer-form');

answerForm.addEventListener('submit', (event) => {
  event.preventDefault();
  const answerInput = document.getElementById('answer-input');
  const userAnswer = answerInput.value;

  handleUserAnswer(userAnswer);

  answerInput.value = '';
});

const handleUserAnswer = async (userAnswer) => {
  const data = await fetchData();

  if (!data || !data.data || !data.data.answer) {
    console.error('Answer not found in data object');
    return;
  }

  const correctAnswer = data.data.answer.toLowerCase();
  const userAnswerLower = userAnswer.toLowerCase();

  if (userAnswerLower === correctAnswer) {
    const litaPoints = parseInt(data.data.lita, 10) + parseInt(data.data.bonusLita, 10);
    userData.points = litaPoints.toString();
    const successMsg = `Teisingai atsakė ${userData.name}: <span class="special-atsakymas" style="color: green; font-weight: bold">${userAnswer}</span> ${userData.name} gauna ${litaPoints} litų`;
    document.getElementById('answer').innerHTML = successMsg;
  
    // Send HTTP POST request to update user's points
    const url = 'http://localhost:8000/a_points.js';
    const body = JSON.stringify({
      user_id_name: userData.name,
      points: litaPoints
    });    
  
    const headers = {
      'Content-Type': 'application/x-www-form-urlencoded'
    };
  
    const response = await fetch(url, {
      method: 'POST',
      headers,
      body
    });
  
    if (response.ok) {
      const { user_id_name, points } = await response.json();
      console.log(`User points updated successfully ${points}`);
      console.log("user_id_name: " + user_id_name);
      console.log("points: " + points);
    } else {
      console.error('Failed to update user points');
    }
  
    const answerInput = document.getElementById('answer-input');
    answerInput.disabled = true;
    setTimeout(() => {
      answerInput.disabled = false;
    }, 5000); // Disable answerInput for 5 seconds
  } else {
    const errorMsg = `Atsakymas "${userAnswer}" yra neteisingas. Bandykite dar kartą.`;
    document.getElementById('answer').textContent = errorMsg;
  }
  

  document.getElementById('answer-input').value = '';
};




const refreshPage = () => {
  setTimeout(() => {
    location.reload()
  }, 45000)
}
refreshPage()






// Get a reference to the form


//  // Get a reference to the form element
//  const form = document.getElementById('answer-form');

//  // Add an event listener to the form to handle submit events
//  form.addEventListener('submit', event => {
//    // Prevent the default form submission behavior
//    event.preventDefault();

//    // Get the value of the answer input field
//    const answer = event.target.elements.answer.value;

//    // Do something with the answer, such as sending it to a server or processing it in some way
//    // ...
//  })
   




// //  Chatt container
// function getFormattedTime() {
//   const date = new Date();
//   const hours = date.getHours();
//   const minutes = date.getMinutes();
//   const seconds = date.getSeconds();
//   return `${hours}:${minutes}:${seconds}`;
// }

// const chatContainer = document.getElementById('chat-container');
// const chatMessages = document.getElementById('chat-messages');
// const chatInput = document.getElementById('chat-input');
// const chatButton = document.getElementById('chat-button');

// // Save the text to localStorage
// localStorage.setItem('inputText', chatInput.value);

// // Retrieve the text from localStorage
// const storedText = localStorage.getItem('inputText');

// // Update the input field with the stored text
// if (storedText) {
//   chatInput.value = storedText;
// }

// chatButton.addEventListener('click', () => {
//   const message = chatInput.value;
//   const time = getFormattedTime();
//   chatInput.value = '';
//   chatMessages.innerHTML += `<div><span class="time">${time}</span> ${message}</div>`;
//   chatContainer.scrollTop = chatContainer.scrollHeight;

//   // Save the messages to localStorage
//   const messages = chatMessages.innerHTML;
//   localStorage.setItem('messages', messages);
// });


// // Retrieve the messages from localStorage
// const storedMessages = localStorage.getItem('messages');

// // Update the chat dialog box with the stored messages
// if (storedMessages) {
//   chatMessages.innerHTML = storedMessages;
// }




  



