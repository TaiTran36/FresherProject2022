
   <!DOCTYPE html>
   <html lang="en">
       <head>
           <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
           <!-- Meta, title, CSS, favicons, etc. -->
           <meta charset="utf-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <meta name="viewport" content="width=device-width, initial-scale=1">
   
           <!-- Custom Theme Style -->
           <link href="/css/admin_login.css" rel="stylesheet">

       </head>
   
       <body class="login">
           
   
               <div class="login-page">
                   <div class="form">
                       
                           <form id="login-form" method="POST" action="/admin/login">
                               @csrf
                               <h1>ADMIN LOGIN</h1>
                               <div>
                                   <input type="text" name="email" placeholder="Email" required="" />
                               </div>
                               <div>
                                   <input type="password" name="password" placeholder="Password" required="" />
                               </div>
                               <button>login</button>
                          </form>
                       
                   </div>
               </div>
           
           <script type="text/javascript" src="/js/admin_login.js" ></script>
       </body>
   </html>
   