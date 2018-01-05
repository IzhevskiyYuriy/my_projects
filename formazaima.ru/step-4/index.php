<?php
define ('ROOT',$_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/header_footer/header.php');
?>
	<div class="registration">
        <div class="wrap">
            <div class="registration__info">

                <div class="registration__info-media">
                    <span>Вероятность получения займа уже 86%</span>
                    <div class="registration__info-line"><span style="width: 84%;"></span></div>
                </div>
            </div>

            <div class="registration__step-wrap">
                <div class="registration__step">
                    <a href="/" class="registration__step-item complete" data-count="1">Контакты</a>
                    <a href="/step-2/" class="registration__step-item complete" data-count="2">Паспорт</a>
                    <a href="/step-3/" class="registration__step-item complete" data-count="3">Адрес</a>
                    <div class="registration__step-item active" data-count="4">Работа</div>
                </div>
            </div>

            <div class="registration__container">
                <input type="hidden" value="cmp_3" id="component-id" />
                <form method="POST" data-step="5" class="d-disabled" id="step-form">



                    <div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
                                <div class="registration__name">Занятость</div>
                                <div class="registration__element">selected="selected"
                                        <select class="select f-field " name="occupation" data-placeholder="Выберите">
                                                <option value="" ></option>
                                                <option value="Работаю по трудовой книжке"
                                                        <?=($_SESSION['save_data']['occupation'] == "Работаю по трудовой книжке") ? 'selected="selected"' : ''; ?>
                                                >Работаю по трудовой книжке</option><!--worker-->

                                                <option value="Работаю по контракту без трудовой книжки"
                                                        <?=($_SESSION['save_data']['occupation'] == "Работаю по контракту без трудовой книжки") ? 'selected="selected"' : ''; ?>
                                                >Работаю по контракту без трудовой книжки</option><!--contract worker-->

                                                <option value="Частный предприниматель" 
                                                        <?=($_SESSION['save_data']['occupation'] == "Частный предприниматель") ? 'selected="selected"' : ''; ?>
                                                >Частный предприниматель</option><!--entrepreneur-->
                                                <option value="Пенсионер"
                                                        <?=($_SESSION['save_data']['occupation'] == "Пенсионер") ? 'selected="selected"' : ''; ?>
                                                >Пенсионер</option><!--pensioner-->

                                                <option value="Студент"
                                                        <?=($_SESSION['save_data']['occupation'] == "Студент") ? 'selected="selected"' : ''; ?>
                                                >Студент</option><!--student-->

                                                <option value="Безработный" 
                                                        <?=($_SESSION['save_data']['occupation'] == "Безработный") ? 'selected="selected"' : ''; ?>
                                                >Безработный</option><!--unemployed-->
                                        </select>
                                    <div class="formvalid"></div>

                                </div>
                                <div class="error__container_occupation">
                                </div>
                            </div>
                        </div>

                        <div class="registration__list   ">
                            <div class="registration__item">
                                <div class="registration__name">Название организации</div>
                                <div class="registration__element">
                                        <input class="input W" name="work_organization" type="text" value="<?=$_SESSION['save_data']['work_organization'] ?>" placeholder="Рога и Копыта">
                                    <div class="formvalid"></div>
								</div>
                                <div class="error__container_work_organization">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Адрес места работы</div>
								<div class="registration__element">
								<input class="input W" name="work_address" type="text" value="<?=$_SESSION['save_data']['work_address'] ?>" placeholder="г. Москва, ул. Саратовская, 38">
                                    <div class="formvalid"></div>
								</div>
                                <div class="error__container_work_address">
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Ваша должность</div>
									<div class="registration__element">
										<input class="input W" name="work_occupation" type="text" value="<?=$_SESSION['save_data']['work_occupation'] ?>" placeholder="Инженер">
										<div class="formvalid"></div>
									</div>
                                <div class="error__container_work_occupation">
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Стаж работы</div>
									<div class="registration__element">
										<input class="input W" name="work_experience" type="text" value="<?=$_SESSION['save_data']['work_experience'] ?>" placeholder="5 лет">
										<div class="formvalid"></div>
									</div>
                                <div class="error__container_work_occupation">
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Сумма постоянного дохода</div>
									<div class="registration__element">
										<input class="input W" name="income" type="text" value="<?=$_SESSION['save_data']['income'] ?>" placeholder="30000 руб.">
										<div class="formvalid"></div>
									</div>
                                <div class="error__container_work_occupation">
                                </div>
                            </div>
                        </div>
					</div>
					
										
                    <div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Иной источник доходов(рубли)</div>
									<div class="registration__element">
										<input class="input W" name="income_other" type="text" value="<?=$_SESSION['save_data']['income_other'] ?>" placeholder="15000 руб.">
										<div class="formvalid"></div>
									</div>
                                <div class="error__container_work_occupation">
                                </div>
                            </div>
                        </div>
					</div>



                    <div class="registration__box">
                        <br />
						<div class="registration__list   ">
                            <div class="registration__item">
							<div class="registration__name">Рабочий телефон</div>
								<div class="registration__element">
									<input class="input phoneMask W ignore" name="work_phone" type="text" value="<?=$_SESSION['save_data']['work_phone'] ?>" placeholder="+7 (499) 900 00 00">
                                    <div class="formvalid"></div>
								</div>
                                <div class="error__container_work_phone">
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">ФИО начальника</div>
									<div class="registration__element">
										<input class="input W" name="work_chief" type="text" value="<?=$_SESSION['save_data']['work_chief'] ?>" placeholder="Иванов Сергей Иванович">
										<div class="formvalid"></div>
									</div>
                                <div class="error__container_work_occupation">
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="registration__box">
						<div class="registration__list   ">
					<div class="registration__item">
						<div class="registration__name">Кредитная история</div>
						<div class="registration__element">
						
							<input class="sex " type="radio" value="Нет, кредиты не брал" 
								<?=($_SESSION['save_data']['credhistory_radio'] == "Нет, кредиты не брал") ? 'checked="checked"' : ''; ?>
								name="credhistory_radio" id="sex1">
								<label class="sex-label" for="sex1">Нет, кредиты не брал</label><br><!--not_loans-->
							
							
							<input class="sex " type="radio" value="Да, есть погашенные кредиты" 
								<?=($_SESSION['save_data']['credhistory_radio'] == "Да, есть погашенные кредиты") ? 'checked="checked"' : ''; ?>
								name="credhistory_radio" id="sex2">
								<label class="sex-label" for="sex2">Да, есть погашенные кредиты</label><br><!--there_are_repaid_loans-->
								
							<input class="sex " type="radio" value="Да, есть непогашенные кредиты"
								<?=($_SESSION['save_data']['credhistory_radio'] == "Да, есть непогашенные кредиты") ? 'checked="checked"' : ''; ?>
								name="credhistory_radio" id="sex3">
								<label class="sex-label" for="sex3">Да, есть непогашенные кредиты</label><!--there_outstanding_loans-->
								
						</div>
						<div class="error__container_gender"></div>
					</div>
				</div>
				</div>
					
					 <div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Семейное положение</div>
								<div class="registration__element">
									<select class="select" name="marital_status" data-placeholder="Выберите">
										<option value=""
											></option>
										<option value="Не женат(не замужем)"
											<?=($_SESSION['save_data']['marital_status'] == "Не женат(не замужем)") ? 'selected="selected"' : ''; ?>
											>Не женат(не замужем)</option><!--not_in_marriage-->
										<option value="В браке" 
											<?=($_SESSION['save_data']['marital_status'] == "В браке") ? 'selected="selected"' : ''; ?>
											>В браке</option><!--in_marriage-->
										<option value="В разводе"
											<?=($_SESSION['save_data']['marital_status'] == "В разводе") ? 'selected="selected"' : ''; ?>
											>В разводе</option><!--divorced-->
										<option value="Гражданский брак" 
											<?=($_SESSION['save_data']['marital_status'] == "Гражданский брак") ? 'selected="selected"' : ''; ?>
											>Гражданский брак</option><!--common_law_marriage-->
										<option value="Повторный брак"
											<?=($_SESSION['save_data']['marital_status'] == "Повторный брак") ? 'selected="selected"' : ''; ?>
											>Повторный брак</option><!--remarriage-->
										<option value="Вдовец(вдова)" 
											<?=($_SESSION['save_data']['marital_status'] == "Вдовец(вдова)") ? 'selected="selected"' : ''; ?>
											>Вдовец(вдова)</option><!--widower-->
									</select>
                                    <div class="formvalid"></div>

                                </div>
                                <div class="error__container_occupation">
                                </div>
                            </div>
                        </div>
					</div>
					
					
					<div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Количество детей</div>
									<div class="registration__element">
										<input class="input W" name="childrens" type="text" value="<?=$_SESSION['save_data']['childrens'] ?>" placeholder="2">
										<div class="formvalid"></div>
									</div>
                                <div class="error__container_work_occupation">
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Доверенное лицо(ФИО)</div>
									<div class="registration__element">
										<input class="input W" name="confidant_name" type="text" value="<?=$_SESSION['save_data']['confidant_name'] ?>" placeholder="Яровой Анатолий Геннадьевич">
										<div class="formvalid"></div>
									</div>
                                <div class="error__container_work_occupation">
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Кем приходится доверенное лицо</div>
									<div class="registration__element">
										<input class="input W" name="confidant_type" type="text" value="<?=$_SESSION['save_data']['confidant_type'] ?>" placeholder="Брат">
										<div class="formvalid"></div>
									</div>
                                <div class="error__container_work_occupation">
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="registration__box">
						<div class="registration__list   ">
							<div class="registration__item">
								<div class="registration__name">Контактный телефон доверенного лица</div>
									<div class="registration__element">
										<input class="input phoneMask ignore" name="confidant_phone" type="text" value="<?=$_SESSION['save_data']['confidant_phone'] ?>" placeholder="+7 (900) 900 00 00">
										<div class="formvalid"></div>	
									</div>
									<div class="error__container_mphone"></div>
							</div>
						</div>
					</div>


                    <div style="text-align:center; display:none;" id="preloader">
                        <p><i>Принимаем решение о выдаче займа</i></p>
                        <img src="/img/preloader.gif">
                    </div>


                    <div class="reg__error"></div>

                    <div class="registration__footer" style="border-top: 1px solid #dcece2;">
                        <div class="clearfix">
                            <button class="btn registration__button">Оформить</button>
                            <div class="registration__alert">
                                <span>*- обязательные поля</span> Корректное заполение анкеты необходимо для получения займа.
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require_once(ROOT . '/header_footer/footer.php');?>
