<?php
/**
 ** Author: Sridhar Siva Subramanian
 ** This is a veru basic CRUD application, which I used to 
 ** demonstrate PHP in my class. Hope this helps in 
 ** understanding PHP functions, classes, CRUD DB 
 ** connectivity, sessions, file upload, etc.,
 ** This is just a begginers demo. Upload the sql dump into 
 ** your database before eunning this project
  

 */
require_once '../functions/interfacebasic.php';
require_once '../functions/config/conexion.php';

session_start();
$mysqli= getConn();
if(($_SESSION['user']!="")&&($_SESSION['auth']!=""))
{
     
	  if($_SESSION['auth']=="1")
	  {
		  header('Location: ../staff/index.php');  
	  }
}
else
{
    session_destroy();
    header('Location: ../index1.php');
}

$usern=$_SESSION['user'];
//var_dump($usern);

head();
?>

<body>
	<?php 
		navbar(); 
		sidebar_student();
		$crumb = "Informacion Academica";
		//Submit
		breadcrumb($crumb);
		$headervariable="Informacion Academica";
		headervalue($headervariable);

?>
			<!-- <div class="col-lg-12">
			<div class="panel panel-info">
				<div class="panel-heading">Enter Details</div><p id="error"></p>
				<div class="panel-body">
					<div class="col-md-6">
						<form role="form" action="" method="POST" enctype="multipart/form-data">
							<div class="form-group">
									<label>Title</label>
									<input class="form-control"  type="text" name="title">
							</div>
																
							<div class="form-group">
									<label>Submit to</label>
									<select class="form-control" name="staff">
										<option value="">--Choose a Type--</option>
										<?php     
                       	$pickclass=mysqli_query($con,"SELECT staffid,name from staff");
   						while($row=mysqli_fetch_array($pickclass))
						{
							$staff_id=$row[0];
							$name=$row[1];
                        ?>
									
									
                        	<option value='<?php echo $staff_id; ?>'><?php echo $name; ?></option>

                        <?php } ?>
									</select>
							</div>

							<div class="form-group">
								<label>File input</label>
								<input type="file" name="uploaded">
								 <p class="help-block">Upload only .docx, .pptx, .pdf files</p>
							</div>

							<div class="form-group">
							<button type="submit" name="submit" class="btn btn-primary">Submit Button</button>
							<button type="reset" name="reset" class="btn btn-default">Reset Button</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div> -->

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Detalles</div>
				<div class="panel-body">
					<table data-toggle="table">
						 <thead>
						 <tr>
						 	<!-- <th data-field="state" >Code</th>
							<th data-field="id" data-sortable="true">id</th>
							<th data-field="name"  data-sortable="true">Nombre</th>
							<th data-field="price" data-sortable="true">Apellido Paterno</th>
							<th data-field="price" data-sortable="true">Apellido Materno</th>
							<th data-field="id" data-sortable="true">Codigo</th>
							<th data-field="id" data-sortable="true">DNI</th>
							<th data-field="id" data-sortable="true">Facultad</th>
							<th data-field="id" data-sortable="true">Escuela</th>
							<th data-field="id" data-sortable="true">Ingreso</th>
							<th data-field="id" data-sortable="true">Egreso</th>
							<th data-field="id" data-sortable="true">E mail</th> -->

							<th>ID</th>
							<th>Codigo</th>
							<th>Facultad</th>
                            <th>Escuela</th>
                            <th>Especialidad</th>
                            <th>Ingreso</th>
                            <th>Egreso</th>
                            <th>Tercio</th>
                            <th>Quinto</th>
                            <th>Bachier</th>
                            <th>Año</th>
                            <th>Titulo</th>
                            <th>Año</th>
                            <th>Maestria</th>
                            <th>Año</th>
                            <th>Doctorado</th>
                            <th>Año</th>
                            <th>Segunda Maestria</th>
                            <th>Año</th>
                            <th>Otro</th>
                            <th>Año</th>

							

						 </tr>
						 </thead>
						<tbody>
							
						
						 
						 <?php
						//  $info_stu = "SELECT id_reg,dni,cod_univ,ap_patern,ap_materno,nomb,form_registro.fac,form_registro.esc,a_ingr,a_fin,email,password,auth,facultad.nomb_fac,escuela.nomb_esc 
						//  FROM form_registro INNER JOIN facultad on form_registro.fac=facultad.id_fac INNER JOIN escuela on form_registro.esc=escuela.id_esc  ";
                         
                         $info_stu = "SELECT form_univ.id_form,datos_personales.id,datos_personales.cod_univ,form_univ.facultad_id_fac,form_univ.escuela_id_esc,esp_form,ingreso,egreso,terc_sup,quin_sup,grad_bach,anio_bach,tit_prof,anio_tit,maest,anio_maest,doctorado,anio_doc,seg_esp,anio_seg,otro,anio_otr,
						 facultad.nomb_fac,escuela.nomb_esc
						 FROM form_univ  INNER JOIN facultad on form_univ.facultad_id_fac= facultad.id_fac 
						 INNER JOIN escuela on form_univ.escuela_id_esc = escuela.id_esc 
						 INNER JOIN datos_personales on form_univ.id_form=datos_personales.id 	 
						 WHERE cod_univ='$usern' LIMIT 1 ";
						 $res_info_stu =$mysqli->query($info_stu);
						 //var_dump($res_info_stu);
							while ($studiante = $res_info_stu->fetch_object())	
							{
								//var_dump es para imprimir las propiedades de una variable
								//var_dump($studiante);
								echo '<tr>'.
									'<td>' .$studiante->id_form.'</td>'.
									'<td>' .$studiante->cod_univ.'</td>'.
									'<td>' .$studiante->nomb_fac.'</td>'.
                                    '<td>' .$studiante->nomb_esc.'</td>'.
                                    '<td>' .$studiante->esp_form.'</td>'.
									'<td>' .$studiante->ingreso.'</td>'.
									'<td>' .$studiante->egreso.'</td>'.
                                    '<td>' .$studiante->terc_sup.'</td>'.
                                    '<td>' .$studiante->quin_sup.'</td>'.
                                    '<td>' .$studiante->grad_bach.'</td>'.
                                    '<td>' .$studiante->anio_bach.'</td>'.
                                    '<td>' .$studiante->tit_prof.'</td>'.
                                    '<td>' .$studiante->anio_tit.'</td>'.
                                    '<td>' .$studiante->maest.'</td>'.
                                    '<td>' .$studiante->anio_maest.'</td>'.
                                    '<td>' .$studiante->doctorado.'</td>'.
                                    '<td>' .$studiante->anio_doc.'</td>'.
                                    '<td>' .$studiante->seg_esp.'</td>'.
                                    '<td>' .$studiante->anio_seg.'</td>'.
                                    '<td>' .$studiante->otro.'</td>'.
                                    '<td>' .$studiante->anio_otr.'</td>'.
									
									'</tr>';
							}
						 ?>
						 
						 </tbody>
					</table>
				</div>
			</div>
		</div>

	</div>

		
	
		
	<?php scripts();?>
	<script src="../js/bootstrap-table.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
<?php
if(isset($_POST['submit'])){


	$title=$_POST['title'];
	$username=$_SESSION['user'];
	$staff=$_POST['staff'];

 $target = "uploads/"; 
 //$target = $target . basename( $_FILES['uploaded']['name']) ; 
 $ok=1; 
 
 //This is our size condition 
 if ($uploaded_size > 10485760) 
 { 
 echo "Your file is too large.<br>"; 
 $ok=0; 
 } 
 
 //This is our limit file type condition 
 if (($uploaded_type =="application/pdf")||($uploaded_type =="application/msword")||($uploaded_type =="application/vnd.ms-powerpoint"))
 { 
 echo "Format not supported<br>"; 
 $ok=0; 
 } 
 
 //Here we check that $ok was not set to 0 by an error 
 if ($ok==0) 
 { 
 Echo "Sorry your file was not uploaded"; 
 } 
 
 //If everything is ok we try to upload it 
 else 
 { 


$randString = md5(time()); //encode the timestamp - returns a 32 chars long string
  $fileName = $_FILES["uploaded"]["name"]; //the original file name
  $splitName = explode(".", $fileName); //split the file name by the dot
  $fileExt = end($splitName); //get the file extension
  $newFileName  = strtolower($randString.'.'.$fileExt);
  $target = $target . basename( $newFileName) ; 


 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
 { 
 echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded"; 


$sql1=mysqli_query($con,"INSERT INTO assignment(username,submit_to,topic,link) values('$username','$staff','$title','$newFileName') ");

if($sql1){
	echo '<script type="text/javascript">
                var e = document.getElementById("error").innerHTML = "<font color=green><b>Success!</font></b>";</script>';
}



 } 
 else 
 { 
 echo "Sorry, there was a problem uploading your file."; 
 } 
 } 

}
 ?>