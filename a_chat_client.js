const userDataChat = document.getElementById("chat-user-data")
const username = userDataChat.getAttribute("chat-data-name")
const chatUserId = document.getElementById("chat-user-id").value
const userLvl = parseInt(document.getElementById("chat-user-level").value)

console.log("Username:", username)
console.log("Chat User ID:", chatUserId)
console.log("User Level:", userLvl)

// Function to determine message limit based on user level
function getMessageLimit(userLvl) {
  // Define message limits for each user level in an object
  const messageLimits = {
    0: 8,
    1: 20,
    2: 35,
    3: 50,
    4: 100,
    5: 100,
  };
  // If the user level is not found in the object, return a default limit (e.g., 100)
  return messageLimits.hasOwnProperty(userLvl) ? messageLimits[userLvl] : 100;
}


// Function to scroll to the bottom of the chat messages
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

  // Save the user_message to local storage
  saveMessageToLocal(user_message)

  // Scroll to the bottom after adding a user_message
  scrollToBottom()
  console.log("Added user_message to chat")
}

// Function to save a user_message to local storage with a 20-message limit
function saveMessageToLocal(user_message) {
  let storedMessages = localStorage.getItem("chatMessages") || []

  if (typeof storedMessages === "string") {
    storedMessages = JSON.parse(storedMessages)
  }

  // Push the new user_message to the end of the array
  storedMessages.push(`${username}: ${user_message}`)

  // Limit the number of stored messages to 20
  if (storedMessages.length > 100) {
    storedMessages = storedMessages.slice(-100)
  }

  // Store the updated messages back to local storage
  localStorage.setItem("chatMessages", JSON.stringify(storedMessages))
  console.log("Saved user_message to local storage")
}

// Function to load messages from local storage and display them
function loadMessagesFromLocal() {
  const chatMessages = document.getElementById("chat-messages")
  chatMessages.innerHTML = "" // Clear existing messages

  let storedMessages = localStorage.getItem("chatMessages") || []
  if (typeof storedMessages === "string") {
    storedMessages = JSON.parse(storedMessages)
  }

  // Determine the maximum number of messages to display based on user level
  const maxMessages = getMessageLimit(userLvl) // Use the function here

  // Display the stored messages in the chat (limited by maxMessages)
  storedMessages.slice(-maxMessages).forEach((user_message) => {
    const newMessageItem = document.createElement("li")
    newMessageItem.textContent = user_message
    chatMessages.appendChild(newMessageItem)
  })

  console.log("Loaded messages from local storage")
}

// Function to handle sending a user_message
let canSendMessage = true; // Flag to control message sending
let sendButtonTimeout = null; // Timeout reference

function sendMessage(event) {
  if (event) {
    event.preventDefault(); // Prevent form submission and page reload
  }

  if (!canSendMessage) {
    console.log("You can send a message every 5 seconds.");
    return;
  }

  const inputElement = document.getElementById("chat-input-msg");
  const user_message = inputElement.value.trim();

  const userIdInput = document.getElementById("chat-user-id");
  const user_id = userIdInput.value;

  const userNameInput = document.getElementById("chat-user-name");
  const user_name = userNameInput.value;

  if (user_message !== "") {
    // Disable the send button
    chatButton.disabled = true;

    addMessageToChat(user_message);

    // Send the user_message to the server
    fetch("http://localhost:4005/save-message", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        message: user_message,
        user_id: user_id,
        user_name: user_name,
      }),
    })
      .then((response) => {
        if (response.ok) {
          console.log("Message sent to server successfully");
          canSendMessage = false; // Disable sending for 5 seconds

          // Set a timeout to re-enable the send button after 5 seconds
          sendButtonTimeout = setTimeout(() => {
            canSendMessage = true; // Allow sending
            chatButton.disabled = false; // Re-enable the send button
          }, 5000); // 5 seconds
        } else {
          console.error("Failed to send message");
          chatButton.disabled = false; // Re-enable the send button on error
        }
      })
      .catch((error) => {
        console.error("Error sending message:", error);
        chatButton.disabled = false; // Re-enable the send button on error
      });

    inputElement.value = "";
  }
}


// Event listener for the "Send" button
const chatButton = document.getElementById("chat-button")
chatButton.addEventListener("click", sendMessage)

// Event listener for pressing Enter in the input field
const chatInput = document.getElementById("chat-input-msg")
chatInput.addEventListener("keyup", (event) => {
  if (event.key === "Enter") {
    sendMessage(event)
  }
})

// Function to load messages from the server and display them in reverse order
async function loadMessagesFromServer() {
  try {
    const response = await fetch("http://localhost:4005/get-older-messages")
    if (!response.ok) {
      throw new Error("Failed to fetch messages from the server")
    }

    const messages = await response.json()

    const chatMessages = document.getElementById("chat-messages")

    // Determine message limits based on user level
    const messageLimit = getMessageLimit(userLvl)

    // Reverse the order of messages and then display them
    messages.reverse().forEach(({ chat_msg, chat_user_name }, index) => {
      // Check if the message is not in local storage and doesn't exceed the message limit before displaying it
      if (index < messageLimit && !isMessageInLocalStorage(`${chat_user_name}: ${chat_msg}`)) {
        const newMessageItem = document.createElement("li")
        newMessageItem.textContent = `${chat_user_name}: ${chat_msg}`
        chatMessages.appendChild(newMessageItem)
      }
    })

    console.log("Loaded messages from the server")
  } catch (error) {
    console.error("Error loading messages from the server:", error)
  }
}

// Function to check if a message is in local storage
function isMessageInLocalStorage(message) {
  let storedMessages = localStorage.getItem("chatMessages") || []

  if (typeof storedMessages === "string") {
    storedMessages = JSON.parse(storedMessages)
  }

  // Check if the message is in the array
  return storedMessages.includes(message)
}

// Modify the window load event listener
window.addEventListener("load", async () => {
  await loadMessagesFromServer()
  loadMessagesFromLocal()
  scrollToBottom()
})
