function adminAddNewProgram(subTypes) {
	var self = this;

	if (typeof(subTypes) == 'undefined') {
		var subTypes = [];
	}

	this.subTypes = subTypes;

	this.typeSelector = '#program_type_id';
	this.subTypeSelector = '#subtype_id_selector';
	this.subTypeInput = '#subtype_id';

	this.countrySelector = '#country_id';
	this.inputForSearchCity = '#city_name_for_search';
	this.cityForSelectContainer = '#city_list_for_select';
	this.citySelector = '#city_id';

	this.stipendCheckbox = '#stipend';
	this.stipendValueInput = '#stipendFormValue';

	this.parentProceduresSelector = '.program_procedure_0';

	this.addNewProgramLanguages = '.addNewLanguageToProgram';
	this.removeProgramLangugesButton = '.removeLanguageToProgram';


	this.skillRow = '.skillRow';
	this.skillGroupSeletor = '.programSkillGroupId';
	this.skillSelector = '.programSkillId';
	this.skillLevelSelector = '.programSkillLevel';
	this.skillReqCheckbox = '.programSkillReq';
	this.addNewSkillToProgram = '.addNewSkillToProgram';
	this.programSkillContainer = '.programSkills';
	this.removeSkillFromProgramButton = '.removeSkillFromProgram';


	this.animationTime = 300;
	this.confirmMessage = 'Delete this row?';
	this.selectText = 'Select please';

	this.init = function() {
		$('body').on('change', self.typeSelector, function(){
			self.buildSubTypesSelector();
		});

		$('body').on('change', self.subTypeSelector, function(){
			$(self.subTypeInput).val($(this).val());
		});

		$('body').on('change', self.countrySelector, function(){
			$(self.citySelector).html('');
			$(self.cityForSelectContainer).html('');
			self.searchCities();
		});

		$('body').on('keyup', self.inputForSearchCity, function(){
			self.searchCities();
		});

		$('body').on('click', self.cityForSelectContainer+' > div', function(){
			self.selectCity($(this));
		});

		$('body').on('change', self.stipendCheckbox, function(){
			self.checkStipend();
		});

		$('body').on('change', self.parentProceduresSelector, function(){
			self.checkCheckedProgramProcedure();
		});

		$('body').on('click', self.addNewProgramLanguages, function(){
			self.addNewLanguageToProgram();
		});

		$('body').on('click', self.removeProgramLangugesButton, function(){
			self.removeProgramLanguges($(this));
		});

		$('body').on('change', self.skillGroupSeletor, function(){
			self.getSkillsByGroup($(this));
		});

		$('body').on('click', self.addNewSkillToProgram, function(){
			self.addSkillToProgram();
		});

		$('body').on('click', self.removeSkillFromProgramButton, function(){
			self.removeSkill($(this));
		});

		self.startFunctions();
	}


	this.removeSkill = function(elemenet){
		if (confirm(self.confirmMessage)) {
			$(elemenet).parents('.skillRow:eq(0)').fadeOut(self.animationTime, function(){
				$(elemenet).parents('.skillRow:eq(0)').remove();
			});
		}
	}


	this.addSkillToProgram = function(){
		var group_id = parseInt($('.createNewProgramSkillsRow').find(self.skillGroupSeletor).val());
		var skill_id = parseInt($('.createNewProgramSkillsRow').find(self.skillSelector).val());
		var level_id = parseInt($('.createNewProgramSkillsRow').find(self.skillLevelSelector).val());
		var skill_req = $('.createNewProgramSkillsRow').find(self.skillReqCheckbox).prop('checked');
		if (isNaN(group_id) || isNaN(skill_id) || isNaN(level_id) || group_id <= 0 || skill_id <= 0 || level_id <= 0) {
			return false;
		}

		var cloneObject = $('.createNewProgramSkillsRow').clone();

		/* set default value in new skill row */
		$('.createNewProgramSkillsRow').find(self.skillGroupSeletor+' option').prop('selected', false);
		$('.createNewProgramSkillsRow').find(self.skillSelector).html('<option value="0">'+self.selectText+'</option>');
		$('.createNewProgramSkillsRow').find(self.skillLevelSelector+' option').prop('selected', false);
		$('.createNewProgramSkillsRow').find(self.skillReqCheckbox).prop('checked', false);
		/* end set default value in new skill row */

		cloneObject.removeClass('createNewProgramSkillsRow');
		cloneObject.find('input, select').attr('id', '');
		var remuveSkillButton = '<span class="btn btn-danger btn-sm removeSkillFromProgram"><i class="fa fa-trash"></i></span>';
		cloneObject.find(self.addNewSkillToProgram).parent().html(remuveSkillButton);
		$(self.programSkillContainer).append(cloneObject);
		var newSkill = $(self.programSkillContainer).find('.skillRow:last');
		newSkill.find(self.skillGroupSeletor+' option[value="'+group_id+'"]').prop('selected', true);
		newSkill.find(self.skillSelector+' option[value="'+skill_id+'"]').prop('selected', true);
		newSkill.find(self.skillLevelSelector+' option[value="'+level_id+'"]').prop('selected', true);
		if (skill_req) {
			newSkill.find(self.skillReqCheckbox).prop('checked', true);
		}
	}


	this.getSkillsByGroup = function(groupSelector) {
		var groupId = parseInt($(groupSelector).val());
		var skillRow = $(groupSelector).parents(self.skillRow+':eq(0)');
		var skillsSelector = skillRow.find(self.skillSelector);
		if (isNaN(groupId) || groupId <= 0) {
			$(skillsSelector).html('<option value="0">'+self.selectText+'</option>');
			return false;
		}

		$.ajax({
			url: baseUrl+'api/skills/get',
			type: 'POST',
			dataType: 'json',
			data: {
				group_id: groupId
			}
		}).done(function(data){
			var optionsHtml = '<option value="0">'+self.selectText+'</option>';
			if (!data.hasError) {
				for (key in data.skills) {
					optionsHtml += '<option value="'+key+'">'+data.skills[key]+'</option>';
				}
			}
			$(skillsSelector).html(optionsHtml);
		});
	}


	this.removeProgramLanguges = function(elemenet) {
		if (confirm(self.confirmMessage)) {
			$(elemenet).parents('.programLanguagesRow:eq(0)').fadeOut(self.animationTime, function(){
				$(elemenet).parents('.programLanguagesRow:eq(0)').remove();
			});
		}
	}


	this.addNewLanguageToProgram = function() {
		var langId = parseInt($('.createNewProgramLanguagesRow').find('.programLanguageId').val());
		var level = parseInt($('.createNewProgramLanguagesRow').find('.programLanguageLevel').val());
		var req = $('.createNewProgramLanguagesRow').find('.programLanguageLevel').prop('checked')
		if (isNaN(langId) || isNaN(level) || level <= 0 || langId <= 0) {
			return false;
		}
		var cloneLanguageRow = $('.createNewProgramLanguagesRow').clone();
		cloneLanguageRow.removeClass('createNewProgramLanguagesRow').addClass('programLanguagesRow');
		
		$('.createNewProgramLanguagesRow').find('.programLanguageLevel option').prop('selected', false);
		$('.createNewProgramLanguagesRow').find('.programLanguageId option').prop('selected', false);
		$('.createNewProgramLanguagesRow').find('.programLanguageReq').prop('checked', false);

		var deleteButton = '<span class="btn btn-danger btn-sm removeLanguageToProgram"><i class="fa fa-trash"></i></span>';
		cloneLanguageRow.find('.addNewLanguageToProgram').parent().html(deleteButton);

		cloneLanguageRow.find('.programLanguageId option[value="'+langId+'"]').prop('selected', true);
		cloneLanguageRow.find('.programLanguageLevel option[value="'+level+'"]').prop('selected', true);
		if (req) {
			cloneLanguageRow.find('.programLanguageReq').prop('checked', true);
		}
		cloneLanguageRow.find('input').attr('id', '');
		$('.programLanguages').append(cloneLanguageRow);

	}


	this.checkCheckedProgramProcedure = function() {
		$(self.parentProceduresSelector).each(function(){
			var id = $(this).val();
			if ($(this).prop('checked')) {
				$('.program_procedure_'+id).prop('disabled', false);
			} else {
				$('.program_procedure_'+id).prop('checked', false).prop('disabled', true);
			}
		});
	}


	this.checkStipend = function(){
		if ($(self.stipendCheckbox).prop('checked')) {
			$(self.stipendValueInput).fadeIn(self.animationTime);
		} else {
			$(self.stipendValueInput).fadeOut(self.animationTime);
		}
	}


	this.selectCity = function(element) {
		var cityId = parseInt($(element).attr('data-city-id'));
		var cityName = $(element).html();
		$(self.cityForSelectContainer).html('');
		$(self.citySelector).val(cityId);
		$(self.inputForSearchCity).val(cityName);
	}


	this.buildSubTypesSelector = function() {
		var selectedType = parseInt($(self.typeSelector).val());
		var selectedSubType = parseInt($(self.subTypeInput).val());
		var subTypeOptionsHtml = '';
		if (typeof(self.subTypes[selectedType]) != 'undefined') {
			var currentSubTypes = self.subTypes[selectedType];
			for (var subTypeId in currentSubTypes) {
				var selected = '';
				if (selectedSubType == subTypeId) {
					selected = 'selected';
				}
				subTypeOptionsHtml += '<option '+selected+' value="'+subTypeId+'">'+currentSubTypes[subTypeId]+'</option>';
			}
		} else {
			$(self.subTypeInput).val(0);
		}
		$(self.subTypeSelector).html(subTypeOptionsHtml);
	}


	this.getCityRequest = null
	this.searchCities = function(){
		if (self.getCityRequest) {
			self.getCityRequest.abort();
		}
		var country_id = parseInt($(self.countrySelector).val());
		var city_name = $(self.inputForSearchCity).val().trim();
		if (isNaN(country_id) || country_id <= 0 || city_name == '') {
			$(self.cityForSelectContainer).html('');
			return false;
		}
		self.getCityRequest = $.ajax({
			url: baseUrl+'api/cities/get',
			type: 'POST',
			dataType: 'json',
			data: {
				country_id: country_id,
				city_name: city_name,
				limit: 10
			}
		}).done(function(data){
			if (data.hasError) {
				$(self.cityForSelectContainer).html('');
			} else {
				var selectOptions = '';
				var firstCity = 0;
				for (key in data.cities) {
					if (!firstCity) {
						firstCity = key;
					}
					selectOptions += '<div data-city-id="'+key+'">'+data.cities[key]+'</div>';
					$(self.cityForSelectContainer).html(selectOptions);
				}
				$(self.citySelector).val(firstCity);
			}
		});
	}


	this.getCityById = function(city_id) {
		$.ajax({
			url: baseUrl+'api/cities/get',
			type: 'POST',
			dataType: 'json',
			data: {
				city_id: city_id,
				limit: 1
			}
		}).done(function(data){
			if (!data.hasError) {
				var selectOptions = '';
				var firstCity = 0;
				var cityName = '';
				for (key in data.cities) {
					if (!firstCity) {
						firstCity = key;
						cityName = data.cities[key];
					}
				}
				$(self.inputForSearchCity).val(cityName);
				$(self.citySelector).val(firstCity);
			}
		});
	}

	this.startFunctions = function() {
		self.buildSubTypesSelector();
		var city_id = parseInt($(self.citySelector).val());
		if (!isNaN(city_id) || city_id > 0) {
			self.getCityById(city_id);
		}
		self.checkStipend();
		self.checkCheckedProgramProcedure();
	}

	this.init();
}