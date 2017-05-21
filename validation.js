
 $(function(){
   $("#form-test").on("submit",function(){
     nome_input = $("input[name='name']");
     email_input = $("input[name'email']");
     if(nome_input.val() == "" || nome_input.val() == null)
     {

       $("#nome").addClass("has-error");
       return(false);
     }
     if(email_input.val() == "" || email_input.val() == null){
       $("#nome").addClass("has-error");
       return(false);
     }
     return(true);
   });
 });
