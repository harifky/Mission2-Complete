<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Latihan Scope, Array, Object</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 50%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
    <div id="mahasiswa-list"></div>

    <h1>Daftar Mata Kuliah</h1>
    <div id="course-list"></div>

    <!-- Panggil file JS -->
    <script src="{{ asset('js/siakad.js') }}"></script>
</body>
</html>