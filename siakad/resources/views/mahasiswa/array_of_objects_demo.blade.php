<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Array of Objects Demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        .mahasiswa { margin-bottom: 20px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        .courses { margin-left: 20px; }
        .course { margin-bottom: 5px; }
    </style>
</head>
<body>
    <h1>Array of Objects Demo - Mahasiswa & Courses</h1>
    <div id="content">Loading data...</div>

    <script>
        async function fetchData() {
            try {
                const response = await fetch("{{ route('mahasiswa.arrayOfObjectsDemo') }}");
                const data = await response.json();
                const contentDiv = document.getElementById('content');
                contentDiv.innerHTML = '';

                data.forEach(mahasiswa => {
                    const mahasiswaDiv = document.createElement('div');
                    mahasiswaDiv.className = 'mahasiswa';

                    const header = document.createElement('h2');
                    header.textContent = `NIM: ${mahasiswa.nim} (Tahun Masuk: ${mahasiswa.tahun_masuk})`;
                    mahasiswaDiv.appendChild(header);

                    if (mahasiswa.courses.length > 0) {
                        const coursesDiv = document.createElement('div');
                        coursesDiv.className = 'courses';

                        mahasiswa.courses.forEach(course => {
                            const courseDiv = document.createElement('div');
                            courseDiv.className = 'course';
                            courseDiv.textContent = `${course.kode_mk} - ${course.nama_mk} (${course.sks} SKS)`;
                            coursesDiv.appendChild(courseDiv);
                        });

                        mahasiswaDiv.appendChild(coursesDiv);
                    } else {
                        const noCourses = document.createElement('p');
                        noCourses.textContent = 'No courses enrolled.';
                        mahasiswaDiv.appendChild(noCourses);
                    }

                    contentDiv.appendChild(mahasiswaDiv);
                });
            } catch (error) {
                document.getElementById('content').textContent = 'Failed to load data.';
                console.error('Error fetching data:', error);
            }
        }

        fetchData();
    </script>
</body>
</html>
