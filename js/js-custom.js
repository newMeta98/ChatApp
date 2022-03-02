/*! CUSTOM CHAT JS | */
$(document).ready(function(){

var start = 0;
var startChat = 0;
var startSeen = 0;  


if ($(window).width() < 950) {

    /*! Fun - fetch chat tab On click | */ 
    $(document).on('click', '.chats_li', function(){

        var chat_id = $(this).attr("id");
        $('#view_seen_img').attr('src', '');
        $(".arow_back").css("display" , "block");
        $(".arow_back").val("chat");
        chat_tab_header_mobile(chat_id);
        
    });

    $(document).on('click', '.arow_back', function(){
              if ($(this).val() == "chat") {
              $(this).val("unchek");   
                $("#main_flex").css("flex", "0");
                $(".aside_l").css("display" , "block");
              }
              else if ($(this).val() == "info"){
                $('.arow_back').val("chat"); 
                $("#main_flex").css("flex", "8");
                $(".aside_r").css("flex", "0");
                $('#info').val("unchek");
              }
    });

    $(document).on('click', '#info', function(){
              if ($(this).val() == "unchek") {
              $(this).val("chek");
                $('.arow_back').val("info");   
                $("#main_flex").css("flex", "0");
                $(".aside_r").css("flex", "8");
              }
    });

    $('#search').keyup(function(e){
           
         if (!$.trim($("#search").val())) {
             $("#chats").css("width" , "100%");
              $("#chats_new").css("display" , "none");
              $("#chats_new").html('');

        }else{
            $("#chats").css("width" , "0%");
            $("#chats_new").css("display" , "block");
            name = $('#search').val();
                search_name(name);

            
            $(document).on('click', '.search_li', function(e){
                 e.stopImmediatePropagation();
                var userEmail = $(this).attr("id");
                    search_btn(userEmail);
                        document.getElementById('search').value = '';
                        $("#chats_new").html('');
                        $("#chats_new").css("display" , "none");
                        $("#chats").css("width" , "100%");
            });
        }

    });
    function  search_name(name){
            action = 'search';
            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action, name:name},
                success:function(data)
                {   
                    $('#chats_new').html(data);
                     
                } 
             });
    }
    function search_btn(userEmail) {
        action = 'search_btn';
                $.ajax({
                    url:"actions/serverMessinger.php",
                    method: "POST",
                    data:{action:action, userEmail:userEmail},
                    success:function(data)
                    {   $('#view_seen_img').attr('src', '');
                        $(".arow_back").css("display" , "block");
                        $(".arow_back").val("chat");
                        chat_tab_header_mobile(data);

                    } 
                }); 
    }




var active_chat_rs = 1;
    function chat_tab_header_mobile(id) {
            var chat_id = id;
            var action = "chat_tab_header";
            

            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action,chat_id:chat_id},
                success:function(data)
                { 
                    $('#secret').val(CryptoJSAesDecrypt(readCookie('secreetJs'), data.secret));
                    if ($('#chat_tab_header').html(data.header))
                    {   info_header(chat_id);
                        
                        $(".aside_l").css("display" , "none");
                         $("#main_flex").css("flex" , "8");
                        var RsStart = 1;
                        messages(RsStart);
                        active_chat();
                        $(".main_chat_send").css("visibility" , "visible");
                    } 
                } 
            });
        if (active_chat_rs == 1) {
            var active_messages_RS = setInterval(function(){ 
            active_chat();
            
        }, 500);
        active_chat_rs = 0;
        }
    }

    function ifwrite() {
        if ($('#msg_input').val() != "") {

                $(".wrap_flex1").css("flex" , "3");
                $(".transform").css("transform" , "scale(0.5,0.5)");
                $(".wrap_flex2").css("flex", "15");
                
                $(".chat_btn_like").css("display", "none");
                $(".chat_btn_send").css("display", "block");
                
                $(".wrap_flex6").css("flex" , "2");
            }else{
                $(".wrap_flex1").css("flex", "5");
                $(".transform").css("transform" , "scale(1,1)");
                $(".wrap_flex2").css("flex", "13");

                $(".chat_btn_like").css("display", "block");
                $(".chat_btn_send").css("display", "none");
                $(".wrap_flex6").css("flex" , "5");
            }

    }


}
else {
   

   $(document).on('click', '#info', function(){

              if ($(this).val() == "unchek") {
              $(this).val("chek");   
                $("#main_flex").css("flex", "5");
                $(".aside_r").css("flex", "3");
              }
              else {
              $(this).val("unchek");
                $("#main_flex").css("flex", "8");
                $(".aside_r").css("flex", "0");
              }
          });



    /*! Fun - fetch chat tab On click | */ 
$(document).on('click', '.chats_li', function(){

        var chat_id = $(this).attr("id");
        $('#view_seen_img').attr('src', '');

        chat_tab_header(chat_id);
        
 });
    $('#search').keyup(function(e){
           
         if (!$.trim($("#search").val())) {
             $("#chats").css("width" , "100%");
              $("#chats_new").css("display" , "none");
              $("#chats_new").html('');

        }else{
            $("#chats").css("width" , "0%");
            $("#chats_new").css("display" , "block");
            name = $('#search').val();
                search_name(name);

            
            $(document).on('click', '.search_li', function(e){
                 e.stopImmediatePropagation();
                var userEmail = $(this).attr("id");
                    search_btn(userEmail);
                        document.getElementById('search').value = '';
                        $("#chats_new").html('');
                        $("#chats_new").css("display" , "none");
                        $("#chats").css("width" , "100%");
            });
        }

    });
    function  search_name(name){
            action = 'search';
            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action, name:name},
                success:function(data)
                {   
                    $('#chats_new').html(data);
                } 
             });
    }
    function search_btn(userEmail) {
        action = 'search_btn';
                $.ajax({
                    url:"actions/serverMessinger.php",
                    method: "POST",
                    data:{action:action, userEmail:userEmail},
                    success:function(data)
                    {      
                          chat_tab_header(data);

                    } 
                }); 
    }

var active_chat_rs = 1;
        function chat_tab_header(id) {
            var chat_id = id;
            var action = "chat_tab_header";

            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action,chat_id:chat_id},
                success:function(data)
                {  
                    $('#secret').val(CryptoJSAesDecrypt(readCookie('secreetJs'), data.secret));
                    if ($('#chat_tab_header').html(data.header)) 

                    {   info_header(chat_id);
                        var RsStart = 1;
                        messages(RsStart);
                        active_chat();
                        $(".main_chat_send").css("visibility" , "visible");
                    } 
                } 
            });
        if (active_chat_rs == 1) {
            var active_messages_RS = setInterval(function(){ 
            active_chat();
            
        }, 500);
        active_chat_rs = 0;
        }
    }

        function ifwrite() {
        if ($('#msg_input').val() != "") {

                $(".wrap_flex1").css("flex" , "1");
                $(".transform").css("transform" , "scale(0.5,0.5)");
                $(".wrap_flex2").css("flex", "16");
                
                
                $(".chat_btn_like").css("display", "none");
                $(".chat_btn_send").css("display", "block");
            }else{
                $(".wrap_flex1").css("flex", "3");
                $(".transform").css("transform" , "scale(1,1)");
                $(".wrap_flex2").css("flex", "13");

                $(".chat_btn_like").css("display", "block");
                $(".chat_btn_send").css("display", "none");
            }

    }
}
     

$(document).on('click', '#redirect_log', function(){
        $("#register").hide();
        $("#login").css("display", "flex");
 });
$(document).on('click', '#redirect_reg', function(){
        $("#login").hide();
        $("#register").css("display", "flex");
 });

$('#Join_form').submit(function(event){
    event.preventDefault();
    
    var action = "reg_user";
    var email = $('#email').val();
    var username = $('#username').val();


    var password_11 = $('#password_1').val();
    var password_1 = rsa.encrypt(password_11);

    var password_22 = $('#password_2').val();
    var password_2 = rsa.encrypt(password_22);

    var agree = $('#agree').val();
    var question = $('#question').val();
        question = rsa.encrypt(question);

    var pin = $('#pin').val();
        pin = rsa.encrypt(pin);
        if ( email == '') {
        
            return false;
        
        }else{    
                $.ajax({
                url:"actions/serverCreate.php",
                method: "POST",
                data:{reg_user:action, email:email, 
                    username:username, password_1:password_1, 
                    password_2:password_2, agree:agree, 
                    question:question, pin:pin},
                success:function(data)
                    {

                        
                        location.reload();
                        fetch_header_Chat();
                    }   
                });
                        location.reload();
            }         
});

$('#Login_form').submit(function(event){
    event.preventDefault();
    var action = "log_user";
    var email = $('#email_Login').val();
    var password = $('#password_Login').val();
        password = rsa.encrypt(password);
    var pin = $('#pin_log').val();
        pin = rsa.encrypt(pin);
    
        if ( email == '') {
        
            return false;
        
        }else{    
                $.ajax({
                url:"actions/login.php",
                method: "POST",
                data:{log_user:action, email:email, 
                    password:password, pin:pin},
                success:function(data)
                    {

                        location.reload();
                        fetch_header_Chat();
                    }   
                });
                        location.reload();
            }         
 });
$('#enterPIN').submit(function(event){
    event.preventDefault();
    var action = "enterPIN";
    var pin = $('#pin').val();
        pin = rsa.encrypt(pin);
    
        if ( $('#pin').val() == '') {
        
            return false;
        
        }else{    
                $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action,  pin:pin},
                success:function(data)
                    {
                        if ('false' == data) {


                        }else{
                            location.reload();
                            fetch_header_Chat();                           
                        }


                    }   
                });
            }         
 });

function info_header(chat_id) {
    var chat_id = chat_id;
    var action = 'info_btns';
    $("#right_info").children('h2').text($("#chat_tab_header").children('h3').text());
    $("#right_info").children('img').attr('src', $("#chat_tab_header").children('img').attr('src'));

    $.ajax({
        url:"actions/serverMessinger.php",
        method: "POST",
        data:{action:action, chat_id:chat_id},
        success:function(data)
            {
                $(".info_btns_wrap").html(data);
            }   
    });
}

$(document).on('click', '.info_btns_li', function(){

        var chat_id = $('#chat_id').val();
        if ($(this).val() == "info_nick") {

            $(this).val("info_nick_check");
            $('#hidden_nick').css("display", "block");
            
        }else if ($(this).val() == "info_imgs") {

            $(this).val("info_imgs_check");

            var action = 'info_imgs';
            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action, chat_id:chat_id},
                success:function(data)
                    {    
                        $(".chat_imgs_wrap").html(data);
                        $('.chat_imgs_wrap').css("display", "block");
                    }   
            });
        }else if ($(this).val() == "info_nick_check") {

            $(this).val("info_nick");
            $('#hidden_nick').css("display", "none");
            
        }else if ($(this).val() == "info_imgs_check") {

            $(this).val("info_imgs");
            $(".chat_imgs_wrap").html('');
            $('.chat_imgs_wrap').css("display", "none");
        }
        
});

$(document).on('click', '.btn_save', function(){
        
            var chat_id = $(this).val();

            if ($(this).attr('id') == 'btn_save_nick') {
                var nick = $('#info_input_nick').val(); 
            }
           
            var action = 'info_btn_save_nick';
            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action, chat_id:chat_id, nick:nick},
                success:function(data)
                    {    
                        location.reload();
                    }   
            });
});


$(document).on('click', '#more_btn', function(){
        
        if ($(this).val() == "unchek") {

            $(".more_options").css("display", "block");
            $("#more_btn").val('chek');
            $(this).addClass('active_more');

        }else {

            $(this).val("unchek");
            $(".more_options").css("display", "none");
            $(this).removeClass('active_more');
            
        }
 });
$(document).on('click', '#promeni_sliku', function(){
        
        if ($(this).val() == "unchek") {
            $(this).val('chek');
            $("#image_form").css("display", "block");
            $(".more_options").css("display", "none");
            $('#more_btn').removeClass('active_more');
            $('#more_btn').val("unchek");
            $('#img_email').val($('#hidden_email').val());
            
        }else {
            $(this).val("unchek");
            $("#image_form").css("display", "none");
            $(".more_options").css("display", "none");
            $('#more_btn').removeClass('active_more'); 
            $('#more_btn').val("unchek");
        }
 });

$('#image_form').submit(function(event){
  event.preventDefault();

    var image_name = $('#image').val();
    var name = $('#name').val(); 

  if(image_name == '')
  {
   alert("Please Select Image");
   return false;
  }
  else
  {
   var extension = $('#image').val().split('.').pop().toLowerCase();
   if(jQuery.inArray(extension, ['png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File");
    $('#image').val('');
    return false;
   }
   else
   {
    $.ajax({
     url:"actions/serverMessinger.php",
     method:"POST",
     data:new FormData(this),
     contentType:false,
     processData:false,
     success:function(data)
     {  
        fetch_header_Chat();
            $('#promeni_sliku').val("unchek");
            $("#image_form").css("display", "none");
            $(".more_options").css("display", "none");
     }
    });
   }
  }
 });



    /*! Fun - fetch Chat left header | */ 
    function fetch_header_Chat()
        {
            var action = "Header_Chat";
            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action},
                success:function(data)
                {   
                    
                    $('#header_Chat').html(data);

                } 
          });
        }

    var rs_inet = 1;     
    /*! Fun - fetch Chats | */
    function load_Chats()
        {   
            var action = "load_Chats";   

            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action, startChat:startChat},
                success:function(data)
                {  
                    if (data > startChat) {
                    startChat = data;
                    var rs_startt = 1;
                    fetch_Chats(rs_startt);
                    
                    } 
                       
                } 
            });        
        }
    var rs_timer = 1;
    var rs_Seen = 1;
    function fetch_Chats(rs_startt)
        {   
            
            var action = "Chats";
            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action, start:start, rs_startt:rs_startt},
                success:function(data)
                {    
                    if (data.msg) {
                        
                        start = data.id[0];
                        msg = data.msg;
                        for (var i = 0; i < msg.length; i++) {
                        $('#chats').prepend(filterLastMessage(msg[i]));
                        }  
                        chats_timer();
                        receive_seen();  
                    } 
                } 
            });

            if (rs_timer == 1) {
                var fetch_Chats_rs = setInterval(function(){
                    chats_timer(); 
                }, 5000);
                rs_timer = 0;
            }
            if (rs_Seen == 1) {
                var fetch_Chats_rs = setInterval(function(){
                    receive_seen(); 
                }, 1000);
                rs_Seen = 0;
            }
        }
        function filterLastMessage(msg) {
                var msg = msg;
                var chat_id = msg.chat_id;
                
                if (!readCookie(chat_id)) {
                   var secret = CryptoJSAesDecrypt(readCookie('secreetJs'), msg.secret);
                   document.cookie = chat_id +"="+ secret; 
                }else{
                    secret = readCookie(chat_id);
                }
                
                var profile = msg.profile;
                var username = msg.username;
                var timee = msg.timee;
                
                var update = msg.update;
                var seen = msg.seen;
                
                var email = msg.email;
                var sender = msg.sender;
                var receive = msg.receive;
                var receiver = msg.receiver;
                var typee = msg.typee;
                if (update == 'y') {
                    if (typee == 'text') {
                        var lastmsg = msg.lastmsg; 
                        var lastmsg = decrypt_(lastmsg, secret);
                        var lastmsg = lastmsg.toString(CryptoJS.enc.Utf8);
                        var lastmsg = lastmsg.replace(/[^a-zA-Z0-9-.,/():;?!"' ]/g, " ");
                    }
                }else if (update == 'n') {
                    var lastmsg = msg.lastmsg;
                }
                if (lastmsg == 'dfdsffwe243fv45h56h45t3b5th56btyh65yh5n56h5') {

                }else{
                    if (lastmsg.length > 17){
                                var lastmsg = lastmsg.substr(0, 17)+'...';
                    }

                    
                        var returnme =`<button class="chats_li no_outline chats_li_style" id="${chat_id}"><div class="chats_li_name left"><img src="${profile}"><input class= "chats_name no_outline pointer disable-select" type= "text" name= "chats_name" value= "${username}" readonly><span class= "chats_msg">${lastmsg}&middot;<span class= "hidden_time" id= "${timee}" style= "margin-bottom: -3px;"></span></span></div><span class= "seen">${seen}</span></button>`;
                
                        new_msg_chats(chat_id);
                        return returnme; 
                }
               

        }


        function new_msg_chats(id){

            $(".chats_li").each(function(){
                var this_id =  $(this).attr("id");
                if (this_id == id) {

                    $(this).remove();
                }

            });

     
        }

        function chats_timer() {
            
            $(".hidden_time").each(function(){
                var curent = Date.now();
                var curent = curent / 1000;
                var timee =  $(this).attr("id");
                var tt = curent - timee;
                if (tt < 60) {
                    var timee = parseInt(tt) + "s";
                }else if (tt < 3600) {
                    var timee = parseInt(tt / 60) + "m";
                }else if (tt < 86400) {
                    var timee = parseInt(tt / 3600) + "h";
                }else if (tt < 604800) {
                    var timee = parseInt(tt / 86400) + "day";
                }else if (tt > 604800) {
                    var timee = parseInt(tt / 604800) + "week";
                }
                $(this).text(timee);
            });

        }

        function receive_seen(){

            var action = "receive_seen";
            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action, startSeen:startSeen},
                success:function(data)
                {       
                        if (data.id) {
                        startSeen = data.id[0];

                        var seen_receive = data.seen_receive;
                        
                        if (seen_receive !== undefined) {
                            for (var i = 0; i < seen_receive.length; i++) {
                                
                                seenReceive(seen_receive[i]);
                            
                            }  
                        }                         
                    } 
                } 
            });
        }

        function seenReceive(seen_receive) {

            var chat_id = seen_receive.chat_id;
            var sender = seen_receive.sender;
            var receiver = seen_receive.receiver;

            var receive = seen_receive.receive;
            var seen = seen_receive.seen;
            var sender = seen_receive.sender;
            var email = $('#hidden_email').val();
            
                if (sender == email) {

                    if (receive == 'n') {

                       var seen = '<img src="img/notR.png">';

                    }else if (receive == 'y') {

                        if (seen == 'n') {

                           var seen = '<img src="img/notS.png">';

                        }else if (seen == 'y') {

                            var img =  $('#'+chat_id).children('.chats_li_name').children('img').attr('src');
                            var seen = `<img src="${img}">`; 
                        }
                    }
                }else if (receiver == email) {

                    if (seen == 'n') {

                        var seen = '<img src="img/newMsg.png">'; 

                    }else if (seen == 'y') {

                        var seen = '';
                    }  
                }
                $('#'+chat_id).children('.seen').html(seen);

        }
    /*! Fun - fetch Chat new Person | */
        function fetch_Chats_new()
        {
            var action = "Chats_new";
            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action},
                success:function(data)
                {  
                    if (data == '1') {
                        rs_startt = 0;
                        fetch_Chats(rs_startt);
                    }
                } 
             });
        }
var rsInett = 1;
    /*! Fun - Send msg with Enter | */



    /*! Fun - fetch Chat tab Header | */   


        function active_chat(){

                var chat_id = $('#chat_id').val();
                $('.chats_li').each(function() {
                    if ($(this).attr("id") != chat_id) {
                        $('#'+$(this).attr("id")).removeClass('chats_li_active');
                    }
                });

                $('#'+chat_id).addClass('chats_li_active');
                var view_seen = $('#'+chat_id).children('.seen').children('img').attr('src');
                $('#view_seen_img').attr('src', view_seen);
        }


    /*! Fun - fetch msg | */
var start_message = 0;
    /*! Fun - Echo msg on page| */ 
        function messages(RsStart)
        {   
            var RsStart = RsStart;
            var secret = readCookie('secret');
            if (RsStart == 1) {
                $('#message_view').empty();
            }
            
            
            var action = "messages";
            var chat_id = $('#chat_id').val();
           
            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action, chat_id:chat_id, start_message:start_message, RsStart:RsStart},
                success:function(data)
                {      
                       
                    if (data.items) {
                            data.items.forEach(item =>{
                            start_message = data.myid;
                            
                            $('#message_view').append(filterMessage(item));
                            $('.message_view').scrollTop($('.message_view')[0].scrollHeight);
                            
                        });
                    };
                } 
            });
            if (rsInett == 1) {
                    var messages_RS = setInterval(function(){ 
                    var RsStart = 0;
                    messages(RsStart);
                }, 500);
                rsInett = 0;
            }
        }

        function filterMessage(item) {

            var secret = $('#secret').val();
            var email = $('#hidden_email').val();
            var profile = item.profile;
            var typee = item.typee;

            if (typee == 'text') {

                var message = item.message;
                var message = decrypt_(message, secret);
                var message = message.toString(CryptoJS.enc.Utf8);
                var message = message.replace(/[^a-zA-Z0-9-.,/():;?!"' ]/g, " ");
                var msg_lr = "";

                if (email == item.user) {var msg_lr = "msg_right";}else{var msg_lr = "msg_left";}
                return `<div class="single_message ${msg_lr}"><img src="${profile}"><div class="message_holder" style="max-width: 70%; overflow-wrap: break-word;"><span style="max-width: 100%;">${message}</span></div></div>`;
            
            }else if (typee == 'image') {

                var message = item.message;

                var msg_lr = "";
                if (email == item.user) {var msg_lr = "msg_right";}else{var msg_lr = "msg_left";}
                
                return `<div class="single_message ${msg_lr}"><img src="${profile}"><div class="message_holder" style="max-width: 70%; overflow-wrap: break-word;"><span style="max-width: 100%;"><img class="show_msg_img" src= "${message}"/></span></div></div>`;
            }else if (typee == 'voice') {

                var message = item.message;

                var msg_lr = "";
                if (email == item.user) {var msg_lr = "msg_right";}else{var msg_lr = "msg_left";}
                
                return `<div class="single_message ${msg_lr}"><img src="${profile}"><span style="max-width: 100%;"><audio controls style="max-width: 215px;"><source src="${message}" type="audio/wav"></audio></span></div>`;
            }
            

        }

        function call_msg_update() {
            action = "call_msg_update";

            $.ajax({
                url:"actions/serverMessinger.php",
                method: "POST",
                data:{action:action},
                success:function(data)
                { 
                    
                }   
            });  
        }

    /*! Fun - Send msg with Enter | */
    $('#msg_input').keyup(function(e){
            seen_new();
            if(e.which == 13){
               send_msg();
            }    
    
    });
    $(document).on('click', '.chat_btn_send', function(){
        
            send_msg();
    });

    $(document).on('click', '#message_view', function(){
            
            seen_new();
    });
    $(document).on('click', '#msg_input', function(){
           
            seen_new();
    });

    function seen_new() {
        var chat_id = $('#chat_id').val();
        var action = "seen_new";

        $.ajax({
            url:"actions/serverMessinger.php",
            method: "POST",
            data:{action:action, chat_id:chat_id},
            success:function(data)
            { 

            }   
                }); 
    }


    /*! Fun - Submit form thue ajax | */
    function send_msg(){

    var secret = $('#secret').val();
    var user_email = $('#user_email').val();
    var chat_id = $('#chat_id').val();
    var action = "send_msg";
    var typee = "text";
   
        if ( !$.trim($("#msg_input").val()) ) {

             return false;
        
        }else{ 
            var message = $('#msg_input').val(); 
            var message = message.replace(/[^a-zA-Z0-9-.,/():;?!"' ]/g, "");
            var message = encrypt_(message, secret);
            $.ajax({
            url:"actions/serverMessinger.php",
            method: "POST",
            data:{action:action, message:message, chat_id:chat_id, user_email:user_email, typee:typee},
            success:function(data)
            { 

            }   
                });  
            document.getElementById('msg_input').value = '';
        }         
 }


/*! calling fun | */ 
load_Chats();
fetch_header_Chat();
fetch_Chats_new();

/*! interval calling fun 0.5s| */ 
setInterval(function(){ 
    ifwrite();
}, 500);
/*! interval calling fun 1s| */
setInterval(function(){ 
    load_Chats();
}, 1000);
/*! interval calling fun 30s| */
setInterval(function(){ 
    fetch_Chats_new();
}, 10000);

});