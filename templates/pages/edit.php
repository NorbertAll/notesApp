<div>
    
    <h3>Edytuj notatki</h3> 
    <div>
    <?php if(!empty($params['note'])):?>
      <?php $note=$params['note']?>
            <form class="note-form" action="/notesApp/?action=edit" method="post">
                <input name='id' type="hidden" value="<?php echo $note['id'] ?>">
                <ul>
                    <li>
                        <label>Tytuł <span class="required"></span></label><br>
                        <input type="text" name="title" class="field-long" value="<?php echo $note['title'] ?>" />
                     </li>
                    <li>
                        <label>Opis</label><br>
                        <textarea name="description" id="field5" class="field-long field-textarea"><?php echo $note['description'] ?></textarea>
                     </li>
                    <li>
                        <input type="submit" value="Submit">
                     </li>
                </ul>
            </form>
       <?php else: ?>
        Brak danych do wyświetlenia
        <a href="/"><button>Powrót do listy notatek</button></a>
        <?php endif; ?>
    </div>
</div
