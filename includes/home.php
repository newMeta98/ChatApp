<div class="wrap_flex">
    <aside class="aside_l left disable-select">

            <header class="header_l">
                <div class="box left" id="header_Chat">
                    
                    <h4>Chats</h4>
                </div>

                <div class="box right">

                    <button class="btn dropdown no_outline" id="more_btn" value="unchek"><img src="img/more.png"></button>
                        <div class="more_options">
                            <button class="options_li" id="promeni_sliku" value="unchek">Promeni sliku</button>
                            <button class="options_li" onclick="logOut()">Odjavi se</button>
                        </div>
                    <button class="btn new_msg no_outline"><img src="img/newmessage2.png"></button>
                
                </div>

                <form id="image_form" method="post" enctype="multipart/form-data">
                     <p><label>Izaberi Sliku</label>
                     <input type="file" name="image" id="image" placeholder="odaberi sliku" /></p>
                     <input type="hidden" name="action" id="action" value="upload_profileImg" />
                     <input type="hidden" name="img_email" id="img_email" value="" />
                     <input type="submit" class="upload_btn" name="insert" id="insert" value="Promeni sliku" />
                </form>

                <div class="search">

                    <span><img src="img/search.webp"></span>
                    <input class="no_outline" id="search" type="text" name="search" placeholder="Search Messinger" autocomplete="off">                    
                </div>
            </header>
            <div class="chats" id="chats_new">
                    
            </div>
            <div class="chats" id="chats">

            </div>
        </aside>

        <main id="main_flex">

            <header class="header_m disable-select">
                <div class="arow_back"> <button class="arow_back_btn" value="unchek"><img src="img/left.png"></button> </div>
                <div class="box left" id="chat_tab_header">
                    
                </div>

                <div class="box right header_m_right">
                   
                    <button class="btn info no_outline" id="info" onclick="this.classList.toggle('active')" value="unchek"><img src="img/info.png"></button>                    
                </div>
            </header>  
            <div class="main_chat" id="main_chat">
                <div class="message_view" id="message_view">

                </div>
                <span id="view_seen"><img id="view_seen_img" src=""></span>
            </div>

            <div class="main_chat_send" id="main_chat_send">

                <div class="wrap_flex1" style="transition: all 0.5s ease, transform 0.3s;">

                </div>


                <div class="wrap_flex2" style="transition: all 0.5s linear;">
                    <div class="chat_input">
                        
                        
                        <textarea class="no_outline" id="msg_input" value="" maxlength="2000"></textarea>
                        <div class="wrap_flex6">
                       
                        </div>
                    </div>
                </div>
                <div id="listObjs"></div>
                <div class="wrap_flex3">

                <button class="chat_btn_like right no_outline" style="transition: all 2s ease 2s;"><img src="img/like.png"></button>
                <button class="chat_btn_send right no_outline" style="transition: all 2s ease 2s;"><img src="img/send.png"><input type="hidden" name="secret" id="secret" value=""><input type="hidden" name="start_send" id="start_send" value=""></button>
                </div>
            </div>
        </main>
        <aside class="aside_r right">
                <div class="arow_back"> <button class="arow_back_btn" value="unchek"><img src="img/left.png"></button> </div>
                <div id="right_info">
                    <img src="">
                    <h2></h2>                    
                </div> 

            <div class="info_btns_wrap"> 

            </div>

        </aside>
</div>