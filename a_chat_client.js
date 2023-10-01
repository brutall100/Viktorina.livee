const userDataChat = document.getElementById("chat-user-data")
const username = userDataChat.getAttribute("chat-data-name")
const chatUserId = document.getElementById("chat-user-id").value
const userLvl = parseInt(document.getElementById("chat-user-level").value)

console.log("Username:", username)
console.log("Chat User ID:", chatUserId)
console.log("User Level:", userLvl)

function getMessageLimit(userLvl) {
  const messageLimits = {
    0: 8,
    1: 20,
    2: 35,
    3: 50,
    4: 100,
    5: 100
  }
  return messageLimits.hasOwnProperty(userLvl) ? messageLimits[userLvl] : 100
}

function scrollToBottom() {
  const chatMessages = document.getElementById("chat-container-messages")
  console.log(chatMessages)
  chatMessages.scrollTop = chatMessages.scrollHeight
  console.log("Scrolled to the bottom")
}

// Function to add a user_message to the chat
function addMessageToChat(user_message) {
  const chatMessages = document.getElementById("chat-messages")
  const newMessageItem = document.createElement("li")
  newMessageItem.textContent = `${username}: ${user_message}`
  chatMessages.appendChild(newMessageItem)

  scrollToBottom()
  console.log("Added user_message to chat")
}

// Function to handle sending a user_message
let canSendMessage = true
let sendButtonTimeout = null

function sendMessage(event) {
  if (event) {
    event.preventDefault()
  }

  if (!canSendMessage) {
    console.log("You can send a message every 5 seconds.")
    return
  }

  const inputElement = document.getElementById("chat-input-msg")
  const user_message = inputElement.value.trim()

  const userIdInput = document.getElementById("chat-user-id")
  const user_id = userIdInput.value

  const userNameInput = document.getElementById("chat-user-name")
  const user_name = userNameInput.value

  if (user_message !== "") {
    chatButton.disabled = true // Disable the send button

    addMessageToChat(user_message)

    // Send the user_message to the server
    fetch("http://localhost:4005/save-message", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        message: user_message,
        user_id: user_id,
        user_name: user_name
      })
    })
      .then((response) => {
        if (response.ok) {
          console.log("Message sent to server successfully")
          canSendMessage = false

          sendButtonTimeout = setTimeout(() => {
            canSendMessage = true
            chatButton.disabled = false
          }, 10000) // 10 seconds   // Set a timeout to re-enable the send button after 10 seconds
        } else {
          console.error("Failed to send message")
          chatButton.disabled = false
        }
      })
      .catch((error) => {
        console.error("Error sending message:", error)
        chatButton.disabled = false
      })

    inputElement.value = ""
  }
}

const chatButton = document.getElementById("chat-button")
chatButton.addEventListener("click", sendMessage)

const chatInput = document.getElementById("chat-input-msg")
chatInput.addEventListener("keyup", (event) => {
  if (event.key === "Enter") {
    sendMessage(event)
  }
})

// Function to load messages from the server and display them
async function loadMessagesFromServer() {
  try {
    const response = await fetch("http://localhost:4005/get-older-messages");
    if (!response.ok) {
      throw new Error("Failed to fetch messages from the server");
    }

    const messages = await response.json();

    const chatMessages = document.getElementById("chat-messages");

    const messageLimit = getMessageLimit(userLvl);

    // Filter and display messages based on the user's level
    const messagesToDisplay = messages
      .slice(-messageLimit) // Get the latest 'messageLimit' messages
      .reverse(); // Reverse the order to display the newest first

    messagesToDisplay.forEach(({ chat_msg, chat_user_name }) => {
      const newMessageItem = document.createElement("li");
      newMessageItem.textContent = `${chat_user_name}: ${chat_msg}`;
      chatMessages.appendChild(newMessageItem);
    });

    console.log("Loaded messages from the server");
  } catch (error) {
    console.error("Error loading messages from the server:", error);
  }
}

window.addEventListener("load", async () => {
  await loadMessagesFromServer()
  scrollToBottom()
})
