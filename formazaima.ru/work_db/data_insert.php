<?php
session_start();

define ('ROOT', dirname(dirname(__FILE__)));

require_once (ROOT . '/save_data.php');
require_once (ROOT . '/work_db/db_connect/connect.php');
require_once (ROOT . '/work_db/create_table.php');

$decodeJsonData = json_decode(collectionDataFromForm($jsonData), true);

if ($_POST['data']['step'] == '5') {
    $url = 'https://api3.leadgid.ru/api/universal/applications?affiliate_id=25113&api_key=l5naDE1uwan5';

    $ch = curl_init($url);

    $jsonDataEncoded = json_encode($decodeJsonData['save_data']);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

    $response = curl_exec($ch);

}

try {
if (empty($_SESSION['last_insert_id'])) {

	$query = "INSERT INTO applicants_data(
                                                amount,
                                                term,
                                                last_name, 
                                                first_name, 
                                                middle_name,
                                                birthdate,
                                                gender,
                                                phone,
                                                email

                                                )
                                        VALUES (
                                                :amount,
                                                :term,
                                                :last_name,
                                                :first_name, 
                                                :middle_name,
                                                :birthdate,
                                                :gender,
                                                :phone, 
                                                :email
                                                )";
	$amount = $decodeJsonData['save_data']['amount'];
	$term = $decodeJsonData['save_data']['term'];
	$lastName = $decodeJsonData['save_data']['last_name'];
	$firstName = $decodeJsonData['save_data']['first_name'];
	$middleName = $decodeJsonData['save_data']['middle_name'];
	$gender = $decodeJsonData['save_data']['gender'];
	$birthDate = $decodeJsonData['save_data']['birthdate'];
	$phone = $decodeJsonData['save_data']['phone'];
	$email = $decodeJsonData['save_data']['email'];

	
	$data = $pdo->prepare($query);	

	$data->execute(['amount' => $amount,
                        'term' => $term,
                        'last_name' => $lastName ,
                        'first_name' =>  $firstName,
                        'middle_name' => $middleName,
                        'birthdate' => $birthDate,
                        'gender' => $gender,
                        'phone' =>  $phone,
                        'email' => $email
                        ]);
			

	$_SESSION['last_insert_id'] = $pdo->lastInsertId();
	$lastInsertId = $_SESSION['last_insert_id'];

 }else{ 
	$queryUpdate = "UPDATE applicants_data
                                            SET 
                                                passport_series = :passport_series,
                                                passport_number = :passport_number,
                                                passport_issued_date = :passport_issued_date,
                                                passport_unit_code = :passport_unit_code,
                                                passport_issued_by = :passport_issued_by,
                                                birth_place = :birth_place,
                                                region = :region,
                                                city = :city,
                                                zip_code = :zip_code,
                                                residential_address_street_id = :residential_address_street_id,
                                                residential_address_house = :residential_address_house,
                                                fact_residential_address_flat = :fact_residential_address_flat,
                                                r_equal_f = :r_equal_f,
                                                reg_region_name = :reg_region_name,
                                                reg_city_name = :reg_city_name,
                                                reg_zip_code = :reg_zip_code,
                                                reg_street = :reg_street,
                                                reg_house = :reg_house,
                                                reg_residential_address_flat = :reg_residential_address_flat,
                                                occupation = :occupation,
                                                work_organization = :work_organization,
                                                work_address = :work_address,
                                                work_occupation = :work_occupation,
                                                work_experience = :work_experience,
                                                income = :income,
                                                income_other = :income_other,
                                                work_phone = :work_phone,
                                                work_chief = :work_chief,
                                                credhistory_radio = :credhistory_radio,
                                                marital_status = :marital_status,
                                                childrens = :childrens,
                                                confidant_name = :confidant_name,
                                                confidant_type =:confidant_type,
                                                confidant_phone = :confidant_phone 
                                            WHERE id = :id";

	$passportSeries = $decodeJsonData['save_data']['passport_series'];
	$passportNumber = $decodeJsonData['save_data']['passport_number'];
	$passportIssuedDate = $decodeJsonData['save_data']['passport_issued_date'];
	$passportUnitCode = $decodeJsonData['save_data']['passport_unit_code'];
	$passportIssuedBy = $decodeJsonData['save_data']['passport_issued_by'];
	$birthPlace = $decodeJsonData['save_data']['birth_place'];
	$factRegionName = $decodeJsonData['save_data']['region'];
	$factCityName = $decodeJsonData['save_data']['city'];
	$zipCode = (int) $decodeJsonData['save_data']['zip_code'];
	$residentialAddressStreetId = $decodeJsonData['save_data']['residential_address_street_id'];
	$residentialAddressHouse = $decodeJsonData['save_data']['residential_address_house'];
	$factResidential_address_flat = $decodeJsonData['save_data']['fact_residential_address_flat'];
	$rEqualF = $decodeJsonData['save_data']['r_equal_f'];
	$regRegionName = $decodeJsonData['save_data']['reg_region_name'];
	$regCityName = $decodeJsonData['save_data']['reg_city_name'];
	$regZipCode = (int) $decodeJsonData['save_data']['reg_zip_code'];
	$regStreet = $decodeJsonData['save_data']['reg_street'];
	$regHouse = $decodeJsonData['save_data']['reg_house'];
	$regResidentialAddressFlat = $decodeJsonData['save_data']['reg_residential_address_flat'];
	$occupation = $decodeJsonData['save_data']['occupation'];
	$workOrganization = $decodeJsonData['save_data']['work_organization'];
	$workAddress = $decodeJsonData['save_data']['work_address'];
	$workOccupation = $decodeJsonData['save_data']['work_occupation'];
	$workExperience = $decodeJsonData['save_data']['work_experience'];
	$income = $decodeJsonData['save_data']['income'];
	$incomeOther = $decodeJsonData['save_data']['income_other'];
	$workPhone = $decodeJsonData['save_data']['work_phone'];
	$workChief = $decodeJsonData['save_data']['work_chief'];
	$credhistoryRadio = $decodeJsonData['save_data']['credhistory_radio'];
	$maritalStatus = $decodeJsonData['save_data']['marital_status'];
	$childrens = (int) $decodeJsonData['save_data']['childrens'];
	$confidantName = $decodeJsonData['save_data']['confidant_name'];
	$confidantType = $decodeJsonData['save_data']['confidant_type'];
	$confidantPhone = $decodeJsonData['save_data']['confidant_phone'];

	$update = $pdo->prepare($queryUpdate);
	
	$update->execute(['passport_series' => $passportSeries,
                        'passport_number' => $passportNumber,
                        'passport_issued_date' => $passportIssuedDate,
                        'passport_unit_code' => $passportUnitCode,
                        'passport_issued_by' => $passportIssuedBy,
                        'birth_place' => $birthPlace,
                        'region' => $factRegionName,
                        'city' => $factCityName,
                        'zip_code' => $zipCode,
                        'residential_address_street_id' => $residentialAddressStreetId,
                        'residential_address_house' => $residentialAddressHouse,
                        'fact_residential_address_flat' => $factResidential_address_flat,
                        'r_equal_f' => $rEqualF,
                        'reg_region_name' => $regRegionName,
                        'reg_city_name' => $regCityName,
                        'reg_zip_code' => $regZipCode,
                        'reg_street' => $regStreet,
                        'reg_house' => $regHouse,
                        'reg_residential_address_flat' => $regResidentialAddressFlat,
                        'occupation' => $occupation,
                        'work_organization' => $workOrganization,
                        'work_address' => $workAddress,
                        'work_occupation' => $workOccupation,
                        'work_experience' => $workExperience,
                        'income' => $income,
                        'income_other' => $incomeOther,
                        'work_phone' => $workPhone,
                        'work_chief' => $workChief,
                        'credhistory_radio' => $credhistoryRadio,
                        'marital_status' => $maritalStatus,
                        'childrens' => $childrens,
                        'confidant_name' => $confidantName,
                        'confidant_type' => $confidantType,
                        'confidant_phone' => $confidantPhone,
                        'id' => $_SESSION['last_insert_id'],
                        ]);
}
			
} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
} 
 
?>

