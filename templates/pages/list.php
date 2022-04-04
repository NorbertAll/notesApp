
<div class="list">
       <section>
                <div class="message">
                     <?php if(!empty($params['error'])) :?>
                           <?php
                            switch($params['error']){
                                   case 'noteNotFound':
                                          echo "Notatka nie została znaleziona";
                                          break;
                            }
                           ?>
                            
                           
                     <?php endif; ?>
               </div>
               <div class="message">
                     <?php if(!empty($params['before'])) :?>
                           <?php
                            switch($params['before']){
                                   case 'created':
                                          echo "Notatka została utorzona";
                                          break;
                                  case 'edited':
                                        echo "Notatka została stworzona";
                                        break;
                                  case 'deleted':
                                    echo "Notatka została usunięta";
                                    break;
                            }
                           ?>
                            
                           
                     <?php endif; ?>
               </div>

              <?php

                  $sort=$params['sort'] ??[];
                  $by=$sort['by']??'title';
                  $order=$sort['order']??'desc';

                  $page=$params['page'] ??[];
                  $size=$page['size'] ??10;
                  $currentPage=$page['number'] ??1;
                  $pages=$page['pages']??1;

                  $phrase = $params['phrase'] ??null;

              ?>
              <div>
                <form class="settings-form" action="/notesApp/" method="GET">
                  <div>
                    <label >Wyszukaj: <input type="text" name="phrase" value="<?php echo $phrase ?>"/></label>
                  </div>
                  <div>Sortuj po:
                    <label>Tytule: <input name="sortby" type="radio" value="title" <?php echo $by==='title'?'checked' :''  ?>/></label>
                    <label>Dacie: <input name="sortby" type="radio" value="created" <?php echo $by==='created'?'checked' :''  ?>/></label>
                  </div>

                  <div>Kierunek sortowania
                    <label>Rosnąco <input name="sortorder" type="radio" value="asc" <?php echo $order==='asc'?'checked' :''  ?>/></label>
                    <label>malejąco: <input name="sortorder" type="radio" value="desc" <?php echo $order==='desc'?'checked' :''  ?>/></label>
                  </div>
                  <div>
                    <div>Rozmair paczki</div>
                    <label for="">1 <input name="pagesize" type="radio" value="1"<?php echo $size===1 ? 'checked':'' ?> >      </label>
                    <label for="">5 <input name="pagesize" type="radio" value="5"<?php echo $size===5 ? 'checked':'' ?> >      </label>
                    <label for="">10 <input name="pagesize" type="radio" value="10"<?php echo $size===10 ? 'checked':'' ?> >      </label>
                    <label for="">25 <input name="pagesize" type="radio" value="25"<?php echo $size===25 ? 'checked':'' ?> >      </label>
                  </div>
                  <input type="submit" value="Wyślij">
                </form>
              </div>



               <div class="tbl-header">
                     <table cellpadding="1" cellspacing="1" border="1" align="center">
                       <thead>
                         <tr>
                           <th>Id</th>
                           <th>Tytuł</th>
                           <th>Data</th>
                           <th>Opcje</th>
                         </tr>
                       </thead>
                     
              </div>
              <div class="tbl-content">
                     
                        <tbody>
                            <?php foreach ($params['notes'] ?? [] as $note): ?>
                              <tr>
                                <td><?php echo $note['id'] ?></td>
                                <td><?php echo $note['title'] ?></td>
                                <td><?php echo $note['created'] ?></td>
                                <td>
                                  <a href="./?action=show&id=<?php echo $note['id'] ?>">
                                    <button>
                                      Szczegóły
                                    </button>
                                  </a>

                                  <a href="./?action=delete&id=<?php echo $note['id'] ?>">
                                    <button>
                                      Usuń
                                    </button>
                                  </a>

                                </td>
                              </tr>
                            <?php endforeach; ?>
                        </tbody>
                             
                      </table>
              </div>
              <?php 
              $paginationUrl="&phrase=$phrase&pagesize=$size?&sortby=$by&sortorder=$order"
              ?>
              <div class="pagination">
                <?php if($currentPage!==1):?>
                <a href="/notesApp/?page=<?php echo $currentPage -1 . $paginationUrl ?>">
                        <button>Prev</button>
                </a>
                <?php endif;?>
                <?php for($i=1; $i<=$pages; $i++): ?>
                  
                    <a href="/notesApp/?page=<?php echo $i. $paginationUrl ?>">
                      <button><?php echo $i; ?></button>
                    </a>
                    &nbsp
                <?php endfor; ?>
                <?php if($currentPage<$pages):?>
                <a href="/notesApp/?page=<?php echo $currentPage +1 . $paginationUrl ?>">
                      <button>Next</button>
                </a>
                <?php endif;?>
              </div>
       </section>
</div>


 