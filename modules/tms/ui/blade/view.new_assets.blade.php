<?php
include_once UTILITY.'class.util.php';
include_once MODULES_TMS.'bao/class.assetbao.php';

$_AssetBao = new AssetBao();
$_DB = DBUtil::getInstance();
$_Log= LogUtil::getInstance();

if(isset($_POST['request']))
{
	$Asset = new Asset();

	$Asset->setAssetType($_DB->secureInput($_POST['assetType']));
	$Asset->setCompanyName($_DB->secureInput($_POST['comName']));
	$Asset->setIsRented($_DB->secureInput($_POST['isRented']));
	$Asset->setRentCost($_DB->secureInput($_POST['r_cost']));
	$Asset->setLiscenceNo($_DB->secureInput($_POST['liscenceNo']));

	$Result = $_AssetBao->newAssetRequest($Asset);

	if($Result->getIsSuccess())
		echo '<strong>'.$Result->getResultObject().'</strong>';

	header("Location:".PageUtil::$ASSETS);

}
if(isset($_GET['edit']))
{
	$Asset = new Asset();
	$Asset->setId($_GET['edit']);
	$globalUser = $_AssetBao->getAsset($Asset)->getResultObject(); //reading the user object from the result object
}

/*updating an existing user information*/
if(isset($_POST['update']))
{
	$Asset = new Asset();
	$Asset->setId ($_GET['edit']);
    $Asset->setAssetType ( $_POST['assetType'] );
    $Asset->setCompanyName ( $_POST['comName'] );
    $Asset->setIsRented ( $_POST['isRented'] );
    $Asset->setRentCost( $_POST['r_cost'] );
    $Asset->setLiscenceNo( $_POST['liscenceNo'] );

	$Result = $_AssetBao->updateAsset($Asset);
	if($Result->getIsSuccess())
		echo '<strong>'.$Result->getResultObject().'</strong>';

	header("Location:".PageUtil::$ASSETS);
}

echo '<br> log:: exit blade.user_new.php';
 ?>
