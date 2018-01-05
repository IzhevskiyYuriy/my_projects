<?php
define ('ROOT',$_SERVER['DOCUMENT_ROOT']);
require_once(ROOT . '/header_footer/header.php');
?>

<div class="registration">
        <div class="wrap">
            <div class="registration__info">

                <div class="registration__info-media">
                    <span>Вероятность получения займа уже 65%</span>
                    <div class="registration__info-line"><span style="width: 63%;"></span></div>
                </div>
            </div>

            <div class="registration__step-wrap">
                <div class="registration__step">
					<a href="/" class="registration__step-item complete" data-count="1">Контакты</a>
					<a href="/step-2/" class="registration__step-item complete" data-count="2">Паспорт</a>
					<div class="registration__step-item active" data-count="3">Адрес</div>
					<div class="registration__step-item " data-count="4">Работа</div>
				</div>
            </div>

            <div class="registration__container">
                <input type="hidden" value="cmp_3" id="component-id" />
                <form method="POST" data-step="4" class="d-disabled" id="step-form">


                    <div class="registration__bigname registration__topline">Фактическое место жительства</div>

                    <div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Регион*</div>
								<div class="registration__element">
                                    <?php $selectedRegionValue = !empty($_SESSION['save_data']) && !empty($_SESSION['save_data']['region']) ? (int) $_SESSION['save_data']['region'] : false; ?>

									<select id = "region_name" class="select-search f-field reg-place js-selectRegion req "  aria-required="true" name="region" data-placeholder="Выберите регион" data-id="1">
										<option value=""></option>
										<?php foreach ($decodeJsonDataRegions as $key){?>
										    <option data-code="<?=$key['code']?>" value="<?=$key['id']?>" <?= $selectedRegionValue === $key['id'] ? 'selected="selected"' : ''?>>
											<?=$key['name']?>							
										</option>	
										<?php }?>
										</select>
										
                                    <div class="formvalid"></div>

                                </div>
                                <div class="error__container_fact_region_name">
                                </div>
                            </div>
                        </div>

                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Город*</div>
								<div class="registration__element">
									<select class="select-search f-field js-selectCity req " aria-required="true" name="city" data-placeholder="Выберите город" data-id="1">
										<option value=""></option>
                                        <?php if ($selectedRegionValue):
                                            $cities = json_decode(getCitiesList($selectedRegionValue, CACHE_CITIES_DIR), true);

                                            $selectedCityId = !empty($_SESSION['save_data']) && !empty($_SESSION['save_data']['city']) ? (int) $_SESSION['save_data']['city'] : false;
                                            foreach ($cities['cities'] as $city):
                                        ?>
                                                <option data-code="<?= $city['code'] ?>" value="<?= $city['id'] ?>" <?= $selectedCityId === $city['id'] ? 'selected="selected"' : ''?> >
                                                    <?= $city['name'] ?>
                                                </option>
                                        <?php
                                            endforeach;
                                        endif; ?>
										
									</select>
									
                                    <div class="formvalid"></div>
								</div>
                                <div class="error__container_fact_city_name">
                                </div>
                            </div>
                        </div>
					</div>



                    <div class="registration__box">
						 <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Почтовый индекс</div>
								<div class="registration__element">
									<input class="input seriesMask ignore"  maxlength="7" name="zip_code" type="text" value="<?=$_SESSION['save_data']['zip_code'] ?>" placeholder="150000">
                                    <div class="formvalid"></div>
								</div>
                                <div class="error__container_fact_zip_code">
                                </div>
                            </div>
                        </div>
					
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Улица проживания</div>
								<div class="registration__element">
									<input class="input" name="residential_address_street_id" type="text" value="<?=$_SESSION['save_data']['residential_address_street_id'] ?>" placeholder="ул. Саратовская">
                                    <div class="formvalid"></div>
								</div>
                                <div class="error__container_fact_street">
                                </div>
                            </div>
                        </div>

                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Номер дома проживания</div>
								<div class="registration__element">
									<input class="input" name="residential_address_house" type="text" value="<?=$_SESSION['save_data']['residential_address_house'] ?>" placeholder="1">
                                    <div class="formvalid"></div>
								</div>
                                <div class="error__container_fact_house">
                                </div>
                            </div>
                        </div>
						
						<div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Номер квартиры проживания</div>
								<div class="registration__element">
									<input class="input" name="fact_residential_address_flat" type="text" value="<?=$_SESSION['save_data']['fact_residential_address_flat'] ?>" placeholder="1">
                                    <div class="formvalid"></div>
								</div>
                                <div class="error__container_fact_house">
                                </div>
                            </div>
                        </div>



                    </div>


                    <div class="registration__bigname registration__topline">Место регистрации</div>

                    <div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__element">
                                    <input type="hidden" name="r_equal_f" value="off"/>
									<input class="place" type="checkbox" name="r_equal_f" <?=($_SESSION['save_data']['r_equal_f'] == "on") ? 'checked="checked"' : ''; ?>  id="r-equal-f">
									<label class="place-label" value="coincidence_registration" for="r-equal-f">Место регистрации совпадает с фактическим</a></label>
									
									</div>
                                <div class="error__container_r-equal-f">
                                </div>
                            </div>
                        </div>
					</div>

                    <span id="fact-reg-fields-box">

                    <div class="registration__box">
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Регион*</div>
								<div class="registration__element">

                                <?php $selectedRegRegionId = !empty($_SESSION['save_data']) && !empty($_SESSION['save_data']['reg_region_name']) ? (int) $_SESSION['save_data']['reg_region_name'] : false; ?>
								<select id = "duplication_region_name" class="select-search f-field reg-place R js-selectRegion req " name="reg_region_name" data-placeholder="Выберите регион" data-id="2">
									<option value=""></option>
									<?php	foreach ($decodeJsonDataRegions as $key) { ?>
										<option data-code="<?=$key['code']?>" value="<?=$key['id']?>" <?= $selectedRegRegionId === $key['id'] ? 'selected="selected"' : ''?>>
											<?=$key['name']?>							
										</option>	
										<?php }?>
									</select>
                                    <div class="formvalid"></div>
								</div>
                                <div class="error__container_reg_region_name">
                                </div>
                            </div>
                        </div>

                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Город*</div>
								<div class="registration__element">
                                    <select class="select-search R f-field js-selectCity req " name="reg_city_name" data-placeholder="Выберите город" data-id="2">
										<option  value=""></option>

                                        <?php if ($selectedRegRegionId):
                                            $regCities = json_decode(getCitiesList($selectedRegRegionId, CACHE_CITIES_DIR), true);
                                            $selectedRegCityId = !empty($_SESSION['save_data']) && !empty($_SESSION['save_data']['reg_city_name']) ? (int) $_SESSION['save_data']['reg_city_name'] : false;
                                            foreach ($regCities['cities'] as $city):
                                        ?>
                                            <option data-code="<?= $city['code'] ?>" value="<?= $city['id'] ?>" <?= $selectedRegCityId === $city['id'] ? 'selected="selected"' : ''?> >
                                                <?= $city['name'] ?>
                                            </option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
										
									</select>
                                    <div class="formvalid"></div>
								</div>
                                <div class="error__container_reg_city_name">
                                </div>
                            </div>
                        </div>
					</div>



                     <div class="registration__box">
						 <div class="registration__list   ">
							<div class="registration__item">
							<div class="registration__name">Почтовый индекс</div>
								<div class="registration__element">
									<input class="input seriesMask ignore"  maxlength="7" name="reg_zip_code" type="text" value="<?=$_SESSION['save_data']['reg_zip_code'] ?>" placeholder="150000">
									<div class="formvalid"></div>
								</div>
									<div class="error__container_reg_house">
									</div>
							</div>
						</div>
					 
                        <div class="registration__list   ">
                            <div class="registration__item">
								<div class="registration__name">Улица</div>
								<div class="registration__element">
									<input class="input " name="reg_street" type="text" value="<?=$_SESSION['save_data']['reg_street'] ?>" placeholder="ул. Саратовская">
									<div class="formvalid"></div>
								</div>
                                <div class="error__container_reg_street">
                                </div>
                            </div>
                        </div>

                        <div class="registration__list   ">
                            <div class="registration__item">
							<div class="registration__name">Номер дома</div>
							<div class="registration__element">
								<input class="input" name="reg_house" type="text" value="<?=$_SESSION['save_data']['reg_house'] ?>" placeholder="1">
								<div class="formvalid"></div>
							</div>
                                <div class="error__container_reg_house">
                                </div>
                            </div>
                        </div>
						
						<div class="registration__list   ">
                            <div class="registration__item">
							<div class="registration__name">Номер квартиры</div>
							<div class="registration__element">
								<input class="input" name="reg_residential_address_flat" type="text" value="<?=$_SESSION['save_data']['reg_residential_address_flat'] ?>" placeholder="1">
								<div class="formvalid"></div>
							</div>
                                <div class="error__container_reg_house">
                                </div>
                            </div>
                        </div>
			        </div>
                </span>




                    <div class="reg__error"></div>

                    <div class="registration__footer" style="border-top: 1px solid #dcece2;">
                        <div class="clearfix">
                            <button class="btn registration__button">Далее</button>
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
