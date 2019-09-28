CREATE TABLE `users` (
  `username` varchar(50) DEFAULT NULL,
  `passwrd` varchar(50) DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/* 0=admin
   1= user */ 
INSERT INTO `Team_8`.`users`
(`username`,
`passwrd`,
`user_role`)
VALUES
({username: 'JohnSmith7','PMahomes15', 'MaryPoppins2','MuhammadWong12', 'JakeRyan3' },
{passwrd: 'Password','football', 'flyingumbrella','code4good' , 'jpmorgan'},
<user_role: 0, 1});


SELECT `users`.`username`,
    `users`.`passwrd`,
    `users`.`user_role`
FROM `Team_8`.`users`;

