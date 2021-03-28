<?php
namespace Joomla\Component\Kata\Administrator\Controller;
defined('_JEXEC') or die;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Filesystem\Path;
class KataController extends AdminController
{
 public function CreateTable()
	{
			$result = 'Empty';
			$data = json_decode(file_get_contents("php://input"));
			$dulieu = $data->dulieu;
			$db = Factory::getDbo();
			$query = $db->getQuery(true);
			$idpa = "idParent";
			$int = "int";
			$num = "11";
			$df = "0";
			$html='';
			$html.=",` ".$result." ` ".$result." (". $result .") "." NOT NULL DEFAULT ".$result;
			$sql =	"CREATE TABLE `#__taza_cocau` (
  `id` int(11) NOT NULL AUTO_INCREMENT";
			$sql.=",`".$dulieu->column."` ".$dulieu->type." (". $dulieu->num .") "." NOT NULL DEFAULT ".$dulieu->value;
//  `idParent` int(11) NOT NULL DEFAULT 0,
//  `Phongban` varchar(255) NOT NULL DEFAULT '0',
//  `Nhom` varchar(255) NOT NULL DEFAULT '0',
//  `Chucvu` varchar(255) NOT NULL DEFAULT '0',
//  `Trangthai` tinyint(1) NOT NULL DEFAULT 0,
//  `Xoa` tinyint(1) NOT NULL DEFAULT 0,
//  `Ngaytao` datetime NOT NULL DEFAULT current_timestamp(),
		$sql.=",	PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
				$db->setQuery($sql);
				$result = $db->execute();
				print_r($sql);
	}	

 public function CreateMenu()
	{
  $data = json_decode(file_get_contents("php://input"));
  $dulieu = $data->dulieu;
  $nametv = $dulieu->nametv;  
  $name = $dulieu->tenmenu; 
  $tmpl =  JPATH_COMPONENT.'/tmpl/'.$name;
  //Folder::create(JPATH_COMPONENT.'/tmpl/'.$name);
  $defphp = "<?php
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;
use Joomla\String\Inflector;
HTMLHelper::_('behavior.multiselect');
";
$defphp .='
$app = Factory::getApplication();
$user = Factory::getUser();
';
$defphp .="
HTMLHelper::_('script','administrator/components/com_kata/js/".$name.".js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('stylesheet','administrator/components/com_kata/css/".$name.".css', array('version' =>'auto'),array('defer' => 'true'));
?>";
$defphp .='<div ng-controller="'.ucfirst($name).'">	
<div class="modal fade" id="AddItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm '.$nametv.' Mới</h5>
      </div>
      <div class="modal-body">
 <form class="row">
  <div class="form-group col-sm-6"> 
	  <label class="bmd-label-floating">Tên '.$nametv.'</label>
    <input type="text" class="form-control" ng-model="'.$name.'.TenSP">
  </div>
	<div class="form-group col-sm-6"> 
	  <label class="bmd-label-floating">Giá</label>
    <input type="text" class="form-control" ng-model="'.$name.'.Gia">
  </div>  
	<div class="col-sm-6"><?php echo $this->form->renderField("hinhanh1"); ?></div>
  <div class="form-group col-sm-6"> 
	  <label class="bmd-label-floating">Mô Tả</label>
	  <textarea class="form-control" ng-model="'.$name.'.MotaSP"></textarea>
  </div>	 
</form>
      </div>
      <div class="modal-footer">
       	 <button type="button" class="btn btn-primary" ng-click="Create'.ucfirst($name).'('.$name.')">Thêm Mới</button>	
	 <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Hủy</button>	
      </div>
    </div>
  </div>
</div>		
<div class="modal fade" id="UpdateItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cập Nhật '.$nametv.'</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form> 
  <div class="form-group"> 
	  <label class="bmd-label-floating">Tên '.$nametv.'</label>
    <input type="text" class="form-control" ng-model="'.$name.'.TenSP">
  </div>
<?php echo $this->form->renderField("hinhanh2"); ?>
  <div class="form-group"> 
	  <label class="bmd-label-floating">Mô Tả</label>
    <input type="text" class="form-control" ng-model="'.$name.'.MotaSP">
  </div>	 
  <div class="form-group"> 
	  <label class="bmd-label-floating">Giá</label>
    <input type="text" class="form-control" ng-model="'.$name.'.Gia">
  </div>	
  <div class="form-group"> 
	 <button type="button" class="btn btn-outline-primary" ng-click="Update'.ucfirst($name).'('.$name.')">Cập Nhật</button>	
	 <button type="button" class="ml-auto btn btn-outline-danger" data-dismiss="modal" aria-label="Close">Hủy</button>	
  </div>
</form>  
      </div>
    </div>
  </div>
</div>	
<div class="db-content">	
<div class="row">	
<a href="index.php?option=com_kata" class="p-2">
<img src="/images/tazagroup-logo-icon.png" class="btn border" style="width: 90px"/></a>
		<div class="p-3 text-center"><h1>'.$nametv.'</h1></div></div>
	 <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#AddItem" ng-click="Init'.ucfirst($name).'()"><i class="fas fa-plus-circle"></i></button>	
	<div class="table-responsive" ng-init="Read'.ucfirst($name).'()">
	<table class="table table-bordered">
    <thead>
      <tr>
		<th>#</th>  
        <th>Tên '.$nametv.'</th>
        <th>Hình Ảnh</th>
        <th>Mô Tả</th>
		<th>Giá</th>
		<th>Sửa</th>  
		<th>Xóa</th>   
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="sp in SPhams">
        <td>{{$index+1}}</td>
        <td>{{sp.TenSP}}</td>
        <td><img ng-src="/{{sp.Hinhanh}}" class="w-25"/></td>
        <td>{{sp.MotaSP}}</td>		
     	<td>{{sp.Gia}}</td>
		<td data-toggle="modal" data-target="#UpdateItem" ng-click="edit(sp.id)"><i class="fas fa-edit text-info"></i></td>    
		<td data-toggle="modal" data-target="#DelItem"><i class="fas fa-trash-alt text-danger"></i>
		  <div class="modal fade" id="DelItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xóa '.$nametv.'</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 			<button class="btn btn-outline-danger" ng-click="Remove'.ucfirst($name).'(sp.id)">Xóa</button>
		  	<button class="btn btn-outline-secondary">Hủy</button>
      </div>
    </div>
  </div>
</div>	  
		  </td>  
      </tr>
    </tbody>
  </table>
	</div>	
	</div>
	</div>';
$defaultxml ='<?xml version="1.0" encoding="utf-8"?>
<metadata>
	<layout title="'.$nametv.' View">
		<message>
			<![CDATA['.$nametv.' Mô Tả]]>
		</message>
	</layout>
</metadata>';
	 
//tmpl end	 
//view begin	 
$viewsrc =   JPATH_COMPONENT.'/src/View/'.ucfirst($name);
	 
$viewphp = "<?php";
$viewphp .= "
namespace Joomla\Component\Kata\Administrator\View\\".ucfirst($name).";
\defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Form\Form;";
$viewphp .='class HtmlView extends BaseHtmlView
{
	protected $items;
	protected $form;
	protected $pagination;
	protected $state;
	public $filterForm;
	public $activeFilters;
	public function display($tpl = null)
	{
		$this->form  = $this->get("Form");
		parent::display($tpl);
	}
}';	 
	 
	 
 	
//view End
// Model Begin
$modelsrc =   JPATH_COMPONENT.'/src/Model'; 
$modelphp =	"<?php
namespace Joomla\Component\Kata\Administrator\Model;
defined('_JEXEC') or die;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Tag\KataServiceInterface;
use Joomla\Database\ParameterType;
use Joomla\CMS\Form\Form;";
$modelphp .='
class '.ucfirst($name).'Model extends ListModel
{
		public function getForm($data = array(), $loadData = true)
		{
			$form = $this->loadForm';
	$modelphp .="('com_kata.$name', '$name', array('control' => 'jform', 'load_data' => ";
	$modelphp .='$loadData));
			if (empty($form))
			{
				return false;
			}
			return $form;
		}
	
public function Create'.ucfirst($name).'() {
	    $data = json_decode(file_get_contents("php://input"));
        $dulieu = $data->dulieu;
        $user = Factory::getUser();
        $db = Factory::getDbo();
        $profile = new \stdClass;
        $profile->TenSP = $dulieu->TenSP;
								$profile->Hinhanh = $dulieu->Hinhanh;
        $profile->MotaSP = $dulieu->MotaSP;
        $profile->Gia = $dulieu->Gia;
        $result = $db->insertObject("#__sharynsanpham", $profile);
								return $result;
    }
	public function Read'.ucfirst($name).'() {
								$data = json_decode(file_get_contents("php://input"));
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select(array("a.id", "a.TenSP", "a.Hinhanh", "a.MotaSP","a.Gia","a.Trangthai"))->from($db->quoteName("#__sharynsanpham", "a"))->order("id DESC")->where($db->quoteName("a.Xoa")."=0");
        $db->setQuery($query);
        $row = $db->loadObjectList();
        return $row;
    }
	public function Update'.ucfirst($name).'() {
								$data = json_decode(file_get_contents("php://input"));
        $dulieu = $data->dulieu;
        $user = Factory::getUser();
        $db = Factory::getDbo();
        $profile = new \stdClass;
        $profile->id = $dulieu->id;
        $profile->TenSP = $dulieu->TenSP;
		$profile->Hinhanh = $dulieu->Hinhanh;
        $profile->MotaSP = $dulieu->MotaSP;
        $profile->Gia = $dulieu->Gia;
        $profile->Trangthai = (int)$dulieu->Trangthai;
        $result = $db->updateObject("#__sharynsanpham", $profile,"id");
								return $result;	
    }
	public function Delete'.ucfirst($name).'() {
								$data = json_decode(file_get_contents("php://input"));
        $db = Factory::getDbo();
        $profile = new \stdClass;
        $profile->id = $data->id;
        $profile->Xoa = 1;
        $result = $db->updateObject("#__sharynsanpham", $profile,"id");
								return $result;
    }
	
	
}';	
//Model End
	 
// Controller Begin
$controsrc =   JPATH_COMPONENT.'/src/Controller'; 
$controphp =	"<?php
namespace Joomla\Component\Kata\Administrator\Controller;
defined('_JEXEC') or die;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Factory;
use Joomla\Component\Kata\Administrator\Model;
";
$controphp .='	 
class '.ucfirst($name).'Controller extends AdminController
{
	public function Create'.ucfirst($name).'() {
							$model = $this->getModel("'.ucfirst($name).'");
							$result = 	$model->Create'.ucfirst($name).'();
							print_r(json_encode((array)$result));	
    }
	public function Read'.ucfirst($name).'() {		
						$model = $this->getModel("'.ucfirst($name).'");
						$result = 	$model->Read'.ucfirst($name).'();
							print_r(json_encode((array)$result));
    }
	public function Update'.ucfirst($name).'() {
							$model = $this->getModel("'.ucfirst($name).'");
							$result = 	$model->Update'.ucfirst($name).'();
							print_r(json_encode((array)$result));
    }
	public function Delete'.ucfirst($name).'() {
							$model = $this->getModel("'.ucfirst($name).'");
							$result = 	$model->Delete'.ucfirst($name).'();
							print_r(json_encode((array)$result));
    }
	
}';	
//Controller End	 
//Forms Begin
$formsrc =   JPATH_COMPONENT.'/forms'; 
$formxml =	'<?xml version="1.0" encoding="utf-8"?>
<form>
	<field name="hinhanh1" label="Hình Thêm Mới" type="media" preview_width="200"  />
	<field name="hinhanh2" label="Hình Cập Nhật" type="media" preview_width="200"  />
</form>';	
//Forms End

//CSS Begin
$csssrc =   JPATH_COMPONENT.'/css'; 
$csscontent =	'
#subhead
{
	display: none;
}';	
//CSS End

//Js Begin
$jssrc =   JPATH_COMPONENT.'/js'; 
$jscontent ='angular.module("Admin").controller("'.ucfirst($name).'",function($scope, $http) { 
$scope.Init'.ucfirst($name).' = function()
{	
$scope.Read'.ucfirst($name).'();
$scope.'.$name.' = {};
$(".modal").modal("hide");	
$(".modal-backdrop").remove();	
}		
$scope.Create'.ucfirst($name).' = function(dulieu)
{
	console.log(dulieu);
	 $http.post("index.php?option=com_kata&task='.ucfirst($name).'.Create'.ucfirst($name).'&format=raw",{"dulieu":dulieu})  
    .then(function(data) { 
  		console.log(data);
		 $scope.Init'.ucfirst($name).'();
    });
	
}
$scope.Read'.ucfirst($name).' = function()
{
 $http.post("index.php?option=com_kata&task='.ucfirst($name).'.Read'.ucfirst($name).'&format=raw")  
    .then(function(data) { 
  		console.log(data);
		$scope.SPhams = data.data;	 
    });
	
}	
$scope.edit = function(id){
	$scope.'.$name.' =  $scope.SPhams.find(result => result.id === id);
}
$scope.Update'.ucfirst($name).' = function(dulieu)
{
dulieu["Hinhanh"] = $("#jform_hinhanh2").val();
 $http.post("index.php?option=com_kata&task='.ucfirst($name).'.Update'.ucfirst($name).'&format=raw",{"dulieu":dulieu})  
    .then(function(data) { 
  		console.log(data);
 		$scope.Init'.ucfirst($name).'();
    });	
}
$scope.Delete'.ucfirst($name).' = function(dulieu)
{
 $http.post("index.php?option=com_kata&task='.ucfirst($name).'.Delete'.ucfirst($name).'&format=raw",{"id":dulieu})  
    .then(function(data) { 
  		console.log(data);
 		$scope.Init'.ucfirst($name).'();
    });
	
}
});';	
//Js End
if(!Folder::exists($tmpl))
{
File::write($controsrc . '/'.ucfirst($name).'Controller.php', $controphp);		
File::write($modelsrc . '/'.ucfirst($name).'Model.php', $modelphp);		
File::write($viewsrc . '/HtmlView.php', $viewphp);		
File::write($formsrc . '/'.$name.'.xml', $formxml);		
File::write($tmpl . '/default.php', $defphp);	 
File::write($tmpl . '/default.xml', $defaultxml);	
File::write($jssrc . '/'.$name.'.js', $jscontent);	
File::write($csssrc . '/'.$name.'.css', $csscontent);	

print_r("Đã Tạo Thành Công Thư Mục");

}
else   print_r("Đã tồn tại thư mục");
}

//	public function CreateTable()
//	{
//		$data = json_decode(file_get_contents("php://input"));
// $dulieu = $data->dulieu;
//		$db = Factory::getDbo();
//		$query = $db->getQuery(true);
//		$query = $dulieu;
//		$db->setQuery($query);
//		$result = $db->execute();
//		print_r($result);
//	}

	public function DeleteMenu() {
								$data = json_decode(file_get_contents("php://input"));
								$dulieu = $data->dulieu;
								$nametv = $dulieu->nametv;  
								$name = $dulieu->tenmenu; 
								$tmpl =  JPATH_COMPONENT.'/tmpl/'.$name;
								$viewsrc =   JPATH_COMPONENT.'/src/View/'.ucfirst($name);
								$controsrc =   JPATH_COMPONENT.'/src/Controller'; 
								$modelsrc =   JPATH_COMPONENT.'/src/Model'; 
								$formsrc =   JPATH_COMPONENT.'/forms'; 
								$jssrc =   JPATH_COMPONENT.'/js'; 
							if($name=="kata")
							{
								print_r("Đây Là Component Đặc Biệt Không Thể Xóa;");
							}
							else
							{
								if(Folder::exists($tmpl))
									{
									Folder::delete($tmpl);
									File::delete($controsrc . '/'.ucfirst($name).'Controller.php');		
									File::delete($modelsrc . '/'.ucfirst($name).'Model.php');		
									Folder::delete($viewsrc);		
									File::delete($formsrc . '/'.$name.'.xml');		
									File::delete($jssrc . '/'.$name.'.js');	
									File::delete($csssrc . '/'.$name.'.css');	
									print_r("Đã Xóa ".$nametv." Thành Công;");
									}
									else{
																print_r("Không Có Thư Mục Này");
																}
							}

    }
	
}
