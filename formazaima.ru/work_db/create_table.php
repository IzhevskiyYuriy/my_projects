<?php
define ('ROOT',$_SERVER['DOCUMENT_ROOT']);
require_once (ROOT.'/work_db/db_connect/connect.php');

try {
	$createTableIfNotExists = "CREATE TABLE IF NOT EXISTS `applicants_data` (
		`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT '№',
		`amount` decimal(10,2) DEFAULT NULL COMMENT 'Сумма кредита в рублях',
		`term` int(11) DEFAULT NULL COMMENT 'Срок кредита в днях',
		`last_name` varchar(255) DEFAULT NULL COMMENT 'Фамилия клиента-заявителя  ',
		`first_name` varchar(255) DEFAULT NULL COMMENT 'Имя клиента-заявителя',
		`middle_name` varchar(255) DEFAULT NULL COMMENT 'Отчество клиента-заявителя ',
		`birthdate` date DEFAULT NULL COMMENT 'Дата рождения',
		`gender` varchar(255) DEFAULT NULL COMMENT 'Пол',
		`phone` varchar(255) DEFAULT NULL COMMENT 'Номер мобильного телефона клиента',
		`email` varchar(255) DEFAULT NULL COMMENT 'e-mail клиента',
		`passport_series` int(11) DEFAULT NULL COMMENT 'Серия паспорта',
		`passport_number` int(11) DEFAULT NULL COMMENT 'Номер паспорта',
		`passport_issued_date` date DEFAULT NULL COMMENT 'Дата выдачи паспорта',
		`passport_unit_code` varchar(255) DEFAULT NULL COMMENT 'Код подразделения',
		`passport_issued_by` varchar(255) DEFAULT NULL COMMENT 'Кем выдан паспорт',
		`birth_place` varchar(255) DEFAULT NULL COMMENT 'Место рождение',
		`region` varchar(255) DEFAULT NULL COMMENT 'Регион заявителя(место жительства)',
		`city` varchar(255) DEFAULT NULL COMMENT 'Город заявителя(место жительства)',
		`zip_code` int(11) DEFAULT NULL COMMENT 'Почтовый индекс(место жительства)',
		`residential_address_street_id` varchar(255) DEFAULT NULL COMMENT 'Улица заявителя(место жительства)',
		`residential_address_house` varchar(255) DEFAULT NULL COMMENT 'Номер дома проживания (место жительства)',
		`fact_residential_address_flat` varchar(255) DEFAULT NULL COMMENT 'Номер квартиры проживания (место жительства)',
		`r_equal_f` varchar(255) DEFAULT NULL COMMENT 'Место регистрации совпадает с фактическим(место жительства)',
		`reg_region_name` varchar(255) DEFAULT NULL COMMENT 'Регион заявителя(место регистрации)',
		`reg_city_name` varchar(255) DEFAULT NULL COMMENT 'Город заявителя(место регистрации)',
		`reg_zip_code` int(11) DEFAULT NULL COMMENT 'Почтовый индекс(место регистрации)',
		`reg_street` varchar(255) DEFAULT NULL COMMENT 'Улица (место регистрации)',
		`reg_house` varchar(255) DEFAULT NULL COMMENT 'Номер дома (место регистрации)',
		`reg_residential_address_flat` varchar(255) DEFAULT NULL COMMENT 'Номер квартиры (место регистрации)',
		`occupation` varchar(255) DEFAULT NULL COMMENT 'Занятость',
		`work_organization` varchar(255) DEFAULT NULL COMMENT 'Название организации',
		`work_address` varchar(255) DEFAULT NULL COMMENT 'Адрес места работы',
		`work_occupation` varchar(255) DEFAULT NULL COMMENT 'Должность',
		`work_experience` varchar(255) DEFAULT NULL COMMENT 'Стаж работы',
		`income` varchar(255) DEFAULT NULL COMMENT 'Сумма постоянного дохода',
		`income_other` varchar(255) DEFAULT NULL COMMENT 'Иной источник доходов(рубли)',
		`work_phone` varchar(255) DEFAULT NULL COMMENT 'Рабочий телефон',
		`work_chief` varchar(255) DEFAULT NULL COMMENT 'ФИО начальника',
		`credhistory_radio` varchar(255) DEFAULT NULL COMMENT 'Кредитная история',
		`marital_status` varchar(255) DEFAULT NULL COMMENT 'Семейное положение',
		`childrens` int(11) DEFAULT NULL COMMENT 'Количество детей',
		`confidant_name` varchar(255) DEFAULT NULL COMMENT 'Доверенное лицо(ФИО)',
		`confidant_type` varchar(255) DEFAULT NULL COMMENT 'Кем приходится доверенное лицо',
		`confidant_phone` varchar(255) DEFAULT NULL COMMENT 'Контактный телефон доверенного лица'
	) ENGINE=InnoDB AUTO_INCREMENT=342 DEFAULT CHARSET=utf8;";

	$sql = trim($createTableIfNotExists);
	$pdo->exec($sql);

	} catch(PDOException $e) {
		echo $e->getMessage();
	}

?>
