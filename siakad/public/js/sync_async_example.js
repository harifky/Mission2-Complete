// sync_async_example.js

// Synchronous example
console.log("Synchronous start");
console.log("This runs immediately");
console.log("Synchronous end");

// Asynchronous example using setTimeout
console.log("Asynchronous start");
setTimeout(() => {
  console.log("This runs after 2 seconds asynchronously");
}, 2000);
console.log("Asynchronous end");

// Placeholder for REST API example to be added in next meeting
function fetchData() {
  console.log("Fetch data from REST API - to be implemented");
}
