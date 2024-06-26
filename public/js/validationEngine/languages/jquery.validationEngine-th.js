(function($){
    $.fn.validationEngineLanguage = function(){
    };
    $.validationEngineLanguage = {
        newLang: function(){
            $.validationEngineLanguage.allRules = {
                "required": { // Add your regex rules here, you can take telephone as an example
                    "regex": "none",
                    "alertText": "* กรุณากรอกข้อมูล",
                    "alertTextCheckboxMultiple": "* กรุเลือกตัวเลือก",
                    "alertTextCheckboxe": "* กรุณาเลือก 1 ตัวเลือก",
                    "alertTextDateRange": "* กรุณาเลือกวันที่"
                },
                "requiredInFunction": {
                    "func": function(field, rules, i, options){
                        return (field.val() == "test") ? true : false;
                    },
                    "alertText": "* ข้อมูลช่องนี้ต้องมีค่าเท่ากับ test"
                },
                "dateRange": {
                    "regex": "none",
                    "alertText": "* ข้อมูลไม่ถูกต้อง ",
                    "alertText2": "ช่วงของวันที่"
                },
                "dateTimeRange": {
                    "regex": "none",
                    "alertText": "* ข้อมูลไม่ถูกต้อง ",
                    "alertText2": "ช่วงของวันที่และเวลา"
                },
                "minSize": {
                    "regex": "none",
                    "alertText": "* ข้อมูลอย่างน้อย ",
                    "alertText2": " ตัวอักษร"
                },
                "maxSize": {
                    "regex": "none",
                    "alertText": "* ข้อมูลมากสุด ",
                    "alertText2": " ตัวอักษร"
                },
		        "groupRequired": {
                    "regex": "none",
                    "alertText": "* กรุณาเลือก 1 ตัวเลือกจากทั้งหมด",
                    "alertTextCheckboxMultiple": "* กรุณาเลือกตัวเลือก",
                    "alertTextCheckboxe": "* กรุณาเลือก 1 ตัวเลือก"
                },
                "min": {
                    "regex": "none",
                    "alertText": "* ข้อมูลอย่างน้อยคือ "
                },
                "max": {
                    "regex": "none",
                    "alertText": "* ข้อมูลอย่างมากคือ "
                },
                "past": {
                    "regex": "none",
                    "alertText": "* วันก่อนหน้า "
                },
                "future": {
                    "regex": "none",
                    "alertText": "* วันในอดีต "
                },
                "maxCheckbox": {
                    "regex": "none",
                    "alertText": "* มากที่สุด ",
                    "alertText2": " จำนวนของที่เลือกได้"
                },
                "minCheckbox": {
                    "regex": "none",
                    "alertText": "* กรุณาเลือก ",
                    "alertText2": " ข้อ"
                },
                "equals": {
                    "regex": "none",
                    "alertText": "* ข้อมูลไม่ตรงกัน"
                },
                "creditCard": {
                    "regex": "none",
                    "alertText": "* เลขบัตรเครติดไม่ถูกต้อง"
                },
                "phone": {
                    // credit: jquery.h5validate.js / orefalo
                    "regex": /^([\+][0-9]{1,3}([ \.\-])?)?([\(][0-9]{1,6}[\)])?([0-9 \.\-]{1,32})(([A-Za-z \:]{1,11})?[0-9]{1,4}?)$/,
                    "alertText": "* หมายเลขโทรศัพท์ไม่ถูกต้อง"
                },
                "email": {
                    // HTML5 compatible email regex ( http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#    e-mail-state-%28type=email%29 )
                    "regex": /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                    "alertText": "* อีเมลไม่ถูกต้อง"
                },
                "fullname": {
                    "regex":/^([a-zA-Z]+[\'\,\.\-]?[a-zA-Z ]*)+[ ]([a-zA-Z]+[\'\,\.\-]?[a-zA-Z ]+)+$/,
                    "alertText": "* ต้องใส่ชื่อและนามสกุล"
                },
                "zip": {
                    "regex":/^\d{5}$|^\d{5}-\d{4}$/,
                    "alertText": "* รหัสไปรษณีย์ไม่ถูกต้อง"
                },
                "integer": {
                    "regex": /^[\-\+]?\d+$/,
                    "alertText": "* จำนวนเต็มไม่ถูกต้อง"
                },
                "number": {
                    // Number, including positive, negative, and floating decimal. credit: orefalo
                    "regex": /^[\-\+]?((([0-9]{1,3})([,][0-9]{3})*)|([0-9]+))?([\.]([0-9]+))?$/,
                    "alertText": "* ตัวเลขไม่ถูกต้อง"
                },
                "date": {
                    //	Check if date is valid by leap year
        			"func": function (field) {
    					var pattern = new RegExp(/^(\d{4})[\/\-\.](0?[1-9]|1[012])[\/\-\.](0?[1-9]|[12][0-9]|3[01])$/);
    					var match = pattern.exec(field.val());
    					if (match == null)
    					   return false;

    					var year = match[1];
    					var month = match[2]*1;
    					var day = match[3]*1;
    					var date = new Date(year, month - 1, day); // because months starts from 0.

    					return (date.getFullYear() == year && date.getMonth() == (month - 1) && date.getDate() == day);
        			},
			        "alertText": "* วันที่ไม่ถูกต้อง, ต้องเป็นรูปแบบ ปปปป-ดด-วว"
                },
                "ipv4": {
                    "regex": /^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,
                    "alertText": "* ที่อยู่ IP ไม่ถูกต้อง"
                },
                "ip": {
                    "regex": /((^\s*((([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))\s*$)|(^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$))/,
                    "alertText": "* ที่อยู่ IP ไม่ถูกต้อง"
                },
                "url": {
                    "regex": /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i,
                    "alertText": "* ลิงค์ไม่ถูกต้อง"
                },
                "onlyNumberSp": {
                    "regex": /^[0-9\ ]+$/,
                    "alertText": "* ตัวเลขเท่านั้น"
                },
                "onlyLetterSp": {
                    "regex": /^[a-zA-Z\ \']+$/,
                    "alertText": "* ตัวหนังสือเท่านั้น"
                },
				"onlyLetterAccentSp":{
                    "regex": /^[a-z\u00C0-\u017F\ ]+$/i,
                    "alertText": "* ตัวหนังสือเท่านั้น"
                },
                "onlyLetterNumber": {
                    "regex": /^[0-9a-zA-Z]+$/,
                    "alertText": "* ไม่สามารถใช้อักษรพิเศษ"
                },
                // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxUserCall": {
                    "url": "ajaxValidateFieldUser",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    "alertText": "* ข้อมูลถูกใช้ไปแล้ว",
                    "alertTextLoad": "* กำลังตรวจสอบข้อมูล"
                },
				"ajaxUserCallPhp": {
                    "url": "phpajax/ajaxValidateFieldUser.php",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* ใช้ username นี้ได้",
                    "alertText": "* ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว",
                    "alertTextLoad": "* กำลังตรวจสอบข้อมูล"
                },
                "ajaxNameCall": {
                    // remote json service location
                    "url": "ajaxValidateFieldName",
                    // error
                    "alertText": "* ชื่อนี้ถูกใช้ไปแล้ว",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* ใช้ชื่อนี้ได้",
                    // speaks by itself
                    "alertTextLoad": "* กำลังจรวจสอบข้อมูล"
                },
				 "ajaxNameCallPhp": {
	                    // remote json service location
	                    "url": "phpajax/ajaxValidateFieldName.php",
	                    // error
	                    "alertText": "* ชื่อนี้ถูกใช้ไปแล้ว",
                        // speaks by itself
                        "alertTextLoad": "* กำลังจรวจสอบข้อมูล"
	            },
                "validate2fields": {
                    "alertText": "* กรอกข้อมูล HELLO"
                },
	            //tls warning:homegrown not fielded
                "dateFormat":{
                    "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:0?[1-9]|1[0-2])(\/|-)(?:0?[1-9]|1\d|2[0-8]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(0?2(\/|-)29)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/,
                    "alertText": "* วันที่ไม่ถูกต้อง"
                },
                //tls warning:homegrown not fielded
				"dateTimeFormat": {
	                "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1}$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^((1[012]|0?[1-9]){1}\/(0?[1-9]|[12][0-9]|3[01]){1}\/\d{2,4}\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1})$/,
                    "alertText": "* รูปแบบวันที่และเวลาไม่ถูกต้อง",
                    "alertText2": "ต้องการรูปแบบตามนี้: ",
                    "alertText3": "ดด/วว/ปปปป hh:mm:ss AM|PM หรือ ",
                    "alertText4": "ปปปป-ดด-วว hh:mm:ss AM|PM"
	            }
            };

        }
    };

    $.validationEngineLanguage.newLang();

})(jQuery);
