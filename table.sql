DROP TABLE 'users';

CREATE TABLE `users` (
  `name` varchar(20) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(2) DEFAULT NULL,
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `remember_token` varchar(100) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ;

DROP TABLE 'products';

CREATE TABLE `products` (
  `no` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_num` varchar(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY (`no`),
  UNIQUE KEY `product_UN` (`order_num`)
);