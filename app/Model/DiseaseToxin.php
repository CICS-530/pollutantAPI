<?php
/**
* DiseaseToxin.php
*
* Similar to the CategoryDisease model, bridges the relationship
* between the disease and toxin models. Does NOT use the HATBM 
* (Has And Belongs To Many) association found in cakePHP because
* we need to add an extra column (the strength of the relationship)
* to the table, so we need to make a full-blown model.
* 
*/

public DiseaseToxin extends AppModel {

}