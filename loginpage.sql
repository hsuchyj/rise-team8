CREATE TABLE `users` (
  `username` varchar(50) DEFAULT NULL,
  `passwrd` varchar(50) DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/* 0=admin
   1= user */ 

SELECT `users`.`username`,
    `users`.`passwrd`,
    `users`.`user_role`
FROM `Team_8`.`users`;

