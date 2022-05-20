                        <div class="row new_product_row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('file.category')); ?> *</strong> </label>
                                        <div class="input-group">



                                            <select  name="main_category[]" data-value="<?php echo e($value); ?>"  onchange="show_category(this);" class="form-control show_category" data-id="subcategory<?php echo e($value); ?>" id="category<?php echo e($value); ?>">

                                                
                                                <option value="<?php echo e(NULL); ?>">Choose</option>
                                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!in_array($cat->id,$all_values)): ?>
                                                <?php

                                                                      $name = strtolower($cat->name);
                                                                      $name = str_replace(' ','_',$name);

                                                                    ?>
                                                    <option data-div="<?php echo e($name); ?>" data-class="show_filter<?php echo e($value); ?>" value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                                                <?php endif; ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="clearfix"></div> 




                        </div>


                                 <div class="row" id="subcategory<?php echo e($value); ?>">
                                        
                                                <?php $fl = 0; ?>
                                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                $name = strtolower($cat->name);
                                                $name = str_replace(' ','_',$name);
                                                ?>
                                                <div class="col-md-12 show_filter<?php echo e($value); ?>" id="<?php echo e($name); ?>" style="display: block">
                                                    <div class="row"> 
                                                    <?php $__currentLoopData = $cat->subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                     <?php
                                                        $sbname = strtolower($sb->name);
                                                        $sbname = str_replace(' ','_',$sbname);
                                                        ?>
                                                        <div class="col-md-2">
                                                              <label><strong><?php echo e($sb->name); ?></strong></label>  
                                                              <input type="text" name="<?php echo e($sbname); ?>" id="<?php echo e($sb->id); ?>" class="form-control <?php echo e($sbname); ?>_filter <?php echo e($name); ?>">
                                                        </div>
                                                                                                        
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-md-2">
                                                         <label class="col-md-12"><strong>Filter</strong></label>  
                                                        <input type="button" data-cat="<?php echo e($name); ?>" name="filter<?php echo e($name); ?>" data-id="<?php echo e($cat->id); ?>"  class="search_production btn btn-primary" onclick="search_production(this);" value="Filter">
                                                    </div>
                                                    </div>

                                                </div>

                                                <?php $fl++; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                                </div>
                            