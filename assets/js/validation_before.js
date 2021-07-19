var APIkey = "bb8bf69fa52b030095831e1a8733e26a0e21abb5534f0696795153c8863f2366";
var object = {};
// var btn = document.getElementById("sendBtn");
// btn.disabled = true;
document.getElementById("furi_name").disabled = true;
// $("#agree").on("change",function(){
//     if($(this).is(":checked")){
//         $("#sendBtn").attr("disabled",false);
//     } else {
//         $("#sendBtn").attr("disabled",true);
//     }
// })
var base_url = "http://localhost/kamiyu/confirm";
function validate() {
    event.preventDefault();
    var flag = true;
	if($("#inquery_type").val() == "" || $("#kana_name").val() == "" || $("#furi_name").val() == "" || $("#email").val() == "" || $("#inquery_content").val() == "" || $("#company").val() == "" || !$("#agree").is(":checked")) {
        if($("#inquery_type").val() == "") {
            $("#inquery_type_error").css('display','block');
            flag = false;
        }
        if($("#kana_name").val() == "") {
            $("#kana_name_error").css('display','block');
            flag = false;
        }
        if($("#furi_name").val() == "") {
            $("#furi_name_error").css('display','block');
            flag = false;
        }
        if($("#email").val() == "") {
            $("#email_error").css('display','block');
            flag = false;
        }
        if($("#inquery_content").val() == "") {
            $("#inquery_content_error").css('display','block');
            flag = false;
        }
        if($("#company").val() == "") {
            $("#company_error").css('display','block');
            flag = false;
        }
        if(!$("#agree").is(":checked")) {
            $("#agree_error").css('display','block');
            flag = false;
        }
    }
    if(flag) {
        Cookies.set('inquerytype', $('#inquery_type').val(), { expires: 1 });
        Cookies.set('kananame', $('#kana_name').val(), { expires: 1 });
        Cookies.set('furiname', $('#furi_name').val(), { expires: 1 });
        Cookies.set('phone', $('#phone').val(), { expires: 1 });
        Cookies.set('email', $('#email').val(), { expires: 1 });
        Cookies.set('inquerycontent', $('#inquery_content').val(), { expires: 1 });
        Cookies.set('company', $('#company').val(), { expires: 1 });
        window.location.href = base_url;
    }
}
$("#inquery_type").keydown(function(){
	$('#inquery_type_error').html("");
});
$("#inquery_type").click(function(){
	$('#inquery_type_error').css('display','none');
});
$('#kana_name').keydown(function(){
	$('#kana_name_error').html("");
});
$('#kana_name').click(function(){
	$('#kana_name_error').css('display','none');
});
$('#furi_name').keydown(function(){
	$('#furi_name_error').html("");
});
$('#furi_name').click(function(){
	$('#furi_name_error').css('display','none');
});
$('#email').keydown(function(){
	$('#email_error').html("");
});
$('#email').click(function(){
	$('#email_error').css('display','none');
});
$('#inquery_content').keydown(function(){
	$('#inquery_content_error').html("");
});
$('#inquery_content').click(function(){
	$('#inquery_content_error').css('display','none');
});
$('#company').keydown(function(){
	$('#company_error').html("");
});
$('#company').click(function(){
	$('#company_error').css('display','none');
});
$('#agree').click(function(){
	$('#agree_error').css('display','none');
});
$("#sendBtn").submit(function(e) {
    e.preventDefault();
});
$('#contactForm').submit(function(event) {
	event.preventDefault();
	var self = this;
	window.setTimeout(function() {
		self.submit();
	}, 2000);
});

$("#kana_name").on("input", function(){
    object = {
        "app_id": APIkey,
        "sentence": $("#kana_name").val(),
        "output_type": "hiragana"
    };
    fetch("https://labs.goo.ne.jp/api/hiragana",{
        method:"POST",
        headers:{
            'Accept': "application/json, text/plain, */*",
            'Content-Type': "application/json;charset=UTF-8",
        },
        body:JSON.stringify(object)
    }).then(res=>res.json())
    .then(data=>{
        console.log(data.converted);
        document.getElementById("furi_name").value = data.converted;

    });
});
