$(function(){

	$(".delete").click(function() {
		$(".delete").attr("disabled", true);
    	$.ajax({
		    type:'POST',
		    url:'deleteUser.php',
		    data: { 'userId' : $(this).attr('userId')},
		    success: function(data){
		        $(".delete").attr("disabled", false);
		        console.log(data);
		        window.location.reload();
		        return false;
		    },
		    error: function (error) {
		    	$(".delete").attr("disabled", false);
		    	alert(data);
		    }
		});
    });
});