
<div class="list">
       <section>
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
                     <table cellpadding="0" cellspacing="0" border="1">
                       <thead>
                         <tr>
                           <th>Id</th>
                           <th>Tytuł</th>
                           <th>Data</th>
                           <th>Opcje</th>
                         </tr>
                       </thead>
                     </table>
              </div>
              <div class="tbl-content">
                     <table cellpadding="0" cellspacing="0" border="1">
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


 