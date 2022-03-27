<div>
    <?php if($params['note']):?>
   <ul>
        <li>Id:<?php echo htmlentities($params['note']['id']) ?></li>
       <li>Tytuł:<?php echo htmlentities($params['note']['title']) ?></li>
       <li>Opis:<?php echo htmlentities($params['note']['description']) ?></li>
       <li>Data Stworzenia:<?php echo htmlentities($params['note']['created']) ?></li>
   </ul> 
   
   <?php else:?>
    <div>
        Brak notatki do wyświetlenia
    </div>
   <?php endif;?>
   <a href="./"><button>Powrót do listy Notatek</button>  </a>
</div>


