INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`,
                     `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`,
                     `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`,
                     `date_created`, `last_updated`, `first_name`, `last_name`, `phone_number`,
                     `zipcode`, `address`, `country_code`, `city`)
VALUES (1, 'user', 'user', 'user@mail.com', 'user@mail.com', 1, 'e5gzfmivftw0g4cwwcko08sk4s0w88g',
           '$2y$13$e5gzfmivftw0g4cwwcko0uSaLHWTiOiZcKFXl5VPlaESzYKM028nu', '2018-05-25 21:10:01', 0, 0, NULL, NULL,
                                                                                                        NULL, 'a:0:{}',
                                                                                                        0, NULL,
                                                                                                        '2018-05-25 20:57:04',
                                                                                                        '2018-05-25 20:57:04',
                                                                                                        'Jan',
                                                                                                        'Kowalsko',
        '123-456-789', '01-120', 'Żołnierska 49', 'PL', 'Szczecin');

INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`,
                     `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`,
                     `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`,
                     `date_created`, `last_updated`, `first_name`, `last_name`, `phone_number`,
                     `zipcode`, `address`, `country_code`, `city`)
VALUES (2, 'auditor', 'auditor', 'auditor@mail.com', 'auditor@mail.com', 1, 'g5bs7zn5v3ksc4o8cc4o8ckoo8cwk4c',
           '$2y$13$g5bs7zn5v3ksc4o8cc4o8OFvPelsx8OFmh/wpdZIl2qIoHpdK8Fj2', NULL, 0, 0, NULL, NULL, NULL,
                                                                                       'a:1:{i:0;s:12:"ROLE_AUDITOR";}',
                                                                                       0, NULL, '2018-05-25 20:58:38',
                                                                                       '2018-05-25 20:58:38', 'Stefan',
                                                                                       'Audytor', '345-543-234',
        '11-223', 'Żołnierska 49', 'PL', 'Szczecin');

INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`,
                     `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`,
                     `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`,
                     `date_created`, `last_updated`, `first_name`, `last_name`, `phone_number`,
                     `zipcode`, `address`, `country_code`, `city`)
VALUES (3, 'admin', 'admin', 'admin@mail.com', 'admin@mail.com', 1, 'drmbq8l5ylssswcw84o0440wsc0k4c8',
           '$2y$13$drmbq8l5ylssswcw84o04uVBYyP1VVcThEDvsJNzap9vttIlG2./S', NULL, 0, 0, NULL, NULL, NULL,
                                                                                       'a:1:{i:0;s:10:"ROLE_OWNER";}',
                                                                                       0, NULL, '2018-05-25 20:59:38',
                                                                                       '2018-05-25 20:59:38', 'Admin',
                                                                                       'Admin', '00-000-000', '00-000',
        'Żołnierska 51', 'PL', 'Szczecin');
