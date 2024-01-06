
# Table of Contents





 - [Εγκατάσταση](#Εγκατάσταση)
    - [Απαιτήσεις]()
    - [Οδηγίες Εγκατάστασης]()
 - [Περιγραφή API]()
    - [Methods]()
      - [Board]()
        - [Ανάγνωση Board]()
        - [Αρχικοποίηση Board]()
      - [Piece]()
        - [Ανάγνωση Θέσης/Πιονιού]()
        - [Μεταβολή Θέσης Πιονιού]()
      - [Player]()
        - [Ανάγνωση στοιχείων παίκτη]()
        - [Καθορισμός στοιχείων παίκτη]()
      - [Status]()
        - [Ανάγνωση κατάστασης παιχνιδιού]()
      - [Entities]()
        - [Board]()
        - [Players]()
        - [Game_status]()
        - [Πίνακες βάσης]()


# Demo Page

Μπορείτε να επισκευτείτε τα link: https://users.iee.ihu.gr/~iee2019067/project/ADISE23_kegeroglou/lib/ludo.php/board (GET, POST)

https://users.iee.ihu.gr/~iee2019067/project/ADISE23_kegeroglou/lib/ludo.php/players/P (GET, POST με username)

https://users.iee.ihu.gr/~iee2019067/project/ADISE23_kegeroglou/lib/ludo.php/players/R   (GET, POST με username)

https://users.iee.ihu.gr/~iee2019067/project/ADISE23_kegeroglou/lib/ludo.php/board/piece (GET, POST με piece_color=P, R)

https://users.iee.ihu.gr/~iee2019067/project/ADISE23_kegeroglou/lib/ludo.php/players (GET)

https://users.iee.ihu.gr/~iee2019067/project/ADISE23_kegeroglou/lib/ludo.php/status (GET)

https://users.iee.ihu.gr/~iee2019067/project/ADISE23_kegeroglou/lib/ludo.php/drop_players (POST)
# Εγκατάσταση 
## Απαιτήσεις
- Apache2
- Mysql Server
- Php
## Οδηγίες Εγκατάστασης
- Κάντε clone το project σε κάποιον φάκελο `$ git clone https://github.com/artemiskegkeroglou/ADISE23_kegeroglou.git`
- Βεβαιωθείτε ότι ο φάκελος είναι προσβάσιμος από τον Apache Server. πιθανόν να χρειαστεί να καθορίσετε τις παρακάτω ρυθμίσεις.
- Θα πρέπει να δημιουργήσετε στην Mysql την βάση με όνομα 'iee2019067_schema' και να φορτώσετε σε αυτήν την βάση τα δεδομένα από το αρχείο schema.sql
- Θα πρέπει να φτιάξετε το αρχείο lib/db_upass.php το οποίο να περιέχει:
```
<?php
	$DB_PASS = 'κωδικός';
	$DB_USER = 'όνομα χρήστη';
?>
```
# Περιγραφή Παιχνιδιού
Ο γκρινιάρης παίζεται ως εξής: υπάρχουν δύο παίκτες (Red, Purple) όπου κάθε ένας έχει δύο πιόνια. Κάθε φορά μπορεί να παίξει μόνο ένα πιόνι του. Ξεκινάει πάντα πρώτος ο Red πάικτης και σύμφωνα με τα ζάρια (αριθμός από 2 έως 12) μετακινείται σε σταυρό ώσπου να καταλήξει στην τελική του θέση. Για το πρώτο πιόνι του Red η τελική θέση είναι 7,5 και για το δεύτερο η 7,4 ενώ για το πρώτο πιόνι του Purple είναι η 7,9 και για το δεύτερο η 7,10 (πίνακας 13x13). Ο χρήστης με το πάτημα του κουμπιού μεταφέρεται στην θέση που πρέπει να παέι σύμφωνα με τα ζάρια του και αν τύχει πιόνι αντιπάλου αυτομάτως κερδίζει το παιχνίδι, μιάς και ο άλλος παίκτης δεν θα καταφέρει ποτέ να φέρει και τα δύο πιόνια του στον τερματισμό. Οπότε, σκοπός κάθε παίκτη είναι να φέρει όσο το δυνατόν μεγαλύτερη ζαριά ώστε να φέρει και τα δύο του πιόνια στον τερματισμό και να κερδίσει, ή να πετύχει πιόνι αντιπάλου (πιο σπάνιο). Κρατείται σκορ δύο συγκεκριμένων παικτών για 10 λεπτά από την ώρα σύνδεσής τους. Μετά πρέπει να ξανα συνδεθούν και το σκορ ξεκινάει να μετράει από την αρχή.

Η βάση μας κρατάει τους εξής πίνακες: board, board_empty, game_status, move_P, move_R, players, position, score, show_winner. Ο board είναι ένας πίνακας 13x13 με στοιχεία x, y, b_color, piece_color, piece για τις συντεταγμένες θέσης, χρώμα τετραγώνου, χρώμα πιονιού και πιόνι, όταν υπάρχει, αντίστοιχα. Ο board_empty είναι όμοιος του board,  όμως δεν αλλάζει, και αρχικοποιεί τον board μόλις πριν ξεκινήσει το παιχνίδι (x, y, b_color, piece_color, piece για τις συντεταγμένες θέσης, χρώμα τετραγώνου, χρώμα πιονιού και πιόνι, όταν υπάρχει, αντίστοιχα). Ο game_status ο οποίος περιέχει τα status, p_turn, result, last_change τα οποία είναι το status του παιχνιδιού, ο παίκτης που έχει σειρά, το αποτελέσμα (ο νικητής αν υπάρχει), και η τελευταία στιγμή που άλλεξε κάτι από αυτά. Στους πίνακες move_P, move_R περιέχονται τα στοιχεία number, x, y. Το number καταχωρεί τα βήματα που μπορεί να κάνει το πιόνι του εκάστοτε παίκτη (διαφορετική διαδρομή ακολουθούν τα πιόνια του Red με του Purple γιατί έχουν διαφορετική θέση έναρξης και τερματισμού). Έτσι τα x, y περιέχουν τις συντεταγμένες αυτών των βημάτων ως τον τερματισμό. στον πίνακα players αποθηκεύονται οι παίκτες με τα στοιχεία τους. Πιο συγκεκριμένα τα username, piece_color, token, last_action που αντιστοιχίζονται στο όνομα παίκτη, χρώμα πιονιών, token (μοναδικό για κάθε παίκτη) και πότε συνδέθηκε. Ο πίνακας position περιέχει τα id (id=1 για Red, id=2 για Purple), x, y για την θέση που βρίσκεται το πιόνι κάθε παίκτη ώστε να μην χρειάζεται να δίνει κάθε φορά x, y ο χρήστης για να γίνει η κίνηση (με PUT μέθοδο και το αντίστοιχο url ο παίκτης μετακινεί το πιόνι του και του εμφανίζονται όλα τα στοιχεία καθώς και ο πίνακας). Στον πίνακα score περιέχονται τα Red, Purple, όπου είναι οι νίκες του κάθε παίκτη μέχρι 10 λεπτά από την στιγμή που έδωσαν username. Μετά πρέπει να εκτελεστεί η procedure drop_players, και να ξεκινήσει καινούριο παιχίδι και σκορ. Τέλος, ο πίνακας show _winner περιέχει τα id, winner, status, που εκχωρούν για id=1, winner=Red player, status=1 αν έχει κερδίσει την συγκεκριμένη παρτίδα ο Red ή status=0 αν δεν την έχει κερδίσει και αντίστοιχα id=2, winner=Purple player, status=1 αν έχει κερδίσει την συγκεκριμένη παρτίδα ο Purple ή status=0 αν δεν την έχει κερδίσει. 

Ακόμη, υπάρχουν οι procedures clean_board για αρχικοποίηση του πίνακα, count_score για να κρατά το αποτελέσμα των παρτίδων (νίκη θεωρείται μόνο όταν κερδίζει κάποιος παίκτης και όχι σε περίπτωση που αποκληστεί ο αντιπαλός του), drop_players η οποία αναφέρθηκε παραπάνω και η move_piece που μετακινεί τα πιόνια.

Η εφαρμογή απαπτύχθηκε μέχρι και το τελικό σημείο που ζητείται και προστέθηκε το σκορ και άλλοι κανόνες για τον γκρινιάρη.

## Συντελεστές

Προγραμματιστής 1: PHP API, Σχεδιασμός mysql

# Περιγραφή API
# Methods
## Board   
### Ανάγνωση Board   
`GET /board/` Επιστρέφει το [Board](##Board).

### Αρχικοποίηση Board
`POST /board/` Αρχικοποιεί το Board, δηλαδή το παιχνίδι. Γίνονται reset τα πάντα σε σχέση με το παιχνίδι. Επιστρέφει το [Board](##Board).

## Piece
### Ανάγνωση Θέσης/Πιονιού την εκάστοτε στιγμή
`GET /board/piece/`  

Json Data:  

| Field  | Description | Required |
| ------------- | ------------- | ------------- |
| piece_color  | R or P  | yes |

Κάνει την κίνηση του πιονιού από την θέση στην οποία είναι προς την νέα θέση. Προφανώς ελέγχεται η κίνηση αν είναι νόμιμη καθώς και αν είναι η σειρά του παίκτη να παίξει με βάση το token. Επιστρέφει τα στοιχεία από το Board με συντεταγμένες x,y. Περιλαμβάνει τον αριθμό της ζαριάς και την νέα θέση στην οποία πήγε το πιόνι.

### Μεταβολή Θέσης Πιονιού
`PUT /board/piece/`

Json Data:  

| Field  | Description | Required |
| ------------- | ------------- | ------------- |
| piece_color  | χρώμα πιονιών παίκτη  | yes |

Επιστρέφει τα στοιχεία από το Board με συντεταγμένες x,y για την θέση που πήγε το πιόνι, την ζαριά και όταν το πρώτο πιόνι κάθε παίκτη φτάσει στον τερματισμό, μήνυμα ότι στην επόμενη ζαριά θα μπει στο παιχίδι το δεύτερο πιόνι του παίκτη.

## Player
### Ανάγνωση στοιχείων παίκτη
`GET /players/p`  Επιστρέφει τα στοιχεία του παίκτη p ή όλων των παικτών αν παραληφθεί. Το p μπορεί να είναι 'P' ή 'R'.

### Καθορισμός στοιχείων παίκτη
`PUT /players/p`  

Json Data:

| Field  | Description | Required |
| ------------- | ------------- | ------------- |
| username  | Το username για τον παίκτη p  | yes |

Επιστρέφει τα στοιχεία του παίκτη p και ένα token. Το token είναι μοναδικό και δεν χρειάζεται να το θυμάται ο χρήστης γιατί κρατείται στην βάση.

## Status
### Ανάγνωση κατάστασης παιχνιδιού
`GET /status/` Επιστρέφει τα στοιχεία [Score](##Score), [Game_status](##Game_status).

# Entities

## Board
Το board είναι ένας πίνακας, ο οποίος στο κάθε στοιχείο έχει τα παρακάτω:  

| Attribute  | Description | Values |
| ------------- | ------------- | ------------- |
| x | H συντεταγμένη x του τετραγώνου  | 1..13 |
| y | H συντεταγμένη y του τετραγώνου  | 1..13 |
| b_color | To χρώμα του τετραγώνου  | 'R','P' |
| piece_color | To χρώμα του πιονιού  | 'R','P','W' |
| piece | To Πιόνι που υπάρχει στο τετράγωνο  | K1,K2,null |

## Players
O κάθε παίκτης έχει τα παρακάτω στοιχεία:  

| Attribute  | Description | Values |
| ------------- | ------------- | ------------- |
| username | Όνομα παίκτη  | String |
| piece_color | To χρώμα που παίζει ο παίκτης  | 'R','P' |
| token | To κρυφό token του παίκτη. Επιστρέφεται μόνο τη στιγμή της εισόδου του παίκτη στο παιχνίδι  | HEX |

## Game_status

H κατάσταση παιχνιδιού έχει τα παρακάτω στοιχεία:   

| Attribute  | Description | Values |
| ------------- | ------------- | ------------- |
| status | Κατάσταση  | 'not active', 'initialized', 'started', 'ended', 'aborded' |
| p_turn | To χρώμα του παίκτη που παίζει  | 'R','P',null |
| result | To χρώμα του παίκτη που κέρδισε  | 'R','P',null |
| last_change | Τελευταία αλλαγή/ενέργεια στην κατάσταση του παιχνιδιού  | timestamp |


## Score
Είναι ένας πίνακας, ο οποίος περιέχει το σκορ για κάθε παίκτη όπως φαίνεται και παρακάτω: 

| Attribute  | Description | Values |
| ------------- | ------------- | ------------- |
| Red | To χρώμα του παίκτη  | integer |
| Purple | To χρώμα του παίκτη  | integer |

## Move_P
Είναι ένας πίνακας, ο οποίος περιέχει τις θέσεις στις οποίες μπορεί να βρεθεί πιόνι Purple αλλά και τον αριθμό αυτής της θέσης όπως φαίνεται και παρακάτω: 

| Attribute  | Description | Values |
| ------------- | ------------- | ------------- |
| number | Ο αριθμός της θέσης  | 1..51 |
| x | H συντεταγμένη x του τετραγώνου  | 1..13 |
| y | H συντεταγμένη y του τετραγώνου  | 1..13 |

## Move_R
Είναι ένας πίνακας, ο οποίος περιέχει τις θέσεις στις οποίες μπορεί να βρεθεί πιόνι Red αλλά και τον αριθμό αυτής της θέσης όπως φαίνεται και παρακάτω: 

| Attribute  | Description | Values |
| ------------- | ------------- | ------------- |
| number | Ο αριθμός της θέσης  | 1..51 |
| x | H συντεταγμένη x του τετραγώνου  | 1..13 |
| y | H συντεταγμένη y του τετραγώνου  | 1..13 |

## Position
Είναι ένας πίνακας, ο οποίος περιέχει την θέση του (προς μεταφορά) πιονιού την συγκεκριμένη χρονική στιγμή και με το id (1 για Red, 2 για Purple) σε ποιού παίκτη το πιόνι αναφέρομαι: 

| Attribute  | Description | Values |
| ------------- | ------------- | ------------- |
| id | Αριθμός που ξεχωρίζει την θέση πιονιού Red από Purple  | 1,2 |
| x | H συντεταγμένη x του τετραγώνου  | 1..13 |
| y | H συντεταγμένη y του τετραγώνου  | 1..13 |

## Show_winner
Είναι ένας πίνακας, ο οποίος περιέχει στο πεδίο status, 1 για τον νικητή και 0 για τον ηττημένο: 

| Attribute  | Description | Values |
| ------------- | ------------- | ------------- |
| id | Αριθμός που ξεχωρίζει τους παίκτες  | 1,2 |
| winner | Κείμενο για τον κάθε παίκτη  | String |
| status | Αριθμός που ξεχωρίζει τον νικητή από τον ηττημένο  | 0,1 |

