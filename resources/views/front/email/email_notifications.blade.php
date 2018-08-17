<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Coach Availability Notification</title>
      <link href="css/event-connect-usa.css" rel="stylesheet" type="text/css" />
      <style type="text/css">
       .listed-btn a {
    border: 1px solid #fc575c;
    color: #fc575c;
    display: block;
    font-size: 15px;
    letter-spacing: 0.4px;
    margin: 0 auto;
    max-width: 204px;
    padding: 9px 4px; height: initial;
    text-align: center;
    text-transform: uppercase;
    width: 100%;
}
       </style>
   </head>
   <body style="background:#f1f1f1; margin:0px; padding:0px; font-size:12px; font-family:'ubunturegular', sans-serif; line-height:21px; color:#666; text-align:justify;">
         <?php $usertamlate = DB::table('tbl_emailtemplate') ->where(['mailcategory'=>5])->where(['is_active'=>1])->get();		?>
      <div style="max-width:630px;width:100%;margin:0 auto;">
        <div style="padding:0px 15px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
         <tr>
            <td>&nbsp;</td>
         </tr>
         <tr>
            <td bgcolor="#FFFFFF" style="border:1px solid #e5e5e5;">
               <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr >
                     <td style="background-image: url('{{url('/')}}/images/emailer-bg.jpg');background-size: cover;background-position: center top;background-repeat: no-repeat;    color: #333;    font-size: 15px;    padding: 70px 25px;    text-align: center;">
                        <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                              <td style="text-align:center;"><a href="#"><img src="{{url('/')}}/images/logo.png"  alt="logo" style="width: 186px;"/></a></td>
                              
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td height="20"></td>
                  </tr>
                  <tr><td style="color: rgb(51, 51, 51); text-align: center; font-family: ubuntumedium; font-size: 19px; line-height: 35px; padding-top: 3px;">Welcome To {{config('app.project.name')}}</td></tr>
                  <tr><td style="color: #333333;font-size: 15px;padding-top: 3px;text-align: center; font-family: robotomedium;">{{$usertamlate[0]->subject}}</td></tr>
                  
                  <tr>
                     <td height="40"></td>
                  </tr>
                  <tr>
                     <td style="color: #333333; font-size: 16px; padding: 0 30px;">
                 
                 
                   
                   <?php
                   
                 
                   $lname="";
                   $emails="";
                   $emails="";
                   $user_name="";
                   $password="";
                   
                   
                   $bodycontent=$usertamlate[0]->bodytext;
                   
                   $bodycontent=str_replace('%first_name%',$name,$bodycontent);
                    $bodycontent=str_replace('%last_name%',$lname,$bodycontent);
                     $bodycontent=str_replace('%email%',$emails,$bodycontent);
                     $bodycontent=str_replace('%user_name%',$user_name,$bodycontent);
                       $bodycontent=str_replace('%password%',$password,$bodycontent);
                   
                  echo  html_entity_decode($bodycontent);?>
                   
                   
                   
                  <br><a href="{{$booking_link}}">Book Now</a>
                     </td>
                  </tr>
               
               <tr>
                     <td height="20"></td>
                  </tr>
                  
                  <tr>
                  </tr>
                  <tr>
                     <td height="40"></td>
                  </tr>
               <tr>
                     <td style="color: #333333; font-size: 16px; padding: 0 30px;">
                   Thanks &amp; Regards,
                     </td>
                  </tr>
                  
               <tr>
                  <td style="color: #fc575c;  font-size: 15px; padding: 0 30px;">
                     THE {{config('app.project.name')}}
                  </td>
               </tr>
                  <tr>
                     <td>&nbsp;</td>
                  </tr>                                    
               <tr>
                  <td>
                     <table style="margin-bottom: 0;" width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                           <td style="font-family: 'robotomedium',sans-serif; font-size:13px;background: rgb(17, 18, 24) none repeat scroll 0% 0%; text-align: center; color: rgb(255, 255, 255); padding: 12px;">
                              Copyright &#169; {{date("Y")}} The {{config('app.project.name')}}. All Rights Reserved.
                           </td>
                           
                        </tr>
                     </table>
                  </td>                 
               </tr>
            </table>
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
         </tr>
      </table>
        </div>      
      </div>       
   </body>
</html>

