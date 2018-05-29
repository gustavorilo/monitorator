$(document).ready(function() {
	$(".remove").click(function(){
	  
	  if (confirm('Confirma que desea eliminar el registro?')) {
		  var arr 	= this.id.split('_');
			var type  = arr[0];
			var id  	= arr[1];
			
			var formData = 'type=' + type + '&id=' + id;
			
			$.ajax({
				url: 'delete_register.php', 
				type: 'POST',
				data : formData,
				success: function(result){
      	  //console.log(result);
        }
      });
      location.reload();
	}
  });
  
  $(".change_state").click(function(){
	  
	  var arr 			= this.id.split('_');
		var type  		= arr[0];
		var id  			= arr[1];
		
		var nextState = ( $("#"+this.id+" i").hasClass('fa-hand-o-down') === true )  ? 1 : 0; 
		var formData 	= 'type=' + type + '&id=' + id + '&state=' + nextState;		
	  
	  $.ajax({
			url: 'change_state.php',
			type: 'POST',
			/*async: false,*/
			data : formData,
			success: function(){
                           if( nextState == 1 )  { 

                             $("#models_" + id + " i").removeClass('fa-hand-o-down'); 
                             $("#models_" + id + " i").addClass('fa-hand-o-up');
                           } else {  
                             $("#models_" + id + " i").removeClass('fa-hand-o-up');  
                             $("#models_" + id + " i").addClass('fa-hand-o-down');
                           }
      }
    });
    	});
  
  $(".header_main_search_btn").click(function() {
  	
  	search = $('.header_main_search_input').val();
  	$('#search').val(search);
  	
  	//Submit del form
  	$('#frmList').submit();
  });

  //Div dinámicos [function: cloneDiv]
  window.cDiv = 0;
	if( $('.mchilds').length > 0 ) { cDiv = $('.mchilds').length - 1; }
});

$("#user_edit_active").change(function() {
        console.log('entre');
	console.log($("#user_edit_active"));
});

/*
function restorePass() {

        if( $("#login_email_reset").val() == "" ) {
          alert('Por favor ingrese su email!');
        } else {
          $.ajax({
	        method: "POST",
	        url: "reset_pass.php",
		data: { pass : $("#login_email_reset").val() }
	  })
	  .done(function( result ) {

	  });
        }
}
*/

function addEntity() {
	if($("#entity").val() == "") { 
		$("#entity").addClass("md-input-danger");	
	} else {
		$("#entity").addClass("md-input-success");
	
		$.ajax({
		  method: "POST",
		  url: "add_entity.php",
		  data: { entity : $("#entity").val() }
		})
	  .done(function( entity_id ) {
	  	if(entity_id != 0) {
	  	  $("#modal_lightbox").attr("style", "display: none");
        location.reload();
	  	} else {
        alert('NO PUDO INSERTARSE EL REGISTRO, POSIBLEMENTE EL CIRCUITO YA EXISTA!');
      }
	  });
	}
}

function addCommandType() {
	if($("#command").val() == "") { 
		$("#command").addClass("md-input-danger");	
	} else {
		$("#command").addClass("md-input-success");
	
		$.ajax({
		  method: "POST",
		  url: "add_commandtype.php",
		  data: { command : $("#command").val() }
		})
	  .done(function( commandtype_id ) {
	  	if(commandtype_id != 0) {
	  	  $("#modal_lightbox").attr("style", "display: none");
        location.reload();
	  	} else {
        alert('NO PUDO INSERTARSE EL REGISTRO, POSIBLEMENTE EL CIRCUITO YA EXISTA!');
      }
	  });
	}
}

function editEntity() {
	
	if($("#entity").val() == "") {
		$("#entity").addClass("md-input-danger");	
	} else {
		$("#entity").addClass("md-input-success");
	}
	
	if($("#host").val() == "") {
		$("#host").addClass("md-input-danger");	
	} else {
		$("#host").addClass("md-input-success");
	}	
	if($("#state").val() == "") {
		$("#state").addClass("md-select-danger");	
	} else {
		$("#state").addClass("md-select-success");	
	}
	
	var errInput 	= $("body input.md-input-danger").length;
	var errSelect =	$("body select.md-input-danger").length;
	
	if( errInput == 0 && errSelect == 0 ) frmEditEntity.submit();
}

function editCommandType() {
	
	if($("#command").val() == "") {
		$("#command").addClass("md-input-danger");	
	} else {
		$("#command").addClass("md-input-success");
	}
	
	var errInput 	= $("body input.md-input-danger").length;
	var errSelect =	$("body select.md-input-danger").length;
	
	if( errInput == 0 && errSelect == 0 ) frmEditCommandType.submit();
}

function changeBrand() {
	
	$("#marca_sel").val($("#marca option:selected").text());
	loadBrand($("#marca").val(), 1);
	
	$("#categoria").empty(); 
	$("#categoria").append('<option value="">Seleccione una categoría...</option>');
	$("#categoria").attr("disabled", true);	
}

function changeModel() {

	var model_sel = ( $("#modelo").val() != 0 ) ? $("#modelo").val() : 0;
	var strPost   = 'model_id=' + model_sel;
	
	$.ajax({
		url: 'combo_categories.php',
		type: 'POST',
		data: strPost,
		success: function(result){

       $("#categoria").empty();
       $("#categoria").append(result);
       $("#categoria").attr("disabled", false);	
    }
  });
}

function addBrand() {
	if($("#marca").val() == "") { 
		$("#marca").addClass("md-input-danger");	
	} else {
		$("#marca").addClass("md-input-success");
	
		$.ajax({
		  method: "POST",
		  url: "add_brand.php",
		  data: { brand : $("#marca").val(), state: $("#estado").val() }
		})
	  .done(function( marca_id ) {
	  	if(marca_id != 0) {
	  	  $("#modal_lightbox").attr("style", "display: none");
        location.reload();
	  	} else {
      	alert('NO PUDO INSERTARSE EL REGISTRO, POSIBLEMENTE LA MARCA YA EXISTA!');
      }
	  });
	}
}

function addModel() {
	if($("#model").val() == "") { 
		$("#model").addClass("md-input-danger");	
	} else {
		$("#model").addClass("md-input-success");
		
		$.ajax({
		  method: "POST",
		  url: "add_model.php",
		  data: { model: $("#modelo").val(), generation: '', brand: $("#marca").val(), category: $("#categoria").val(), state: $("#estado").val() }
		})
	  .done(function( modelo_id ) {
	  	if(modelo_id != 0) {
	  		$("#modal_lightbox").attr("style", "display: none");
        location.reload();
	  	} else {
      	alert('NO PUDO INSERTARSE EL REGISTRO, POSIBLEMENTE EL MODELO YA EXISTA!');
      }
	  });
	}
}

function editModel() {
	
	err = new Array();
	
	if($("#model").val() == "") { 
		
		err.push('model');
		$("#model").addClass("md-input-danger");
		
	} else {
		
		removeItemArray(err, 'model');
		$("#model").addClass("md-input-success");
		var cantChilds = $('.mchilds').length;
		
		if( cantChilds > 0 )	{
			for(var mc=0; mc < cantChilds; mc++) {
	
				if( $('.mchild'+mc).val() == '' ) {
					$('.mchild'+mc).removeClass("md-input-success");
					$('.mchild'+mc).addClass("md-input-danger");
					err.push('mchild'+mc);
				} else {
					$('.mchild'+mc).removeClass("md-input-danger");
					$('.mchild'+mc).addClass("md-input-success");
					removeItemArray(err, 'mchild'+mc);
				}
			}
		}
	}
	
	if(err.length == 0) $("#frmEditModel").submit();
}

function cloneDiv() {
    
    var divId 	 = ++cDiv;
    var divClone = $("#modelGeneration").clone();
			  divClone.attr('id', 'modelGeneration'+divId);
			  divClone.children().children().attr('class', 'md-input mchilds child'+divId);
			  divClone.appendTo("#receptor");
    
    var h = divId;
    $('#modelGeneration'+(divId++)).append('<div align="right"><a href="javascript:void(0);" onclick="removeDiv(\'#modelGeneration'+h+'\');"><i class="md-icon material-icons fa fa-remove"></i></a></div>');
}

function removeDiv(divId) {
    $(divId).remove();
}

function removeItemArray(arr, item) {
	var i = arr.indexOf(item);
	if(i != -1) arr.splice(i, 1);
}

function deleteImage(imagePath, fileName) {
	
	var formData 	= 'src=' + imagePath;
            formData   += '&fileName=' + fileName;
	$.ajax({
		url: 'delete_image.php',
		type: 'POST',
		async: false,
		data : formData,
		success: function(){
  	           location.reload();  
                }
  });
}

function loadBrand(value, is_add=0) {

  var marca_sel  = 0;
  var strPost    = '';

	if(  $("#brand_name").val() != undefined )  $("#brand_name").val($("#marca option:selected").text());	

  if( value == -1 ) {
    marca_sel  = $("#marca_sel").val();
  } else {
    marca_sel  = $("#marca").val();
  }
  strPost += 'brand_id=' + marca_sel;
	
	$.ajax({
		url: 'combo_brands.php',
		type: 'POST',
		data: strPost,
		success: function(result){
      
      $("#marca").empty();
      $("#marca").append(result);

      var modelo_sel 	= ( $("#modelo_sel") ) ? $("#modelo_sel").val() : 0;
			var strPost   	= '&brand_id=' + marca_sel + '&model_id=' + modelo_sel;
			
			if( modelo_sel != 0 || is_add == 1 ) {
				
				if( is_add == 1 && marca_sel == 0 ) {
					
					$("#modelo").empty(); 
					$("#modelo").append('<option value="">Seleccione un modelo...</option>');
					$("#modelo").attr("disabled", true);	
				} else {
					$.ajax({
						url: 'combo_models.php',
						type: 'POST',
						data: strPost,
						success: function(resultMod){ 
								$("#modelo").attr("disabled", false); 
							
						    $("#modelo").empty(); 
						    $("#modelo").append('<option value="">Seleccione un modelo...</option>');
	              $("#modelo").append(resultMod);						
						}
					});
				}
    	}
    }
  });	
}

function getNowDateTimeStr() {
    var now = new Date();
    var hour = now.getHours() - (now.getHours() >= 12 ? 12 : 0);
    return [
        [AddZero(now.getDate()), AddZero(now.getMonth() + 1), now.getFullYear()].join(""), [AddZero(hour), AddZero(now.getMinutes())].join("")
    ].join("");
}

//Pad given value to the left with "0"
function AddZero(num) {
    return (num >= 0 && num < 10) ? "0" + num : num + "";
}

function closeNotification() {
	$(".uk-notify").fadeTo("slow", 0.5, function() {
		$('.uk-notify').hide();
	})
}