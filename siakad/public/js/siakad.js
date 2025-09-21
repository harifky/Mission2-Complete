// ==========================
// Array of Objects
// ==========================

// Global scope
const mahasiswa = [
  { id: 1, nama: "Rifky", nim: "123456", prodi: "Informatika" },
  { id: 2, nama: "Andi", nim: "123457", prodi: "Informatika" },
  { id: 3, nama: "Budi", nim: "123458", prodi: "Sistem Informasi" }
];

const courses = [
  { id: 1, kode: "IF101", nama: "Algoritma", sks: 3 },
  { id: 2, kode: "IF102", nama: "Struktur Data", sks: 4 },
  { id: 3, kode: "IF103", nama: "Basis Data", sks: 3 }
];

// ==========================
// Function Scope
// ==========================
function renderMahasiswa() {
  let html = "<table><tr><th>NIM</th><th>Nama</th><th>Prodi</th></tr>";
  for (let mhs of mahasiswa) {
    html += `<tr><td>${mhs.nim}</td><td>${mhs.nama}</td><td>${mhs.prodi}</td></tr>`;
  }
  html += "</table>";
  document.getElementById("mahasiswa-list").innerHTML = html;
}

function renderCourses() {
  let html = "<table><tr><th>Kode</th><th>Nama Mata Kuliah</th><th>SKS</th></tr>";
  for (let mk of courses) {
    html += `<tr><td>${mk.kode}</td><td>${mk.nama}</td><td>${mk.sks}</td></tr>`;
  }
  html += "</table>";
  document.getElementById("course-list").innerHTML = html;
}

// New function demonstrating querySelector and createElement
function addNewMahasiswaElement() {
  // Access container element using getElementById
  const container = document.getElementById("mahasiswa-list");
  if (!container) {
    console.warn("Container element with id 'mahasiswa-list' not found.");
    return;
  }
  // Create a new div element
  const newDiv = document.createElement("div");
  newDiv.textContent = "Ini adalah elemen baru yang ditambahkan menggunakan createElement.";
  newDiv.style.padding = "10px";
  newDiv.style.marginTop = "10px";
  newDiv.style.backgroundColor = "#e0e0e0";
  // Append the new element to the container
  container.appendChild(newDiv);
}

// ==========================
// Block Scope
// ==========================
if (courses.length > 0) {
  let firstCourse = courses[0]; // hanya hidup di block ini
  console.log("Mata kuliah pertama:", firstCourse.nama);
}

// ==========================
// Jalankan render
// ==========================
renderMahasiswa();
renderCourses();
addNewMahasiswaElement();

// ==========================
// Array of Objects
// ==========================

// Global scope
const mahasiswa = [
  { id: 1, nama: "Rifky", nim: "123456", prodi: "Informatika" },
  { id: 2, nama: "Andi", nim: "123457", prodi: "Informatika" },
  { id: 3, nama: "Budi", nim: "123458", prodi: "Sistem Informasi" }
];

const courses = [
  { id: 1, kode: "IF101", nama: "Algoritma", sks: 3 },
  { id: 2, kode: "IF102", nama: "Struktur Data", sks: 4 },
  { id: 3, kode: "IF103", nama: "Basis Data", sks: 3 }
];

// ==========================
// Function Scope
// ==========================
function renderMahasiswa() {
  let html = "<table><tr><th>NIM</th><th>Nama</th><th>Prodi</th></tr>";
  for (let mhs of mahasiswa) {
    html += `<tr><td>${mhs.nim}</td><td>${mhs.nama}</td><td>${mhs.prodi}</td></tr>`;
  }
  html += "</table>";
  document.getElementById("mahasiswa-list").innerHTML = html;
}

function renderCourses() {
  let html = "<table><tr><th>Kode</th><th>Nama Mata Kuliah</th><th>SKS</th></tr>";
  for (let mk of courses) {
    html += `<tr><td>${mk.kode}</td><td>${mk.nama}</td><td>${mk.sks}</td></tr>`;
  }
  html += "</table>";
  document.getElementById("course-list").innerHTML = html;
}

// New function demonstrating querySelector and createElement
function addNewMahasiswaElement() {
  // Access container element using getElementById
  const container = document.getElementById("mahasiswa-list");
  if (!container) {
    console.warn("Container element with id 'mahasiswa-list' not found.");
    return;
  }
  // Create a new div element
  const newDiv = document.createElement("div");
  newDiv.textContent = "Ini adalah elemen baru yang ditambahkan menggunakan createElement.";
  newDiv.style.padding = "10px";
  newDiv.style.marginTop = "10px";
  newDiv.style.backgroundColor = "#e0e0e0";
  // Append the new element to the container
  container.appendChild(newDiv);
}

// ==========================
// Block Scope
// ==========================
if (courses.length > 0) {
  let firstCourse = courses[0]; // hanya hidup di block ini
  console.log("Mata kuliah pertama:", firstCourse.nama);
}

// ==========================
// Jalankan render
// ==========================
renderMahasiswa();
renderCourses();
addNewMahasiswaElement();
