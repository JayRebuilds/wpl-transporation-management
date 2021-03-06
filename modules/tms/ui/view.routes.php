<?php

include_once 'blade/view.routes.blade.php';
include_once COMMON. 'class.common.php';

?>


<div class="panel panel-default">


    <div class="panel-heading text-center" style="background-color: rgba(7,71,166,0.62)">
        <b>New Route</b></div>
    <br>
    <div class="panel-body">

	<div id="form">
		<form method="post" class="form-horizontal">

			<div class="form-group">
              	<label class="control-label col-sm-2" for="startPoint">Starting Point:</label>
              	<div class="col-sm-10">

  				  <input type="text" name="startPoint" class="form-control" placeholder="Starting Point" value="<?php
  					if(isset($_GET['edit'])) echo $globalUser->getStart();  ?>"/>


			  	</div>
			</div>

			<div class="form-group">
              	<label class="control-label col-sm-2" for="destination">Destination:</label>
              	<div class="col-sm-10">
                    <input type="text" name="destination" class="form-control" placeholder="Destination" value="<?php
    					if(isset($_GET['edit'])) echo $globalUser->getDest();  ?>"/>
				</div>
			</div>

			<div class="form-group">
              	<label class="control-label col-sm-2" for="viaPoints">Via:</label>
              	<div class="col-sm-10">
                    <input type="text" name="viaPoints" class="form-control" placeholder="Via" value="<?php
    					if(isset($_GET['edit'])) echo $globalUser->getVia();  ?>" required />

			  	</div>
			</div>

	        <div class="form-group">
              <div class="col-sm-offset-3 col-sm-8">
				  <?php
				  if(isset($_GET['edit'])){
				  ?>
				  <button type="submit" class="btn btn-primary" value="update" name="update">Update Request</button>

				<?php
				}
				else {

				?>
					 <button type="submit" class="btn btn-primary" value="request" name="request">Submit Request</button>
				<?php } ?>



			    </div>
            </div>
		</form>

	</div>
	</div>

</div>

<div class="panel panel-body">
<table class="table table-bordered table-striped" style="border: 1px solid;border-color: rgba(7,71,166,0.62)">
<?php


$Result = $_RouteBao->getAllRoute();

//if DAO access is successful to load all the users then show them one by one
if($Result->getIsSuccess()){

    $RouteList = $Result->getResultObject();
    ?>
    <tr style="background-color: rgba(7,71,166,0.62)">
        <th>Route No</th>
        <th>Starting Point</th>
        <th>Via</th>
        <th>Destination</th>
        <th>Edit</th>
        <th style="color: darkred">Delete</th>
    </tr>
    <?php
    for($i = 0; $i < sizeof($RouteList); $i++) {
        $Route = $RouteList[$i];
        ?>
        <tr>
            <td><?php echo $Route->getId(); ?></td>
            <td><?php echo $Route->getStart(); ?></td>
            <td><?php echo $Route->getVia(); ?></td>
            <td><?php echo $Route->getDest(); ?></td>

            <td>
                <a href="?edit=<?php echo $Route->getId(); ?>" onclick="return confirm('sure to edit !'); " >edit</a>
            </td>
            <td>
                <a class="text-danger" href="?del=<?php echo $Route->getId(); ?>" onclick="return confirm('sure to delete !'); " >delete</a>
            </td>
        </tr>
        <?php

    }

}
else{

    echo $Result->getResultObject(); //giving failure message
}

?>
</table>
</div>
