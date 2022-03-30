<div>
    <?php $note=$params['note']??null ?>
    <?php if($params['note']):?>
   <ul>
        <li>Id:<?php echo $note['id'] ?></li>
       <li>Tytuł:<?php echo $note['title'] ?></li>
       <li>Opis:<?php echo $note['description'] ?></li>
       <li>Data Stworzenia:<?php echo $note['created'] ?></li>
   </ul> 
        <a href="/notesApp/?action=edit&id=<?php echo $note['id']?>">
            <button>Edytuj</button>
        </a>
   <?php else:?>
    <div>
        Brak notatki do wyświetlenia
    </div>
   <?php endif;?>
   <a href="./"><button>Powrót do listy Notatek</button>  </a>
</div>


