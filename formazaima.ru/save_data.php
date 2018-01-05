<?php
session_start();

if (empty($_SESSION['loans_today'])) $_SESSION['loans_today'] = rand(30, 900);

if (rand(1, 2) === 2) $_SESSION['loans_today'] += rand(1, 15);

function collectionDataFromForm($jsonData)
	{
            $steps = [
                    1 => ['amount', 'term', 'last_name', 'first_name', 'middle_name', 'birthdate', 'phone', 'email'],
                    2 => ['passport_series', 'passport_number'],
                    3 => ['region', 'city' ],
                    4 => []
            ];

            if (!empty($_SESSION['save_data'])) {
                    $_SESSION['save_data'] = (array) $_POST['data']['form'] + $_SESSION['save_data'];

            } else {
                    $post = $_POST['data']['form'];
                    $_SESSION['save_data']  = (array) $post;
	    }

	$status = ['status'=> 200];

	$result = $_SESSION + $status;
	
	$validation = ['validation' => prevStepIsFilled($_POST['data']['step'] - 1, $steps)];

	$jsonData = json_encode($status + $result + $validation , JSON_UNESCAPED_UNICODE);
	echo $jsonData;
	return $jsonData;
}

function prevStepIsFilled($stepNumber, $steps)
	{
            $checkingStepFields = $steps[$stepNumber];
            $arrayFlip = array_flip((array)$checkingStepFields);
		
            if (!empty($_SESSION['save_data'])) {
                $result = array_intersect_key((array)$arrayFlip,$_SESSION['save_data']);
                if (empty($checkingStepFields) || !empty($result)) {
                    return true;
                }
            }
		return false;
	}
//session_destroy();
?>
