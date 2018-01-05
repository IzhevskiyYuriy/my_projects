<?php
if (!defined('ROOT')) define('ROOT', $_SERVER['DOCUMENT_ROOT']);

require_once(ROOT . '/header_footer/header.php');

$savedData = empty($_SESSION['save_data']) ? [] : $_SESSION['save_data'];

?>
<style>
    .first-step .ui-slider-tip {
        top: -36px;
    }
</style>
<div class="registration">
	<div class="wrap">
            <div class="registration__title">Оформление займа</div>
		
		<div class="registration__step-wrap">
			<div class="registration__step">
				<div class="registration__step-item active" data-count="1">Контакты</div>	
				<div class="registration__step-item " data-count="2">Паспорт</div>		
				<div class="registration__step-item " data-count="3">Адрес</div>	
				<div class="registration__step-item " data-count="4">Работа</div>		
			</div>
		</div>

		<div class="registration__container">
			<input type="hidden" value="cmp_3" id="component-id">
			<form method="post" data-step="2" class="d-disabled first-step" id="step-form" novalidate="novalidate">
			<input type="hidden" value="<?= $_GET['uclick'] ?>" name="subid1">
				<div class="registration__bigname registration__topline"> </div>
					
			<div class="registration__box">
			<div class="registration__name" style="margin-bottom: 10%">Сумма кредита в рублях*</div>
			<div class="branding__form-item sum-zaym" style="margin-bottom: 10%">
				<div class="branding__form-slider branding__form-slider_size">
					<div class="branding__form-slider-start">2 000 руб.</div>
					<div class="branding__form-slider-finish">30 000 руб.</div>
					<div class="sizeLoan ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all ui-slider-float">
					</div>
				</div>
			</div>
			<div class="registration__name"  style="margin-bottom: 10%" >Срок кредита в днях*</div>
			<div class="branding__form-item sum-zaym" style="margin-bottom: 10%">
				<div class="branding__form-slider branding__form-slider_size" >
					<div class="branding__form-slider-start" >1 день.</div>
					<div class="branding__form-slider-finish">365 день.</div>
					<div class="sizeDay ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all ui-slider-float_day">
					</div>
				</div>
			</div>
			
				
			
			
				<div class="registration__element" style="display:none" >
						<input  id="formazaima_amount"  class="input" value="<?= empty($savedData['amount']) ? '8000': $savedData['amount'] ?>" name="amount" type="text">
							<div class="formvalid"></div>	
				</div>
				<div class="registration__element" style="display:none" >
						<input  id="formazaima_term"  class="input" value="<?= empty($savedData['term']) ? '30': $savedData['term'] ?>" name="term" type="text">
							<div class="formvalid"></div>	
				</div>
						
			
			
				<br><br><br><br><br>
				<div class="registration__list   ">
					<div class="registration__item">
						<div class="registration__name">Фамилия*</div>
						<div class="registration__element">
							<input class="input russianLetter req " name="last_name" type="text" value="<?=$_SESSION['save_data']['last_name'] ?>"  placeholder="Сергеев" aria-required="true">
							<div class="formvalid"></div>		
							</div>
						<div class="error__container_lastname"></div>
					</div>
				</div>

				<div class="registration__list   ">
					<div class="registration__item">
						<div class="registration__name">Имя*</div>
						<div class="registration__element">
							<input class="input russianLetter req " name="first_name" type="text" value="<?=$_SESSION['save_data']['first_name'] ?>" placeholder="Сергей" aria-required="true">
							<div class="formvalid"></div>			
						</div>
						<div class="error__container_firstname"></div>
					</div>
				</div>
			</div>
			
			
						
			<div class="registration__box">
				<div class="registration__list   ">
					<div class="registration__item">
						<div class="registration__name">Отчество*</div>
						<div class="registration__element">
							<input class="input russianLetter req " name="middle_name" type="text" value="<?=$_SESSION['save_data']['middle_name'] ?>" placeholder="Сергеевич" aria-required="true">
							<div class="formvalid"></div>			
						</div>
						<div class="error__container_middlename"></div>
					</div>
				</div>

				<div class="registration__list   ">
					<div class="registration__item">
						<div class="registration__name">Дата рождения*</div>
							<div class="registration__element">
								<input id="datepicker" class="input dateMask req " name="birthdate" type="text" value="<?=$_SESSION['save_data']['birthdate'] ?>" placeholder="31.12.1988" aria-required="true">
								
								<div class="formvalid"></div>		
							</div>
						<div class="error__container_birthdate"></div>
					</div>
				</div>

				<div class="registration__list   ">
					<div class="registration__item">
						<div class="registration__name">ПОЛ*</div>
						<div class="registration__element">
							<input class="sex " type="radio" value="male"  <?= ($_SESSION['save_data']['gender'] == "male") ? 'checked="checked"' : ''; ?> name="gender" id="sex1"><label class="sex-label" for="sex1">Мужской</label>
							<input class="sex " type="radio" value="female" <?= ($_SESSION['save_data']['gender'] == "female") ? 'checked="checked"' : ''; ?> name="gender" id="sex2"><label class="sex-label" for="sex2">Женский</label>
						</div>
						<div class="error__container_gender"></div>
					</div>
				</div>
			</div>
			
			
					<div class="registration__bigname registration__topline">Мои контакты</div>
						
		<div class="registration__box">
			<div class="registration__list   ">
			
				<div class="registration__item">
					<div class="registration__name">Мобильный телефон*</div>
						<div class="registration__element">
							<input class="input phoneMask  " name="phone" type="text" value="<?=$_SESSION['save_data']['phone'] ?>" placeholder="+7 (900) 900 00 00">
							<div class="formvalid"></div>	
						</div>
						<div class="error__container_mphone"></div>
					</div>
				</div>

				<div class="registration__list   ">
					<div class="registration__item">
						<div class="registration__name">E-mail*</div>
						<div class="registration__element">
							<input class="input emailMask req " name="email" type="text" value="<?=$_SESSION['save_data']['email'] ?>" placeholder="example@gmail.com" aria-required="true">
							<div class="formvalid"></div>	
						</div>
						<div class="error__container_email"></div>
					</div>
				</div>
		</div>
			
			<div class="registration__bigname registration__topline"> </div>
			<div class="registration__box">
				<div class="registration__list  registration__list_full ">
					<div class="registration__item">
						<div class="registration__element">
							<input class="place" type="checkbox" name="agree_with_rules" id="agree_with_rules" checked="">
							<label class="place-label" for="agree_with_rules">Я согласен на обработку персональных данных и принимаю
								<a href="#" class="mLink" style="color: #24b059;">пользовательское соглашение</a>
							</label>
						</div>
						<div class="error__container_agree_with_rules"></div>
					</div>
				</div>
			</div>
			
			
						
			
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
