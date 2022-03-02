
-- Transfer
UPDATE `categories` SET `feilds` = '[{\"type\":\"autocomplete\",\"label\":\"Pick up Location \",\"className\":\"form-control\",\"name\":\"autocomplete-1643896315062-0\",\"requireValidOption\":false,\"data\":\"harbours\",\"values\":[]},{\"type\":\"autocomplete\",\"label\":\"Drop off Location\",\"className\":\"form-control\",\"name\":\"autocomplete-1643896316045-0\",\"requireValidOption\":false,\"data\":\"harbours\",\"values\":[]}]' WHERE `categories`.`id` = 1;

-- Accommodation
UPDATE `categories` SET `feilds` = '[{\"type\":\"text\",\"label\":\"Room Type\",\"className\":\"form-control\",\"name\":\"text-1643891680692-0\",\"subtype\":\"text\"}]' WHERE `categories`.`id` = 2;

--  Tour
UPDATE `categories` SET `feilds` = '[{\"type\":\"text\",\"label\":\"Meeting Point\",\"className\":\"form-control\",\"name\":\"text-1646218903106-0\",\"subtype\":\"text\"},{\"type\":\"text\",\"label\":\"Contact\",\"className\":\"form-control\",\"name\":\"text-1646218842639-0\",\"subtype\":\"text\"},{\"type\":\"number\",\"label\":\"Telephone&nbsp;\",\"className\":\"form-control\",\"name\":\"number-1646218867708-0\"},{\"type\":\"textarea\",\"label\":\"Address\",\"className\":\"form-control\",\"name\":\"textarea-1646218878256-0\",\"subtype\":\"textarea\"}]' WHERE `categories`.`id` = 3;
UPDATE `categories` SET `set_end_date_of_service` = '1' WHERE `categories`.`id` = 3;

--  Cruise
UPDATE `categories` SET `feilds` = '[{\"type\":\"autocomplete\",\"label\":\"Group Owner\",\"className\":\"form-control\",\"name\":\"autocomplete-1643891903978-0\",\"requireValidOption\":false,\"data\":\"group_owners\",\"values\":[]}]' WHERE `categories`.`id` = 4;

--  Ferry/Catamaran
UPDATE `categories` SET `feilds` = '[{\"type\":\"autocomplete\",\"label\":\"Departure Harbour\",\"className\":\"form-control\",\"name\":\"autocomplete-1643891823143-0\",\"requireValidOption\":false,\"data\":\"harbours\",\"values\":[]},{\"type\":\"autocomplete\",\"label\":\"Arrival Harbour\",\"className\":\"form-control\",\"name\":\"autocomplete-1643891824192-0\",\"requireValidOption\":false,\"data\":\"harbours\",\"values\":[]}]' WHERE `categories`.`id` = 6;

UPDATE `categories` SET `show_tf` = '1' WHERE `categories`.`id` = 6;
UPDATE `categories` SET `label_of_time` = 'Departure Time' WHERE `categories`.`id` = 6;

UPDATE `categories` SET `second_tf` = '1' WHERE `categories`.`id` = 6;
UPDATE `categories` SET `second_label_of_time` = 'Arrival Time' WHERE `categories`.`id` = 6;

-- Flights
UPDATE `categories` SET `feilds` = '[{\"type\":\"autocomplete\",\"label\":\"Departure Airport\",\"className\":\"form-control\",\"name\":\"autocomplete-1643896471930-0\",\"requireValidOption\":false,\"data\":\"airport_codes\",\"values\":[]},{\"type\":\"autocomplete\",\"label\":\"Arrival Airport\",\"className\":\"form-control\",\"name\":\"autocomplete-1643896472928-0\",\"requireValidOption\":false,\"data\":\"airport_codes\",\"values\":[]}]' WHERE `categories`.`id` = 8;

UPDATE `categories` SET `show_tf` = '1' WHERE `categories`.`id` = 8;
UPDATE `categories` SET `label_of_time` = 'Departure Time' WHERE `categories`.`id` = 8;

UPDATE `categories` SET `second_tf` = '1' WHERE `categories`.`id` = 8;
UPDATE `categories` SET `second_label_of_time` = 'Arrival Time' WHERE `categories`.`id` = 8;

--  Misc.
UPDATE `categories` SET `feilds` = '[{\"type\":\"text\",\"label\":\"Misc Details\",\"className\":\"form-control\",\"name\":\"text-1643892011594-0\",\"subtype\":\"text\"}]' WHERE `categories`.`id` = 9;
