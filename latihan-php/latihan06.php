<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <tr>
            <td>nim</td>
            <td>nama</td>
            <td>umur</td>
        </tr>
        <?php
        $i = 1;
        while ($i <= 5) {
        ?>
            <tr>
                <td>241511060</td>
                <td>Rifky</td>
                <td>22</td>
            </tr>
        <?php
            $i = $i + 1;
        }
        ?>
    </table>
</body>

</html>