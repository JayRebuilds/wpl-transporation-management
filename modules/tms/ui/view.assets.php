<?php
include_once 'blade/view.assets.blade.php';
include_once COMMON.'class.common.php';

?>

<div class="panel panel-default">


    <div class="panel-heading text-center" style="background-color: rgba(7,71,166,0.62)">
        <b>New Asset</b></div>
    <br>
    <div class="panel-body">

	<div id="form">
		<form method="post" class="form-horizontal">

			<div class="form-group">
              	<label class="control-label col-sm-4" for="assetType">Asset Type:</label>
              	<div class="col-sm-6">

                    <?php
                    // this block of code prints the list box of roles with current assigned  roles

                    $var = '<select name="atId" class="form-control" id="select-from-types" multiple>';
                    $Result = $_AssetBao->getAllAssetType();
                        //if DAO access is successful to load all the Roles then show them one by one
                    if($Result->getIsSuccess()){

                        $AssetTypes = $Result->getResultObject();

                       for ($i=0; $i < sizeof($AssetTypes); $i++) {

                            $AssetType = $AssetTypes[$i];

                            $var = $var. '<option value="'.$AssetType->getAtId().'"';

                            if(isset($_GET['edit']) && $globalUser->getAtId()==$AssetType->getAtId()) {
                                $var = $var.' selected="selected"';
                            }

                            $var = $var.'>'.$AssetType->getTypeName().'</option>';

                        }

                        $var = $var.'</select>';
                    }
                    echo $var;
                    ?>

			  	</div>
			</div>

			<div class="form-group">
              	<label class="control-label col-sm-4" for="comName">Company Name:</label>
              	<div class="col-sm-6">
                    <input type="text" name="comName" class="form-control" placeholder="Company Name" value="<?php
    					if(isset($_GET['edit'])) echo $globalUser->getCompanyName();  ?>"/>
				</div>
			</div>

			<div class="form-group">
              	<label class="control-label col-sm-4" for="liscenceNo">Liscence No:</label>
              	<div class="col-sm-6">
                    <input type="text" name="liscenceNo" class="form-control" placeholder="Liscence No" value="<?php
    					if(isset($_GET['edit'])) echo $globalUser->getLiscenceNo();  ?>" required />

			  	</div>
			</div>


			<div class="form-group">
              	<label class="control-label col-sm-4" for="isRented">Is it Rented:</label>
              	<div class="col-sm-6">


                    <?php
                    $var = '<select name="isRented" class="form-control" id="select-from-roles" multiple>';
                    $var = $var. '<option selected disabled>Select Option</option>';

                    $op  = array('true','false');
                    for ($i=0; $i < 2; $i++) {

                        $ops= $op[$i];

                        $var = $var. '<option value="'.$ops.'"';

                        if(isset($_GET['edit']) ) {
                            if($globalUser->getIsRented()==$ops){
                                $var = $var.' selected="selected"';
                            }

                        }
                        if($ops=='true'){
                            $var = $var.'>'.'Yes'.'</option>';
                        }

                        else {
                            $var = $var.'>'.'No'.'</option>';

                        }

                    }

                    $var = $var.'</select>';

                    echo $var;

                    ?>
				</div>
			</div>

			<div class="form-group">
              	<label class="control-label col-sm-4" for="r_cost">Rent Cost:</label>
              	<div class="col-sm-6">
                    <input type="text" name="r_cost" class="form-control" placeholder="Rent Cost" value="<?php
                       if(isset($_GET['edit'])) echo $globalUser->getRentCost();  ?>" required/>

			  	</div>
			</div>
	        <div class="form-group">
              <div class="col-sm-offset-3 col-sm-8">
				  <?php
				  if(isset($_GET['edit'])){
				  ?>
				  <button type="submit" value="update" class="btn btn-primary" name="update">Update Request</button>

				<?php
				}
				else {

				?>
					 <button type="submit" value="request" class="btn btn-primary" name="request">Submit Request</button>
				<?php } ?>

			    </div>
            </div>
		</form>

	</div>
	</div>

</div>

<div class="panel-heading text-center" style="background-color: rgba(7,71,166,0.62)">
    <b>Own Assets</b></div>
<br>
<div class="panel panel-body">

<table class="table table-bordered table-striped" style="border: 1px solid;border-color: rgba(7,71,166,0.62)">
<?php

$state = 'own';

$Result = $_AssetBao->getAllAsset($state);

//if DAO access is successful to load all the users then show them one by one
if($Result->getIsSuccess()){

    $AssetList = $Result->getResultObject();
    ?>
    <tr style="background-color: rgba(7,71,166,0.62)">
        <th>Asset Type</th>
        <th>Company Name</th>
        <th>Liscence No</th>
        <th>Edit</th>
        <th style="color: darkred">Delete</th>

    </tr>
    <?php
    for($i = 0; $i < sizeof($AssetList); $i++) {
        $Asset = $AssetList[$i];

        ?>
        <tr>
            <td>
                <a href="asset_type.php?edit=<?php echo $Asset->getAtId() ?> "> <?php echo $Asset->getAtId() ?> </a>
            </td>
            <td><?php echo $Asset->getCompanyName(); ?></td>
            <td><?php echo $Asset->getLiscenceNo(); ?></td>
            <td>
                <a href="?edit=<?php echo $Asset->getId(); ?>" onclick="return confirm('sure to edit !'); " >edit</a>
            </td>
            <td>
                <a class="text-danger" href="?del=<?php echo $Asset->getId(); ?>" onclick="return confirm('sure to delete !'); " >delete</a>
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

<div class="panel-heading text-center" style="background-color: rgba(17,71,166,10.62)">
    <b>Hired Assets</b></div>
<br>
<div class="panel panel-body">

    <table class="table table-bordered table-striped" style="border: 1px solid;border-color: rgba(7,71,166,0.62)">
        <?php

        $state = 'hired';

        $Result = $_AssetBao->getAllAsset($state);

        //if DAO access is successful to load all the users then show them one by one
        if($Result->getIsSuccess()){

            $AssetList = $Result->getResultObject();
            ?>
            <tr style="background-color: rgba(7,71,166,0.62)">
                <th>Asset Type</th>
                <th>Company Name</th>
                <th>Rent Cost</th>
                <th>Liscence No</th>
                <th>Edit</th>
                <th style="color: darkred">Delete</th>

            </tr>
            <?php
            for($i = 0; $i < sizeof($AssetList); $i++) {
                $Asset = $AssetList[$i];

                ?>
                <tr>
                    <td>
                        <a href="asset_type.php?edit=<?php echo $Asset->getAtId() ?> "> <?php echo $Asset->getAtId() ?> </a>
                    </td>
                    <td><?php echo $Asset->getCompanyName(); ?></td>

                    <td><?php echo $Asset->getRentCost(); ?></td>
                    <td><?php echo $Asset->getLiscenceNo(); ?></td>
                    <td>
                        <a href="?edit=<?php echo $Asset->getId(); ?>" onclick="return confirm('sure to edit !'); " >edit</a>
                    </td>
                    <td>
                        <a class="text-danger" href="?del=<?php echo $Asset->getId(); ?>" onclick="return confirm('sure to delete !'); " >delete</a>
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
