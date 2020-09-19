
                <div class="propose_left <?php if ($baseUrl == '/') { echo 'propose_left_active'; } ?>">
                    <div class="propose_left_top">
                        <div class="propose_left_gamburger">
                            <div class="menu-opener-inner active"></div>
                        </div>
                        <div class="propose_left_title">
                            <p><i class="fa fa-bars"></i> Каталог товарів</p>
                        </div>
                    </div>

                </div>                    
                    <div class="propose_list">
                    <?php foreach ($categories as $key => $value): ?>
                    <?php   if ($value['parent_id'] == 0): ?>
                     <div class="propose_item <?= $value['slug']  ?>  ">
                        <div class="propose_item_title">
                            <a href="<?= $this->Url->build(['controller' => 'categories','action'=>$value['slug']]) ?>"><?= $value['name'] ?></a>
                        </div>
                        <div class="propose_item_arrov">
                            <i class="fa fa-chevron-right"></i>
                        </div>
                        <div class="propose_item_list">
                            <?php  foreach ($value['child_categories'] as $key => $item):?>
                                <div class="propose_item_list_item ">
                                    <a class="category__title__propose <?= $item['slug'] ?>   " href="<?= $this->Url->build(['controller' => 'categories','action'=>$item['slug']]) ?>"><?= $item['name']; ?></a>
                                
                           
                                <?php foreach ($categories as $key => $item_two): ?>
                                <?php if ($item_two['parent_id'] == $item['id'] AND $item_two['name'] != $item['name']) { ?>
                                    <div class="propose_item_list_two">
                                <a  href="<?= $this->Url->build(['controller' => 'categories','action'=>$item_two['slug']]) ?>"><?= $item_two['name']."</a>" ?> 
                           
                                  </div>
                                   <?php   } ?>
                            <?php endforeach; ?>
                            </div>
                            <?php   endforeach; ?>

                            <?php if (empty($value['picture'])) { ?>
                                <img src="<?= $this->Url->build('/img/unnamed.png', ['fullBase' => true]) ?>" >
                            <?php } else { ?>
                                <img class="lazy_load" data-load="<?= $this->Url->build("/categories/".$value['picture'], ['fullBase' => true]) ?>" src="" >
                            <?php } ?>
                        </div>
                     </div>
                 <?php endif; ?>
                    <?php endforeach; ?>

                    </div>