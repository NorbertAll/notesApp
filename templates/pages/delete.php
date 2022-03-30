<div>
    <?php $note=$params['note']??null ?>
    <?php if($note):?>
   <ul>
        <li>Id:<?php echo $note['id'] ?></li>
       <li>Tytuł:<?php echo $note['title'] ?></li>
       <li>Opis:<?php echo $note['description'] ?></li>
       <li>Data Stworzenia:<?php echo $note['created'] ?></li>
   </ul> 
       

        <form method="POST" action="/notesApp/?action=delete">
            <input name="id" type="hidden" value="<?php echo $note['id']?>" />
            <input type="submit" value="Usuń">
        </form>
   <?php else:?>
    <div>
        Brak notatki do wyświetlenia
    </div>
   <?php endif;?>
   <a href="./"><button>Powrót do listy Notatek</button>  </a>
</div>
