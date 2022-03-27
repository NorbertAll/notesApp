
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
                            }
                           ?>
                            
                           
                     <?php endif; ?>
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
                                <td><?php echo (int) $note['id'] ?></td>
                                <td><?php echo htmlentities($note['title']) ?></td>
                                <td><?php echo htmlentities($note['created']) ?></td>
                                <td>
                                  <a href="./?action=show&id=<?php echo (int) $note['id'] ?>">Pokaż</a>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                        </tbody>
                             
                      </table>
              </div>
       </section>
</div>


 