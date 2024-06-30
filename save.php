<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $name = htmlspecialchars($_POST['name']);
    $login = htmlspecialchars($_POST['login']);
    $password = htmlspecialchars($_POST['password']);
    $date = date('Y-m-d H:i:s');

    if (isset($_POST['action']) && $_POST['action'] == 'saveTxt') 
    {

        $data = "$date; Name: $name; Login: $login; Password: $password\n";
  
        file_put_contents('data.txt', $data, FILE_APPEND);
        echo "Дані успішно збережені в текстовий файл!";
    } 
    elseif (isset($_POST['action']) && $_POST['action'] == 'saveXml') 
    {
        
        $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
        $xml_record = $xml_data->addChild('record');
        $xml_record->addChild('date', $date);
        $xml_record->addChild('name', $name);
        $xml_record->addChild('login', $login);
        $xml_record->addChild('password', $password);
        
        $xml_file = 'data.xml';

        if (file_exists($xml_file)) 
        {
            $existing_xml = simplexml_load_file($xml_file);
            $record = $existing_xml->addChild('record');
            $record->addChild('date', $date);
            $record->addChild('name', $name);
            $record->addChild('login', $login);
            $record->addChild('password', $password);
            $existing_xml->asXML($xml_file);
        } 
        else 
        {
            $xml_data->asXML($xml_file);
        }

        echo "Дані успішно збережені в XML файл!";
    }
}
?>
