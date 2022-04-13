INSERT INTO `users` (`id`, `role_id`, `supervisor_id`, `currency_id`, `brand_id`, `holiday_type_id`, `commission_id`, `commission_group_id`, `supplier_currency_id`, `name`, `email`, `email_verified_at`, `password`, `rate_type`, `markup_type`, `remember_token`, `is_login`, `column_preferences`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, 1, 1, 1, 1, 2, 'Kashan', 'kashan.kingdomvision@gmail.com', '2022-04-12 21:30:09', '$2y$10$DWYicNIs2CwsC4OQ3nP8WeAiYRyEkwfFkDybhGxj.f2s4p/DnmF8K', 'manual', 'whole', NULL, 0, NULL, '2022-04-12 21:30:09', '2022-04-12 21:30:09'),
(2, 2, NULL, 1, 1, 1, 1, 2, NULL, 'Muno Mandizha', 'muno.mandizha@gmail.com', '2022-04-12 21:30:09', '$2y$10$PsU8s5.NDF2scmsFV9rrFe0ft/5ZQzZ.WOz83XJgl5Iax1LZ0hBUC', 'manual', 'whole', NULL, 0, NULL, '2022-04-12 21:30:09', '2022-04-13 02:40:23'),
(3, 2, NULL, 1, 1, 1, 1, 1, NULL, 'Pietro Molica Lazzaro', 'pietro.molica.lazzaro@gmail.com', '2022-04-12 21:30:09', '$2y$10$BBeqB0pRidrS6Liwxo1WsO3nrn7cTbXsGma16ceFlgkVobDHED0mG', 'manual', 'whole', NULL, 0, NULL, '2022-04-12 21:30:09', '2022-04-12 21:30:09'),
(4, 2, NULL, 1, 1, 1, 1, 1, NULL, 'Natalie Jurcic', 'natalie.jurcic@gmail.com', '2022-04-12 21:30:09', '$2y$10$/aL9zGm7OT1jrl1ZBgL5gOXDPPK0LTPQbWDYDOe9Y/2zFOtxNAHEC', 'manual', 'whole', NULL, 0, NULL, '2022-04-12 21:30:09', '2022-04-12 21:30:09'),
(5, 2, NULL, 1, 1, 1, 1, 1, NULL, 'Perian Johnson', 'perian.johnson@gmail.com', '2022-04-12 21:30:09', '$2y$10$HxmT48nt8DiykH8kmKgskuRXxG/mGazUC9ENt.v/05nPB1iezM5QG', 'manual', 'whole', NULL, 0, NULL, '2022-04-12 21:30:09', '2022-04-12 21:30:09'),
(6, 2, NULL, 1, 1, 1, 1, 1, NULL, 'Ally Lewing', 'allyl@unforgettabletravelcompany.com', '2022-04-12 21:30:09', '$2y$10$JKy1JemK3H0RfX3FKBdJ1e.dhwROM.VvfVUGILZhcsLQ0u2b/5/DK', 'manual', 'whole', NULL, 0, NULL, '2022-04-12 21:30:09', '2022-04-12 21:30:09'),
(7, 2, NULL, 1, 1, 1, 1, 1, NULL, 'Luke Stapylton-Smith', 'luke.stapylton-smith@gmail.com', '2022-04-12 21:30:09', '$2y$10$rGuhnn90JBdzKS4Un3693.P/n77jcE16Rmenmt7v9lj5d34bpj2EW', 'manual', 'whole', NULL, 0, NULL, '2022-04-12 21:30:09', '2022-04-12 21:30:09'),
(8, 2, NULL, 1, 1, 1, 1, 1, NULL, 'Gemma D’Souza', 'gemma.d’souza@gmail.com', '2022-04-12 21:30:09', '$2y$10$fRMZpDmkf2TmV6XX5RPrcOh2Lf36Ry3AaKAnnE2ELXxHI.9oq0b1e', 'manual', 'whole', NULL, 0, NULL, '2022-04-12 21:30:09', '2022-04-12 21:30:09'),
(9, 2, NULL, 1, 1, 1, 1, 1, NULL, 'Nora Frohberg', 'nora.frohberg@gmail.com', '2022-04-12 21:30:09', '$2y$10$/ozmaUDVgVDMsGTWPVNP0eRNzIBU04yPN5wfJogXpW3Tf.1cZn/a6', 'manual', 'whole', NULL, 0, NULL, '2022-04-12 21:30:09', '2022-04-12 21:30:09'),
(10, 2, NULL, 1, 1, 1, 1, 1, NULL, 'Graham Carter', 'graham.carter@gmail.com', '2022-04-12 21:30:09', '$2y$10$S12.4NDbQQS4XhFPD0KlK.1pMag3vbV9JXrLSqgbOVQR/Ck7snnQq', 'manual', 'whole', NULL, 0, NULL, '2022-04-12 21:30:09', '2022-04-12 21:30:09'),
(11, 5, NULL, 1, NULL, NULL, 1, 2, 2, 'Irfan Kaleem', 'irfan.kaleem@gmail.com', NULL, '$2y$10$dbxReuf38iFTc3YeIOPqTubmUOMvCQZODsuRmttEh212b.U3JxBC2', 'manual', 'whole', NULL, 0, NULL, '2022-04-13 02:40:12', '2022-04-13 02:41:10');

-- set currency rate type manual for all users
UPDATE `users` SET `rate_type` = 'manual';

-- set supervisor 
UPDATE `users` SET `supervisor_id` = '11' WHERE `users`.`id` = 2;
