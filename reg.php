<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="form-container">
        <h2>Результати</h2>
        <?php
        function read_txt_file($filename) {
            $records = [];
            if (file_exists($filename)) {
                $file = fopen($filename, 'r');
                while (($line = fgets($file)) !== false) {
                    $parts = explode(';', $line);
                    if (count($parts) === 4) {
                        $records[] = [
                            'date' => trim($parts[0]),
                            'name' => trim(explode(':', $parts[1])[1]),
                            'login' => trim(explode(':', $parts[2])[1]),
                            'password' => trim(explode(':', $parts[3])[1])
                        ];
                    }
                }
                fclose($file);
            }
            return $records;
        }

        function read_xml_file($filename) {
            $records = [];
            if (file_exists($filename)) {
                $xml = simplexml_load_file($filename);
                foreach ($xml->record as $record) {
                    $records[] = [
                        'date' => (string)$record->date,
                        'name' => (string)$record->name,
                        'login' => (string)$record->login,
                        'password' => (string)$record->password
                    ];
                }
            }
            return $records;
        }

        $txt_records = read_txt_file('data.txt');
        $xml_records = read_xml_file('data.xml');
        $all_records = array_merge($txt_records, $xml_records);

        usort($all_records, function($a, $b) {
            return strtotime($a['date']) - strtotime($b['date']);
        });

        if (!empty($all_records)) {
            echo '<table>';
            echo '<tr><th>Дата</th><th>Ім\'я</th><th>Логін</th><th>Пароль</th></tr>';
            foreach ($all_records as $record) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($record['date']) . '</td>';
                echo '<td>' . htmlspecialchars($record['name']) . '</td>';
                echo '<td>' . htmlspecialchars($record['login']) . '</td>';
                echo '<td>' . htmlspecialchars($record['password']) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>Записи відсутні.</p>';
        }
        ?>
    </div>
</body>
</html>