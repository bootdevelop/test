var TerraControlTypeEnum = {
    CHECK_BOX: "checkBox",
    CONDITIONAL_CONTAINER: "conditionalContainer",
    DATE_PICKER: "datePicker",
    HORIZONTAL_CONTAINER: "horizontalContainer",
    INPUT_FILE: "inputFile",
    INPUT_TEXT: "inputText",
    INPUT_TEXT_AREA: "inputTextArea",
    INPUT_NUMBER: "inputNumber",
    INPUT_DOUBLE: "inputDouble",
    SELECT_BOX: "selectBox",
    VERTICAL_CONTAINER: "verticalContainer",
    CATEGORY_PICKER: "categoryPicker",
    COLOR_PICKER: "colorPicker",
    MULTI_CHECK_BOX: "multiCheckBox"
};

var supportedFormatVersion = 1.0;

function convert() {
    var jsonConfig = document.getElementById('convert-text-area');
    jsonConfig = JSON.parse(jsonConfig.value);

    var translationTextArea = document.getElementById('translation-text-area');
    var translationFile = this.createTranslationFile(jsonConfig);
    translationTextArea.value = translationFile;

    var newConfig = document.getElementById('converted-text-area');
    var jsonNewConfig = JSON.stringify(mapLegacyConfigToNewStructure(jsonConfig), null, 4);
    newConfig.value = jsonNewConfig;
}

function copyTextAreaContentById(textAreaId) {
    var copyText = document.getElementById(textAreaId);
    copyText.select();
    document.execCommand("Copy");
}

String.prototype.toCamelCase = function() {
    return this
    // Replaces any - or _ characters with a space
        .replace( /[-_.]+/g, ' ')
        // Removes any non alphanumeric characters
        .replace( /[^\w\s]/g, '')
        // Uppercases the first character in each group immediately following a space
        // (delimited by spaces)
        .replace( / (.)/g, function($1) { return $1.toUpperCase(); })
        // Removes spaces
        .replace( / /g, '' );
};

function createTranslationFile(jsonConfig) {
    const configKeyPrefix = 'Config.';
    var properties = [];
    jsonConfig.forEach(function (configField) {
        var key = configField.key;
        var camelCaseKey = key.toCamelCase();

        if(configField.tab)
        {
            var propertyKey = configField.tab + 'Tab';
            var propertyKeyCamelCase = propertyKey.toCamelCase();
            var propertyEntry = propertyKeyCamelCase + '=' + configField.tab;
            if (!properties.find(function(entry) { return entry === propertyEntry}))
            {
                properties.push(propertyEntry)
            }
            configField.tab = configKeyPrefix + propertyKeyCamelCase;
        }
        if(configField.label)
        {
            var camelCaseLabelKey = camelCaseKey + 'Label';
            properties.push(camelCaseLabelKey + '=' + configField.label);
            configField.label = configKeyPrefix + camelCaseLabelKey;
        }
        if(configField.possibleValues)
        {
            Object.keys(configField.possibleValues).forEach(function (possibleValue) {
                var possibleValueKey = camelCaseKey + 'PossibleValue-' + possibleValue;
                var possibleValueKeyCamelCase = possibleValueKey.toCamelCase();
                properties.push(possibleValueKeyCamelCase + '=' + configField.possibleValues[possibleValue]);
                configField.possibleValues[possibleValue] = configKeyPrefix + possibleValueKeyCamelCase;
            });
        }
    });
    return properties.join('\n');
}

mapLegacyConfigToNewStructure = function (config) {
    var groupedLegacyConfig = getGroupedLegacyConfig(config);
    var newConfig = {
        formatVersion: this.supportedFormatVersion,
        menu: {}
    };
    for (var groupKey in groupedLegacyConfig) {
        if (groupedLegacyConfig.hasOwnProperty(groupKey)) {
            newConfig.menu[groupKey] = {
                label: groupKey,
                formFields: this.mapLegacyConfigFieldToNewStructure(groupedLegacyConfig[groupKey])
            };
        }
    }
    return newConfig;
};
getGroupedLegacyConfig = function (config) {
    var groupedConfig = {};
    config.forEach(function (configField) {
        if (typeof groupedConfig[configField.tab] == "undefined") {
            groupedConfig[configField.tab] = [configField];
        }
        else {
            groupedConfig[configField.tab].push(configField);
        }
    });
    return groupedConfig;
};
getFormFieldType = function (type) {
    switch (type) {
        case 'text':
            return TerraControlTypeEnum.INPUT_TEXT;
        case 'checkbox':
            return TerraControlTypeEnum.CHECK_BOX;
        case 'dropdown':
            return TerraControlTypeEnum.SELECT_BOX;
        case 'textarea':
            return TerraControlTypeEnum.INPUT_TEXT_AREA;
        case 'category_select':
            return TerraControlTypeEnum.CATEGORY_PICKER;
        case 'multi_select':
            return TerraControlTypeEnum.MULTI_CHECK_BOX;
        case 'password':
            return TerraControlTypeEnum.INPUT_TEXT;
        default:
            console.log(type);
            return undefined;
    }
};
mapLegacyConfigFieldToNewStructure = function (config) {
    var _this = this;
    var newConfig = {};
    config.forEach(function (configField) {
        var formFieldType = getFormFieldType(configField.type);
        newConfig[configField.key] = {
            type: formFieldType,
            required: false,
            label: configField.label,
            options: _this.getFormFieldOptionsForLegacyConfigField(formFieldType, configField)
        };
        if(configField.deprecated)
        {
            newConfig[configField.key].deprecated = true;
        }
    });
    return newConfig;
};
getFormFieldOptionsForLegacyConfigField = function (fieldType, configField) {
    var options = {
        defaultValue: configField.default
    };
    switch (fieldType) {
        case TerraControlTypeEnum.SELECT_BOX:
            var selectBoxValues = [];
            for (var valueKey in configField.possibleValues) {
                if (configField.possibleValues.hasOwnProperty(valueKey)) {
                    selectBoxValues.push({
                        value: valueKey,
                        caption: configField.possibleValues[valueKey]
                    });
                }
            }
            options.selectBoxValues = selectBoxValues;
            break;
        case TerraControlTypeEnum.MULTI_CHECK_BOX:
            var multiSelectBoxValues = [];
            for (var valueKey in configField.possibleValues) {
                if (configField.possibleValues.hasOwnProperty(valueKey)) {
                    multiSelectBoxValues.push({
                        value: valueKey,
                        caption: configField.possibleValues[valueKey]
                    });
                }
            }
            options.checkBoxValues = multiSelectBoxValues;
            break;
        case TerraControlTypeEnum.INPUT_TEXT:
            if (configField.type === 'password') {
                options.isPassword = true;
                options.isIBAN = false;
            }
            break;
    }
    return options;
};
getFormFieldByKey = function (formFields, key) {
    return formFields.find(function (field) {
        return field.key === key;
    });
};
isLegacyConfig = function (config) {
    return isArray(config) && config.length > 0;
};
isValidConfig = function (config) {
    return config && isObject(config) && Object.keys(config).length > 0 && this.isSupportedFormatVersion(config);
};
isSupportedFormatVersion = function (config) {
    return config.hasOwnProperty('formatVersion') && Number(config.formatVersion) === this.supportedFormatVersion;
};
