<section class="content">
	<section class="wrapper">
		<div class="row">
			<div class="col-md-12">
				<!-- Horizontal Form -->
	          <div class="box box-info">	
	        	<?php
	        	$msg = $this->session->flashdata('msg');
           			 if (!empty($msg['txt'])):
                ?>
               		 <div class="alert alert-block alert-<?php echo $msg['type']; ?>">
                   		 <button type="button" class="btn defalut" data-dismiss="alert">
                        <i class="fa fa-remove"></i>
                    </button>
                   		 <i class="<?php echo $msg['icon']; ?>"></i>
                   		 <?php echo $msg['txt']; ?>
                    </div>
           		 <?php endif ?>
                 
                 <!-- enable for codeigniter pagination links -->
                 <?php echo $this -> pagination -> create_links();?>
                 <!-- pagination link -->
                  <div class="box-header">
              <h3 class="box-title"></h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                	<p class="text-right"><button class="btn btn-default"><i class="fa fa-plus"></i> <?php echo anchor('faq_category/add', 'Add New FAQ Category'); ?></button></p>
                </div>
              </div>
            </div>
	       	<div class="box-body table-responsive no-padding">
                 <div>
                 <!-- <p class="text-left" style="float: left;"><input type="submit" class="btn btn-default" value="Submit" onclick="return chk_sel_list();"/></p>                  -->
                 </div>
           		 	<table id="faq-table" class="table table-striped table-condensed table-hover">
	                	<thead>
	                    <tr>
	                        <th class="center"><label><input type="checkbox"  id="selecctall" /><span class="lbl"></span></label></th>	                        
	                        <th>faq category name</th>
	                        <th>faq category description</th>	                                   
	                        <th>status</th>	
	                        <th></th>
	                    </tr>
	                	</thead>
                		<tbody>
                   			 <?php foreach ($query as $row): ?>
                        <tr>
                            <td class="center"><label><input type="checkbox" class="checkbox1" name="checkbox[<?php echo $row->faq_category_id;?>]" value="<?php echo $row->faq_category_id;?>"/><span class="lbl"></span></label></td>                            
                            <td><?php echo $row->category_name; ?></td>  
							<td><?php echo $row->category_desc; ?></td>
                            <td class="center"><?php echo(!empty($row -> status_ind)) ? "<span class='label label-success label-mini'>Active</span>" : "<span class='label label-warning label-mini'>INactive</span>"; ?></td> 
                            <td class="td-actions">
                                <div class="action-buttons">
                                    <a class="" title="View / Edit" href="<?php echo site_url('faq_category/edit/'.$row->faq_category_id);?>">
                                      <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a>&nbsp;
                                    <a class="red" href="<?php echo site_url('faq_category/delete/'.$row->faq_category_id); ?>"> 
                                      <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></a>&nbsp;                                    
                                </div>                             
                            </td>
                        </tr>
                   	 <?php endforeach ?>
               		 </tbody>                     
                	</table>
	        	</div>        
	        	</div>
			</div>	
	    </div>	
	</section>
</section>	