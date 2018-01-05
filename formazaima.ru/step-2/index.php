<?php
define ('ROOT',$_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/header_footer/header.php');
?>
<div class="registration">
	<div class="wrap">
		<div class="registration__info">
			<div class="registration__info-media">
				<span>Вероятность получения займа уже 43%</span>
				<div class="registration__info-line"><span style="width: 42%;"></span></div>
			</div>
		</div>
		
		<div class="registration__step-wrap">
			<div class="registration__step">
				<a href="/" class="registration__step-item complete" data-count="1">Контакты</a>
				<div class="registration__step-item active" data-count="2">Паспорт</div>		
				<div class="registration__step-item " data-count="3">Адрес</div>
				<div class="registration__step-item " data-count="4">Работа</div>	
			</div>
		</div>

		<div class="registration__container">
			<input type="hidden" value="cmp_3" id="component-id"/>
			<form method="POST" data-step="3" class="d-disabled" id="step-form">
				<div class="registration__bigname registration__topline">Паспортные данные</div>
				<div class="registration__box">
					<div class="registration__list   ">
						<div class="registration__item">
							<div class="registration__name">Серия паспорта*</div>
							<div class="registration__element">
								<input class="input seriesMask req " name="passport_series" maxlength="4" type="text" 
								value="<?=$_SESSION['save_data']['passport_series'] ?>" placeholder="0000" aria-required="true">
								<div class="formvalid"></div>			
							</div>
							<div class="error__container_passport_code"></div>
						</div>
					</div>
					
					<div class="registration__list   ">
						<div class="registration__item">
							<div class="registration__name">Номер паспорта*</div>
							<div class="registration__element">
								<input class="input seriesMaskPas req " name="passport_number" maxlength="6" type="text" 
								value="<?=$_SESSION['save_data']['passport_number'] ?>" placeholder="000 111" aria-required="true">
								<div class="formvalid"></div>			
							</div>
							<div class="error__container_passport_code"></div>
						</div>
					</div>

					<div class="registration__list   ">
						<div class="registration__item">
							<div class="registration__name">Дата выдачи паспорта</div>
							<div class="registration__element"><!--dateMask-->
								<input id="datepicker" class="input " name="passport_issued_date"  maxlength="10" type="text" 
								value="<?=$_SESSION['save_data']['passport_issued_date'] ?>" placeholder="11.12.2004">
								<div class="formvalid"></div>		
							</div>
							<div class="error__container_passport_date"></div>
						</div>
					</div>

					<div class="registration__list   ">
						<div class="registration__item">
							<div class="registration__name">Код подразделения</div>
							<div class="registration__element">
								<input class="input departmentMask" name="passport_unit_code" type="text"
								value="<?=$_SESSION['save_data']['passport_unit_code'] ?>" placeholder="231-432">
								<div class="formvalid"></div>
							</div>
							<div class="error__container_department_code"></div>
						</div>
					</div>

					<div class="registration__list  registration__list_full ">
						<div class="registration__item">
							<div class="registration__name">Кем выдан паспорт</div>
							<div class="registration__element">
								<input rows="4" class="f-field" name="passport_issued_by" type="text"
								value="<?=$_SESSION['save_data']['passport_issued_by'] ?>" placeholder="Пролетраская РОВД, г. Москвы">
								<div class="formvalid"></div>
							</div>
							<div class="error__container_department"></div>
						</div>
					</div>
				</div>
			
			
						
				<div class="registration__box">
					<div class="registration__list   ">
						<div class="registration__item">
							<div class="registration__name">Место рождения</div>
								<div class="registration__element">
									<input class="input" name="birth_place" type="text" 
									value="<?=$_SESSION['save_data']['birth_place'] ?>" placeholder="Москва" >
									<div class="formvalid"></div>		
									</div>
							<div class="error__container_birthplace">
												</div>
						</div>
					</div>
				</div>
			
				<div class="registration__box"></div>
		
				<div class="reg__error"></div>

				<div class="registration__footer" style="border-top: 1px solid #dcece2;">
					<div class="clearfix">
						<button class="btn registration__button">Далее</button>
						<div class="registration__alert">
							<span>*- обязательные поля</span>
							Корректное заполение анкеты необходимо для получения займа.
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>				
<?php require_once(ROOT . '/header_footer/footer.php');?>
