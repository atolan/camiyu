var form = document.getElementsByClassName("wpcf7-form")[0];
var controls = form.elements;
var requiredControls = document.getElementsByClassName("wpcf7-validates-as-required");
var agree = document.getElementById("agree");
var gotoCofirmBtn = document.getElementsByClassName("goto-confirmBtn")[0];
var backBtn = document.getElementsByClassName("returnTo")[0];
var textarea = document.getElementsByTagName("textarea")[0];

var APIkey = "bb8bf69fa52b030095831e1a8733e26a0e21abb5534f0696795153c8863f2366";
var object = {};
// document.getElementById("furi_name").disabled = true;

document.getElementById('inputData').style.display='block';
document.getElementById('ensureData').style.display='none';
gotoCofirmBtn.style.cursor = "not-allowed";

agree.addEventListener("change", function() {
  if (agree.checked) {
      gotoCofirmBtn.style.cursor = "pointer";
  } else {
    gotoCofirmBtn.style.cursor = "not-allowed";
  }
})

gotoCofirmBtn.addEventListener("click", confirm);
backBtn.addEventListener("click", back);


function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validateTel(phone) {
    const re = /^[\+]?[(]?[0-9]{2,4}[)]?[-\s\.]?[0-9]{2,4}[-\s\.]?[0-9]{2,6}$/im;
    return re.test(phone);
}

function validateKana(kana) {
    return kana.match(/^[ァ-ヶー　]*$/);
}
function removeElementsByClass(className){
    var elements = document.getElementsByClassName(className);
    while(elements.length > 0){
        elements[0].parentNode.removeChild(elements[0]);
    }
}
function confirm() {
    removeElementsByClass('validation-required');
    removeElementsByClass('validation-your-email');
    removeElementsByClass('validation-your-tel');
    var status = true;
    // Check if privacy
    if (!agree.checked) {
        return;
    }
    if(document.getElementById('inquery_type').value == "ーーーーーー未選択ーーーーーー") {
        status=false;
        if(document.getElementsByClassName('inquery_type')[0])
        document.getElementsByClassName('inquery_type')[0].insertAdjacentHTML("afterend", "<p class='validation-required'>お問合せ内容を選択してください。</p>");
    }
    // Check if required input fields are filled
    for (var index = 0; index < requiredControls.length; index++) {
        var element = requiredControls[index];
        var validationRequired = element.parentElement.getElementsByClassName("validation-required");
        if (element.value.length == 0) {
            status = false;
        }
        if (element.value.length == 0 && !validationRequired[0]) {
            element.insertAdjacentHTML("afterend", "<p class='validation-required'>必須項目を入力してください。</p>");
        } else if (element.value.length != 0 && validationRequired[0]) {
            validationRequired[0].remove();
        }
    }

    // Validate Email
    var yourEmail = document.getElementById('email');
    var validationYourEmail = document.getElementsByClassName('validation-your-email');
    if (yourEmail.value.length != 0 && !validateEmail(yourEmail.value)) {
        status = false;
    }
    if (yourEmail.value.length != 0 && !validateEmail(yourEmail.value) && !validationYourEmail[0]) {
        yourEmail.insertAdjacentHTML("afterend", "<p class='validation-your-email' style='color:#9D0A0F'>入力されたメールアドレスに間違いがあります。</p>");
    } else if (validateEmail(yourEmail.value) && validationYourEmail[0]) {
        validationYourEmail[0].remove();
    }

    // Validate tel
    var tel = document.getElementById('phone');
    var validationTel = document.getElementsByClassName('validation-your-tel');
    if (tel.value.length != 0 && !validateTel(tel.value)) {
        status = false;
    }
    if (tel.value.length != 0 && !validateTel(tel.value) && !validationTel[0]) {
        tel.insertAdjacentHTML("afterend", "<p class='validation-your-tel' style='color:#9D0A0F'>電話番号に間違いがあります。</p>");
    } else if (validateTel(tel.value) && validationTel[0]) {
        validationTel[0].remove();
    }
    
    // Move to confirm screen
    if (status == true) {
        form.classList.add("confirm");
        document.getElementById('inputData').style.display='none';
        document.getElementById('ensureData').style.display='block';
        document.getElementById('inqueryType').innerHTML = document.getElementById('inquery_type').value;
        document.getElementById('name').innerHTML = document.getElementById('kana_name').value;
        document.getElementById('companyName').innerHTML = document.getElementById('company').value;
        document.getElementById('emailAddress').innerHTML = document.getElementById('email').value;
        document.getElementById('phoneNumber').innerHTML = document.getElementById('phone').value;
        document.getElementById('inqueryContent').innerHTML = document.getElementById('inquery_content').value;
    } else {
        scrollUp();
    }

    
}

function back() {
    form.classList.remove("confirm");
    document.getElementById('inputData').style.display='block';
    document.getElementById('ensureData').style.display='none';
}