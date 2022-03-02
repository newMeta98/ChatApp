/*! CUSTOM CHAT JS | */
$(document).ready(function(){
var modalButton = document.getElementById("chat_button");
var modalButtonTab = document.getElementById("chat_tab_button");
var modalChat = document.getElementById("chat_content");
var modalChatTab = document.getElementById("chat_tab_content");

modalButton.onclick = function() {
  modalChat.classList.toggle("OpenChat");;
  modalButton.classList.toggle("OpenChatButton");
}
/*! Fun Displaing Open Tab| */ 
modalButtonTab.onclick = function openTab() {
    modalChatTab.classList.toggle("OpenTab");
    modalButtonTab.classList.toggle("OpenTabButton");
    document.getElementsByClassName("chat_tab_input")[0].focus();
    fetchMsg_view();
    Count();
}  
/*! calling fun | */ 
    fetch_dataChat();
    fetchButton_content();

/*! interval calling fun 0.5s| */ 
    setInterval(function(){
    fetch_dataChat();
    fetchMessage();
      }, 500);
    /*! Fun - fetch Messsages | */ 
    function fetchMessage(){
        var chat_tab_id = $('#chat_tab_id').val();
            var action = "fetchChat_tab";
            $.ajax({
                url:"users/serverChat.php",
                method: "POST",
                data:{action:action, chat_tab_id:chat_tab_id},
                success:function(data)
                {  
                    $('#msg_view').html(data);
                }
                    });
    }
    /*! Fun - Count messages - Scroll to Bottom | */ 
    var msg_num;
    msg_num = 1;
    function Count(){
       
        var div = document.getElementById("message_view");
        var nodelist = div.getElementsByTagName("span").length;
         if (msg_num < nodelist){
        $('#message_display').animate({scrollTop: $('#message_display') [0].scrollHeight});
        msg_num = nodelist;}
        var div = document.getElementById("message_view");
        var nodelist = div.getElementsByTagName("span").length;
        if (msg_num < nodelist){
            $('#message_display').animate({scrollTop: $('#message_display') [0].scrollHeight});
        }   
    }
    /*! Fun - Display messages in chat Tab | */ 
    function fetchMsg_view()
            { 
            $('#message_display').html($('#msg_view'));
            $('#message_display').animate({scrollTop: $('#message_display') [0].scrollHeight});
                setInterval(function(){
                Count();
                 }, 500);
            }
    /*! Fun - fetch Chat Tab button content | */ 
    function fetchButton_content()
        {
            var action = "fetchButton_content";
            var chat_tab_id = $('#chat_tab_id').val();
            $.ajax({
                url:"users/serverChat.php",
                method: "POST",
                data:{action:action, chat_tab_id:chat_tab_id},
                success:function(data)
                {
                    $('#Tab_button_content').html(data);
                } 
          });
        }
    /*! Fun - fetch Chat Button content | */ 
    function fetch_dataChatButton()
        {
            
            var action = "fetchChatButton";
            $.ajax({
                url:"users/serverChat.php",
                method: "POST",
                data:{action:action},
                success:function(data)
                {
                    $('#Chat_button_content').html(data);
                } 
          });
        }
    /*! Fun - fetch Chat content | */ 
    function fetch_dataChat()
        {
            var action = "fetchChat";
            $.ajax({
                url:"users/serverChat.php",
                method: "POST",
                data:{action:action},
                success:function(data)
                {
                    $('#chat_content').html(data);
                } 
          });
        }
    /*! Fun - Open Chat Tab | */
$(document).on('click', '.chat', function(){
   $('#chat_tab_id').val($(this).attr("id"));
   var chat_tab = document.getElementById("chat_tab");
    chat_tab.style.display = "block";
    fetchMsg_view();
 });
    /*! Fun - Send msg with Enter | */
    $('.chat_tab_input').keyup(function(e){
            if(e.which == 13){
                $('#tab_form').submit();
            }    
    });

    /*! Fun - Submit form thue ajax | */
 $('#tab_form').submit(function(event){
    event.preventDefault();
    var message = $('.chat_tab_input').val();
    var action = "sendMessage";
    var chat_tab_id = $('#chat_tab_id').val();
        if ( message == '') {
        
            return false;
        
        }else{    
                $.ajax({
                url:"users/serverChat.php",
                method: "POST",
                data:{action:action, message:message, chat_tab_id:chat_tab_id},
                success:function(data)
                {
                    fetchMsg_view();
                }   
                    });  
                document.getElementById('tab_form').reset();
            }         
 });

$(document).on('click', '#closeTab', function(){
   var chat_tab = document.getElementById("chat_tab");
    chat_tab.style.display = "none";
});

});