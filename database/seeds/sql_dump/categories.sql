
-- Transfer
UPDATE `categories` SET `feilds` = '[{\"type\":\"autocomplete\",\"label\":\"Pick up Location \",\"className\":\"form-control\",\"name\":\"autocomplete-1643896315062-0\",\"requireValidOption\":false,\"data\":\"harbours\",\"values\":[]},{\"type\":\"autocomplete\",\"label\":\"Drop off Location\",\"className\":\"form-control\",\"name\":\"autocomplete-1643896316045-0\",\"requireValidOption\":false,\"data\":\"harbours\",\"values\":[]}]' WHERE `categories`.`id` = 1;

-- Flights
UPDATE `categories` SET `feilds` = '[{\"type\":\"autocomplete\",\"label\":\"Departure Airport\",\"className\":\"form-control\",\"name\":\"autocomplete-1643896471930-0\",\"requireValidOption\":false,\"data\":\"airport_codes\",\"values\":[]},{\"type\":\"autocomplete\",\"label\":\"Arrival Airport\",\"className\":\"form-control\",\"name\":\"autocomplete-1643896472928-0\",\"requireValidOption\":false,\"data\":\"airport_codes\",\"values\":[]}]' WHERE `categories`.`id` = 8;

UPDATE `categories` SET `show_tf` = '1' WHERE `categories`.`id` = 8;
UPDATE `categories` SET `label_of_time` = 'Departure Time' WHERE `categories`.`id` = 8;

UPDATE `categories` SET `second_tf` = '1' WHERE `categories`.`id` = 8;
UPDATE `categories` SET `second_label_of_time` = 'Arrival Time' WHERE `categories`.`id` = 8;

-- Accommodation
UPDATE `categories` SET `feilds` = '[{\"type\":\"text\",\"label\":\"Room Type\",\"className\":\"form-control\",\"name\":\"text-1643891680692-0\",\"subtype\":\"text\"}]' WHERE `categories`.`id` = 2;

--  Ferry/Catamaran
UPDATE `categories` SET `feilds` = '[{\"type\":\"autocomplete\",\"label\":\"Departure Harbour\",\"className\":\"form-control\",\"name\":\"autocomplete-1643891823143-0\",\"requireValidOption\":false,\"data\":\"harbours\",\"values\":[]},{\"type\":\"autocomplete\",\"label\":\"Arrival Harbour\",\"className\":\"form-control\",\"name\":\"autocomplete-1643891824192-0\",\"requireValidOption\":false,\"data\":\"harbours\",\"values\":[]}]' WHERE `categories`.`id` = 6;

UPDATE `categories` SET `show_tf` = '1' WHERE `categories`.`id` = 6;
UPDATE `categories` SET `label_of_time` = 'Departure Time' WHERE `categories`.`id` = 6;

UPDATE `categories` SET `second_tf` = '1' WHERE `categories`.`id` = 6;
UPDATE `categories` SET `second_label_of_time` = 'Arrival Time' WHERE `categories`.`id` = 6;

--  Cruise
UPDATE `categories` SET `feilds` = '[{\"type\":\"autocomplete\",\"label\":\"Group Owner\",\"className\":\"form-control\",\"name\":\"autocomplete-1643891903978-0\",\"requireValidOption\":false,\"data\":\"group_owners\",\"values\":[]}]' WHERE `categories`.`id` = 4;

--  Misc.
UPDATE `categories` SET `feilds` = '[{\"type\":\"text\",\"label\":\"Misc Details\",\"className\":\"form-control\",\"name\":\"text-1643892011594-0\",\"subtype\":\"text\"}]' WHERE `categories`.`id` = 9;