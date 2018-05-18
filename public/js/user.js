var username_state = false;
var validator = $( "#registerfrm" ).validate();
var validatorUpdate = $( "#updatefrm" ).validate();
var validatorUpdateProfile = $( "#update_profile" ).validate();
function _(el){
    return document.getElementById(el);
}

function check_username(){
    var status=_("username_status");
    var username = _('username').value;
    if (username == '' || username.length<4) {
        username_state = false;
        status.innerHTML="";
    }
    else{
        var ajax = ajaxObj("POST", "userAction");
        ajax.onreadystatechange = function() {
            if(ajaxReturn(ajax) == true) {

                if(ajax.responseText == "taken"){
                    username_state = false;

                    status.innerHTML="<span style='color:red;'>Username taken. Please choose another one</span>";

                } else if(ajax.responseText == "not_taken") {
                    username_state = true;
                    status.innerHTML="";
                }
            }
        };
        ajax.send("username="+username+"&username_check=1");
    }

}
function check_username_update(id){
    var username = _('username').value;
    var status=_("username_status");
    var i=id;
    if (username == '' || username.length<4) {
        username_state = false;
       status.innerHTML="";

    }
    else{
        var ajax = ajaxObj("POST", "userAction.php");
        ajax.onreadystatechange = function() {
            if(ajaxReturn(ajax) == true) {
                if(ajax.responseText == "taken"){
                    username_state = false;
                    status.innerHTML="<span style='color:red;'>Username taken. Please choose another one</span>";
                } else if(ajax.responseText == "not_taken") {
                    username_state = true;
                    status.innerHTML="";
                }

            }
        };
        ajax.send("username="+username+"&id="+i+"&username_update=1");
    }

}


function register()
{


      var  firstname=_("firstname" ).value;
        var lastname=_('lastname').value;
        var middle=_('middlename').value;
       var  email=_('email').value;
       var  password=_('password').value;
        var institution=_('institution').value;
        var level=_('level').value;
        var username=_('username').value;
    $( "#registerfrm" ).validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        }
    });

   if(username_state && validator.form()) {
        var ajax = ajaxObj("POST", "userAction");
        ajax.onreadystatechange = function() {
            if(ajaxReturn(ajax) == true) {
                if(ajax.responseText == "success"){
                    swal("Saved!");
                    _("registerfrm").reset();

                }
            }
        };
        ajax.send("username="+username+"&firstname="+firstname+"&middlename="+middle+"&password="+password+"&email="+email+"&institution="+institution+"&level="+level+"&lastname="+lastname+"&add=add");


    }



}

function editUser(id) {
    username_state=true;
    var  firstname=_("firstname" ).value;
    var lastname=_('lastname').value;
    var middle=_('middlename').value;
    var  email=_('email').value;
    var  password=_('password').value;
    var institution=_('institution').value;
    var level=_('level').value;
    var username=_('username').value;

     if(username !="" && username_state===false){

         _("username_status").focus();

     }
     else if(username_state && validatorUpdate.form()) {
        var ajax = ajaxObj("POST", "userAction");
        ajax.onreadystatechange = function() {
            if(ajaxReturn(ajax) == true) {
                if(ajax.responseText == "updated"){
                    swal("updated!");

                }
            }
        };
        ajax.send("username="+username+"&firstname="+firstname+"&middlename="+middle+"&password="+password+"&email="+email+"&institution="+institution+"&level="+level+"&lastname="+lastname+"&id="+id+"&edit=edit");


    }



}
function ValidateEmail(inputText)
{
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(inputText.match(mailformat))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function update_profile() {


    var  firstname=_("firstname" ).value;
    var lastname=_('lastname').value;
    var middle=_('middlename').value;
    var  email=_('email').value;
    var username=_('username').value;
    var id=_('hash').value;
     check_username_update(id);
     if(username_state && validatorUpdateProfile.form()) {
        var ajax = ajaxObj("POST", "userAction");
        ajax.onreadystatechange = function() {
            if(ajaxReturn(ajax) == true) {

                if(ajax.responseText == "updated"){
                    swal("updated!");
                    location.reload();
                }
            }
        };
        ajax.send("username="+username+"&firstname="+firstname+"&middlename="+middle+"&email="+email+"&lastname="+lastname+"&id="+id+"&update=update");


    }


}


