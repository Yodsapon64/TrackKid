CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
