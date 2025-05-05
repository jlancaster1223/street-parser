<?php
include_once 'HomeownerParser.php';

if(isset($_POST)) {
    $data = json_decode($_POST['data'], true);
}

if(isset($data['action']) && $data['action'] == 'parseData') {

    if(isset($_FILES['files']) && !empty($_FILES['files'])) {
        $file = $_FILES['files'];

        if($file['type'][0] != 'text/csv') {
            echo json_encode(['error' => 'Invalid file type.  Only CSV files are allowed.']);
            die();
        }

        $fileName = $file['name'][0];
        $fileTmpName = $file['tmp_name'][0];
        $fileError = $file['error'][0];
        $fileSize = $file['size'][0];

        // Ensure that uploads/ directory exists
        if(!is_dir('uploads/')) {
            mkdir('uploads/', 0777, true);
        }

        if($fileError === 0) {
            if($fileSize > 0) {
                move_uploaded_file($fileTmpName, 'uploads/' . $fileName);
            } else {
                echo json_encode(['error' => 'File size is zero']);
                die();
            }
        } else {
            echo json_encode(['error' => 'Error uploading file']);
            die();
        }
    }
    
    $homeownerParser = new HomeownerParser();
    $homeownerParser->setFilePath('uploads/'.$fileName);
    echo '<pre>';
    print_r($homeownerParser->parse());
    echo '</pre>';
} else {
    echo json_encode(['error' => 'No homeowner data provided']);
}
