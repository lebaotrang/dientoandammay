<%@ Master Language="C#" AutoEventWireup="true" CodeFile="MasterPage.master.cs" Inherits="MasterPage" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Trang chủ</title>
    <link href="App_Themes/css.css" rel="stylesheet" />
    <!------->
    <link rel="stylesheet" href="js/jquery-ui.css" />
    <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery-ui.js"></script>
    
    <!------>
  
</head>
<body>
    <div id="background_top">       
    </div>
    <div id="background_banner">
        <div id="center">
            <div id="head">
                <div id="banner">
                    <img src="../Images/Banner.gif" />
                </div>
            </div>
        </div>
    </div>
    <div id="background_main">
        <div id="center">
            <div >
                <font id="time"> </font>
                <font id="link"> WEB LIÊN KẾT: 
                    <select id="link_web">
                        <option value="">--Danh sách website--</option>
                        <option value="http://bvdkkiengiang.vn/"> Bệnh viện đa khoa Kiên Giang </option>
                        <option value="http://bvbinhan.com.vn/ver/index.php"> Bệnh viện Binh An Kiên Giang</option>
                    </select>
                     <input type="button" value="Go" onclick="go_web_link()" /> </font>
                <div class="clear"></div>
            </div>
            <div id="menu">
                <asp:ContentPlaceHolder ID="menu" runat="server">

                </asp:ContentPlaceHolder>
            

                <div class="clear"></div>
            </div>
            <div id="main_line"> </div>
            <div id="main">
                <div id="left">
                       <div>
                            <form id="login" method="post" action="login.aspx">
                                <table cellspacing="10">
                               
                                        <tr><th><% Response.Write("Tài khoản:" + Session["user"]); %></th></tr>
                                        <tr><td><input type="button"value="Đăng xuất"  onclick="return dangxuat()" onserverclick="btn_dangxuat_click" /> </td></ tr >

                                    <tr><th>Đăng nhập</th></tr>
                                    <tr> <td> <input type="text" placeholder="Tài khoản" id="txt_taikhoan" name="txt_taikhoan"  value="" /> </td></tr>
                                    <tr> <td> <input type="password" placeholder="Mật khấu" id="txt_matkhau" name="txt_matkhau" value="" /> </td></tr>
                                    <tr> <td> <input type="submit" value="Đăng nhập" id="btn_dangnhap" onclick="return kiemtra()"  /> </td></tr>
                                </table>
                            </form>
                        </div>
                    <asp:ContentPlaceHolder ID="serch" runat="server">

                    </asp:ContentPlaceHolder>
                    
<script>
    $(function() {
        $("#tu_ngay_kham").datepicker({
            dateFormat: 'dd-mm-yy'
        });
        $("#den_ngay_kham").datepicker({
            dateFormat: 'dd-mm-yy'});
        });
</script>
                    <div id="search_key">
                        <% if (Request.FilePath == "/index.aspx")
                            { %>
                        <form method="post" action="page/timkiem.aspx" >
                            <% }
                            else
                            { %>
                        <form method="post" action="timkiem.aspx" >
                            <%} %>
                            <table cellspacing="10" ">
                                <tr> <th> Tra Cứu Kết Quả khám</th></tr>
                                <tr> <td> Theo tên:</td></tr>
                                <tr> <td> <input type="text" name="name_search" placeholder="Họ tên bệnh nhân" /></td></tr>
                                <tr> <td> Theo ngày:</td></tr>
                                <tr> <td> <input type="text" name="date_from_search" id="tu_ngay_kham" placeholder="Từ ngày" /></td></tr>
                                <tr> <td> <input type="text" name="date_to_search" id="den_ngay_kham" placeholder="Đến ngày" /></td></tr>
                                <tr> <td> <input type="submit" value="Tìm kiếm" /></td></tr>
                            </table>
                       </form>
                    </div>
                    <div id="search_key">
                        <% if (Request.FilePath == "/index.aspx")
                            { %>
                        <form method="post" action="page/timkiem.aspx" >
                            <% }
                            else
                            { %>
                        <form method="post" action="timkiem.aspx" >
                            <%} %>
                            <table cellspacing="10" ">
                                <tr> <th> Tra Cứu Dịch Vụ Y Tế</th></tr>
                                <tr> <td> <input type="text" name="name_dv_search" placeholder="Tên dịch vụ" /></td></tr>
                                <tr> <td> <input type="submit" value="Tìm kiếm" /></td></tr>
                            </table>
                       </form>
                    </div>
                </div>
                <div id="right">
                    <marquee id="logo">Để công tác khám chữa bệnh được tốt hơn bệnh viện không ngừng đào tạo nâng cao tay nghề cho bác sỹ, mua thêm các trang thiết bị tiên tiến
                        để nâng cao chất lượng khám và điều trị bệnh cho bệnh nhân với phương châm đặt sức khỏe người bệnh lên hàng đầu!
                    </marquee>
                    <asp:ContentPlaceHolder ID ="content" runat="server"> 

                    </asp:ContentPlaceHolder>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div id="footer">
        </div>
    </div>
    <div id="bottom"></div>
</body>
    
    <script type="text/javascript"> function refrClock() {

var d=new Date();

var s=d.getSeconds();

var m=d.getMinutes();

var h=d.getHours();

var day=d.getDay();

var date=d.getDate();

var month=d.getMonth();

var year=d.getFullYear();

var days=new Array("Chủ nhật","Thứ hai","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7");

var months=new Array("1","2","3","4","5","6","7","8","9","10","11","12"); var am_pm;

if (s<10) {s="0" + s}

if (m<10) {m="0" + m}

if (h>12)

{h-=12;AM_PM = "PM"}

else {AM_PM="AM"}

if (h<10) {h="0" + h}

document.getElementById("time").innerHTML = days[day] + " Ngày " + date + "/" + months[month] + "/" + year + " Bây giờ là " + " [" + h + ":" + m + ":" + s + "] " + AM_PM; setTimeout("refrClock()", 1000);
} refrClock(); </script>

<script>

function go_web_link()
{
    window.location.assign(document.getElementById("link_web").value);
}
function kiemtra()
{
    if (document.getElementById("txt_taikhoan").value == "") {
        alert("Tài khoản không được để trống!");
        return false;
    }
    else if (document.getElementById("txt_matkhau").value == "") {
        alert("Mật khẩu không được để trống!");
        return false;
    }
    else
        return true;
}

function dangxuat()
{
    kt = confirm("Bạn muốn đăng xuất");
    if (kt) {
        var url = window.location.href;
        if(url.search("page"))
            window.location = "../logout.aspx";
        else
            window.location = "logout.aspx";
        return true;
    }
    else return false;
}

</script>
</html>

