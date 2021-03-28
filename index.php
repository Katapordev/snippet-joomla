<div ng-app="Admin" class="container-fluid py-3" ng-controller="Dashboard">
 	<?php if($this->isDel) : ?>
 <div class="editcomponet row">
<button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#newmenu">
Tạo Menu
</button>
<button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#newdatabase" >
Tạo Database
</button>

<div class="modal" id="newdatabase">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tạo Menu</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form>
    <div class="form-group">
     <input class="form-control" ng-model="database.column" placeholder="Tên Trường"/> 
					<input class="form-control" ng-model="database.type" placeholder="Kiểu Dữ Liệu"/>
					<input class="form-control" ng-model="database.num" placeholder="Độ Dài"/>
       </div> 
	  <div class="form-group">
    <input class="form-control" ng-model="menu.tenmenu" placeholder="Tên Menu"/>
       </div>
	  </form>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-primary" ng-click="CreateTable(database)">Tạo Mới</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>







<div class="modal" id="newmenu">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tạo Menu</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      <form>
    <div class="form-group">
     <input class="form-control" ng-model="menu.nametv" placeholder="Tên Tiếng Việt"/> 
       </div> 
	  <div class="form-group">
    <input class="form-control" ng-model="menu.tenmenu" placeholder="Tên Menu"/>
       </div>
	  </form>
      </div>
      <div class="modal-footer">
						 <button type="button" class="btn btn-danger" ng-click="DeleteMenu(menu)">Xóa Menu</button>
       <button type="button" class="btn btn-primary" ng-click="CreateMenu(menu)">Tạo Mới</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	</div>
		<?php endif ; ?>
 <div class="container text-white my-3">
<div class="row text-center">  
<div class="col-sm-3 col-4 mb-3"><a class="p-5 btn btn-outline-primary" href="<?php echo Route::_('index.php?option=com_kata&view=quanlymay'); ?>">Quản Lý Tài Nguyên</a></div>
<div class="col-sm-3 col-4 mb-3"><a class="p-5 btn btn-outline-primary" href="<?php echo Route::_('index.php?option=com_kata&view=cocau'); ?>">Cơ Cấu</a></div>
	<?php if($this->isDel) : ?>
	<div class="col-sm-3 col-4 mb-3"> <a class="p-5 btn btn-outline-primary" href="<?php echo Route::_('index.php?option=com_kata&view=user'); ?>">User</a> </div>
	<?php endif ; ?>
<!--
<div class="col-sm-3 col-4 mb-3"><a class="p-5 btn btn-outline-primary" href="<?php echo Route::_('index.php?option=com_kata&view=user'); ?>">User</a></div>
    <div class="col-sm-4 col-6 mb-3"><a class="p-5 btn btn-outline-primary" href="<?php echo Route::_('index.php?option=com_kata&view=sharynslide'); ?>">Slide</a></div>
		 <div class="col-sm-4 col-6 mb-3"> <a class="p-5 btn btn-outline-primary" href="<?php echo Route::_('index.php?option=com_kata&view=ladipage'); ?>">Ladipage</a> </div>		 
			<div class="col-sm-4 col-6 mb-3"> <a class="p-5 btn btn-outline-primary" href="<?php echo Route::_('index.php?option=com_kata&view=taskviec'); ?>">Task Việc</a> </div>
-->

		
		</div>
 </div>
</div>