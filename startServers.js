const { spawn } = require('child_process');

// Start server.js
const serverProcess = spawn('node', ['server.js']);
console.log('server.js started on port 3000');

// Start d_server.js
const dServerProcess = spawn('node', ['d_server.js']);
console.log('d_server.js started on port 4000');

// Handle errors
serverProcess.on('error', (err) => {
  console.error('Error starting server.js', err);
});

dServerProcess.on('error', (err) => {
  console.error('Error starting d_server.js', err);
});

// Handle exit events
serverProcess.on('exit', (code) => {
  console.log(`server.js exited with code ${code}`);
});

dServerProcess.on('exit', (code) => {
  console.log(`d_server.js exited with code ${code}`);
});


// node startServers.js