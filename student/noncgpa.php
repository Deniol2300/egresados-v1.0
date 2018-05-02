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
	header ('Location: ../staff/index.php'); 
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
		$crumb = "Informacion Personal";
		//Non-CGPA
		breadcrumb($crumb);
		$headervariable="Detalles";
		headervalue($headervariable);
?>
		<!-- <div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Status Details</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="tables/data1.json"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="state" >Code</th>
						        <th data-field="id" data-sortable="true">Group</th>
						        <th data-field="name"  data-sortable="true">Started on</th>
						        <th data-field="price" data-sortable="true">Completed on</th>
						        <th data-field="price" data-sortable="true">Status</th>
						    </tr>
						    </thead>
						    <tr>
						    <?php     
                       	$selectann=mysqli_query($con,"SELECT * from noncgpa WHERE stu_id='$usern'");
   						while($row=mysqli_fetch_array($selectann))
						{
							$code=$row[2];
							$group=$row[3];
							$sdate=$row[4];
							$edate=$row[5];
							$stat=$row[6];
							
                        ?>
                        	<td data-field="state" ><?php echo $code;?></td>
						        <td data-field="id" data-sortable="true"><?php echo $group;?></td>
						        <td data-field="name"  data-sortable="true"><?php echo $sdate;?></td>
						        <td data-field="price" data-sortable="true"><?php echo $edate;?></td>
						        <td data-field="price" data-sortable="true"><?php echo $stat;?></td>
						        </tr>
                        <?php
                         } ?>
						    
						</table>
					</div>
				</div>
			</div>
		</div> -->
		<?php 
		// $info_stu = "SELECT id_reg,dni,cod_univ,ap_patern,ap_materno,nomb,fac,esc,a_ingr,a_fin,email,password,auth FROM form_registro order by id_reg";
		// $res_info_stu =$mysqli->query($info_stu);
		?>
	
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
							<th>Nombre</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Codigo</th>
							<th>DNI</th>
							<th>Facultad</th>
							<th>Escuela</th>
							<th>Ingreso</th>
							<th>Egreso</th>
							<th>Email</th>

						 </tr>
						 </thead>
						<tbody>
							
						
						 
						 <?php
						 //$dni = $_POST['dni'];
						 $info_stu = "SELECT id_reg,dni,cod_univ,ap_patern,ap_materno,nomb,form_registro.fac,form_registro.esc,a_ingr,a_fin,email,password,auth,facultad.nomb_fac,escuela.nomb_esc 
						 FROM form_registro INNER JOIN facultad on form_registro.fac=facultad.id_fac INNER JOIN escuela on form_registro.esc=escuela.id_esc   WHERE cod_univ='$usern' LIMIT 1 	";
						 $res_info_stu =$mysqli->query($info_stu);
							while ($studiante = $res_info_stu->fetch_object())	
							{
								//var_dump es para imprimir las propiedades de una variable
								//var_dump($studiante);
								echo '<tr>'.
									'<td>' .$studiante->id_reg.'</td>'.
									'<td>' .$studiante->nomb.'</td>'.
									'<td>' .$studiante->ap_patern.'</td>'.
									'<td>' .$studiante->ap_materno .'</td>'.
									'<td>' .$studiante->cod_univ .'</td>'.
									'<td>' .$studiante->dni.'</td>'.
									'<td>' .$studiante->nomb_fac.'</td>'.
									'<td>' .$studiante->nomb_esc.'</td>'.
									'<td>' .$studiante->a_ingr.'</td>'.
									'<td>' .$studiante->a_fin.'</td>'.
									'<td>' .$studiante->email.'</td>'.
									
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
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
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
