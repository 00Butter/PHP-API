DROP TABLE 'users'

CREATE TABLE `users` (
  `name` varchar(20) NOT NULL,
  `nick_name` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(2) DEFAULT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1

DROP TABLE 'product'

CREATE TABLE `product` (
  `no` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_num` varchar(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY (`no`),
  UNIQUE KEY `product_UN` (`order_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1