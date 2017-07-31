/**
 * @description JS基础库<依赖jQuery>
 *
 */

var IMOOC = IMOOC || {};
IMOOC.GLOBAL = {};
IMOOC.APPS = {};

IMOOC.APPS.QUERYPHONE = {};
IMOOC.APPS.QUERYPHONE.showInfo = function(){
    $('#phoneInfo').show();
};
IMOOC.APPS.QUERYPHONE.hideInfo = function(){
    $('#phoneInfo').hide();
};
IMOOC.APPS.QUERYPHONE.dataCallback = function(data) {
    if (data.code == 200) {
        // alert(data.catName);return;
        IMOOC.APPS.QUERYPHONE.showInfo();
        $('#phoneNumber').text(data.phone);
        $('#phoneProvince').text(data.province);
        $('#phoneCatName').text(data.catName);
        $('#phoneMsg').text(data.msg);
    } else {
        IMOOC.APPS.QUERYPHONE.hideInfo();
        alert(data.msg);
    }
};

IMOOC.GLOBAL.ajax = function(url, method, params, dataType, callback){
    $.ajax({
        url: url,
        type: method,
        data: params,
        dataType: dataType,
        success: callback,
        error:function(){
            alert('请求异常');
        }
    });
};