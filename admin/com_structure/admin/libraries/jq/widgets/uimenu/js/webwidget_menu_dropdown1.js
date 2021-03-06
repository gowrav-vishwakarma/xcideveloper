(function(a){
    a.fn.webwidget_menu_dropdown=function(p){
        var p=p||{};
        var m_t_c=p&&p.m_t_c?p.m_t_c:"blue";
        var m_b_s=p&&p.m_b_s?p.m_b_s:"1px";
        var m_bg_c=p&&p.m_bg_c?p.m_bg_c:"#FFF";
        var m_w = p&&p.m_w?p.m_w:"100px";
        var m_bg_h_c=p&&p.m_bg_h_c?p.m_bg_h_c:"red";
        var m_c_c=p&&p.m_c_c?p.m_c_c:"red";
        var m_s=p&&p.m_s?p.m_s:"medium";
        var s_s=p&&p.s_s?p.s_s:"fast";
        var dom = a(this);
        if(dom.children("ul").length==0||dom.children("ul").children("li").length==0){
            dom.append("Require menu content");
            return null;
        }
        s_m_b(dom.children("ul").children("li"),dom.find("li"),m_b_s,m_bg_c,m_w,m_c_c);
        s_m_t_c(dom.find("a"),m_t_c);
        s_m_s(dom,m_s);
        dom.children("ul").children("li").hover(
            function () {
                if(s_s == 'no-wait'){
                    $(this).children("ul").show();
                }else{
                    $(this).children("ul").slideDown(s_s);
                }
                
            },
            function () {
                if(s_s == 'no-wait'){
                    $(this).children("ul").hide();
                }else{
                    $(this).children("ul").slideUp(s_s);
                }
            }
        );
        dom.children("ul").children("li").children("ul").children("li").hover(
            function () {
                $(this).css("background-color",m_bg_h_c);
            },
            function () {
                $(this).css("background-color",m_bg_c);
            }
        );
        function s_m_s(a,m_s){
            switch(m_s){
                case 'large':
                    menu_height = '40px';
                    sub_menu_height = '30px';
                    font_size = '16px';
                    a_padding = '10px';
                    break;
                case 'medium':
                    sub_menu_height = '25px';
                    font_size = '13px';
                    menu_height = '30px';
                    a_padding = '5px';
                    break;
                case 'small':
                    sub_menu_height = '20px';
                    font_size = '12px';
                    menu_height = '20px';
                    a_padding = '2px';
                    break;
                default:
                    sub_menu_height = '25px';
                    font_size = '13px';
                    menu_height = '35px';
                    a_padding = '10px';
            }
            dom.children("ul").css("font-size",font_size);
            dom.children("ul").children("li").css("height",menu_height);
            dom.children("ul").children("li").children("a").css("line-height",menu_height);
            dom.children("ul").children("li").children("a").css("padding",a_padding);
            dom.children("ul").children("li").children("ul").css("top",menu_height);
            dom.children("ul").children("li").children("ul").css("left","0px");
            dom.children("ul").children("li").children("ul").children("li").children("a").css("line-height",sub_menu_height);
        }
        function s_m_t_c(dom,m_t_c){
            dom.css("color",m_t_c);
        }
        function s_m_b(dom,li_dom,m_b_s,m_bg_c,m_w,m_bg_h_c){
            style = "background-color:"+m_bg_c+"; margin-left: "+m_b_s+"; width: "+m_w+";";
            dom.attr("style",style);
            dom.filter(".current").css("background-color",m_bg_h_c);
            style1 = "background-color:"+m_bg_c+"; width: "+m_w+";";
            li_dom.children("ul").attr("style",style1);
        }
    };
})(jQuery);