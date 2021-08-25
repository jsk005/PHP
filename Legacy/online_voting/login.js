$(document).ready(function(){
   $("#registerForm").submit(function(){
       var name = $("input[name=name]").val();
       var email = $("input[name=email]").val();
       var voter_id = $("input[name=voter_id]").val();
       var password = $("input[name=password]").val();
       var repassword = $("input[name=repassword]").val();
       if(name ==""){
          alert('이름을 입력하세요');
          $("input[name=name]").focus();
          return false;
       }
       if(email ==""){
          alert('이메일을 입력하세요');
          $("input[name=email]").focus();
          return false;
       } 
       if(voter_id ==""){
          alert('voter_id 입력하세요');
          $("input[name=voter_id]").focus();
          return false;
       } 
       if(password ==""){
          alert('패스워드를 입력하세요');
          $("input[name=password]").focus();
          return false;
       } 
       if(repassword ==""){
          alert('패스워드 확인을 입력하세요');
          $("input[name=repassword]").focus();
          return false;
       } 
       if(password != repassword){
          alert('패스워드를 똑같이 입력하세요');
          return false; 
       }  
   }); 
   
   $("#loginForm").submit(function(){
       var email = $("input[name=myusername]").val();
       var password = $("input[name=mypassword]").val();
       if(email ==""){
          alert('이메일을 입력하세요');
          $("input[name=myusername]").focus();
          return false;
       } 
       if(password ==""){
          alert('패스워드를 입력하세요');
          $("input[name=mypassword]").focus();
          return false;
       } 
   });
   
   $("#updateProfile").submit(function(){
       var name = $("input[name=name]").val();
       var email = $("input[name=email]").val();
       var voter_id = $("input[name=voter_id]").val();
       var password = $("input[name=password]").val();
       var repassword = $("input[name=repassword]").val();
       if(name ==""){
          alert('이름을 입력하세요');
          $("input[name=name]").focus();
          return false;
       }
       if(email ==""){
          alert('이메일을 입력하세요');
          $("input[name=email]").focus();
          return false;
       } 
       if(voter_id ==""){
          alert('voter_id 입력하세요');
          $("input[name=voter_id]").focus();
          return false;
       } 
       if(password ==""){
          alert('패스워드를 입력하세요');
          $("input[name=password]").focus();
          return false;
       } 
       if(repassword ==""){
          alert('패스워드 확인을 입력하세요');
          $("input[name=repassword]").focus();
          return false;
       } 
       if(password != repassword){
          alert('패스워드를 똑같이 입력하세요');
          return false; 
       }  
   }); 
      
});    
